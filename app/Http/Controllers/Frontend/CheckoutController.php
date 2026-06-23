<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /*
    |─────────────────────────────────────────────────────────
    | STORE CONFIG
    | Store: All You Want Grocery, Mayur Vihar Phase-1, Delhi
    | Delivery: Max 10 km radius from store
    | Charges: FREE above ₹2000 | ₹40 upto 5km | ₹70 upto 10km
    |─────────────────────────────────────────────────────────
    */
    const STORE_LAT      = 28.6080;   // Mayur Vihar Phase-1 lat
    const STORE_LNG      = 77.2986;   // Mayur Vihar Phase-1 lng
    const MAX_RADIUS_KM  = 10;        // Max delivery distance
    const FREE_ABOVE     = 2000;      // Free delivery above ₹2000
    const CHARGE_NEAR    = 40;        // ₹40 upto 5km
    const CHARGE_FAR     = 70;        // ₹70 5-10km

    // Delhi pincodes within 10km of Mayur Vihar Phase-1
    const SERVICEABLE_PINCODES = [
        '110091' => ['name'=>'Mayur Vihar Phase-1','km'=>0],
        '110092' => ['name'=>'Mayur Vihar Phase-2','km'=>2],
        '110096' => ['name'=>'Mayur Vihar Phase-3','km'=>3],
        '110051' => ['name'=>'Preet Vihar','km'=>4],
        '110093' => ['name'=>'Kondli','km'=>5],
        '110095' => ['name'=>'Vasundhara Enclave','km'=>4],
        '110085' => ['name'=>'Patparganj','km'=>5],
        '110032' => ['name'=>'Shahdara','km'=>6],
        '110094' => ['name'=>'Mandawali','km'=>3],
        '110090' => ['name'=>'East Delhi','km'=>5],
        '110031' => ['name'=>'Geeta Colony','km'=>7],
        '110053' => ['name'=>'Anand Vihar','km'=>6],
        '110054' => ['name'=>'ISBT','km'=>8],
        '110063' => ['name'=>'Gandhi Nagar','km'=>7],
        '201010' => ['name'=>'Noida Sector-1','km'=>8],
        '201301' => ['name'=>'Noida Sector-14','km'=>9],
        '201302' => ['name'=>'Noida Sector-25','km'=>9],
        '110076' => ['name'=>'Laxmi Nagar','km'=>6],
        '110092' => ['name'=>'Nirman Vihar','km'=>4],
    ];

    // ── PUBLIC: Check delivery area (AJAX — no auth) ────────
   public function checkDeliveryArea(Request $request)
{
    $pincode = trim($request->input('pincode', ''));
    $lat     = $request->input('lat');
    $lng     = $request->input('lng');

    if ($lat && $lng) {
        $km = $this->haversine($lat, $lng, self::STORE_LAT, self::STORE_LNG);
        $response = $this->deliveryResponse($pincode ?: 'auto', $km, $request->input('area_name'));
    } elseif (strlen($pincode) === 6 && is_numeric($pincode)) {
        if (array_key_exists($pincode, self::SERVICEABLE_PINCODES)) {
            $info = self::SERVICEABLE_PINCODES[$pincode];
            $response = $this->deliveryResponse($pincode, $info['km'], $info['name']);
        } else {
            $prefix = substr($pincode, 0, 3);
            if (in_array($prefix, ['110', '201'])) {
                $response = $this->deliveryResponse($pincode, 8, 'Delhi NCR area');
            } else {
                return response()->json([
                    'serviceable' => false,
                    'message'     => '❌ Sorry, we don\'t deliver to this pincode yet.',
                    'sub'         => 'We currently deliver within 10km of Mayur Vihar Phase-1, Delhi.',
                    'charge'      => null,
                ]);
            }
        }
    } else {
        return response()->json(['serviceable' => false, 'message' => '❌ Enter a valid 6-digit pincode.']);
    }

    // ✅ Save km in session so checkout index/placeOrder can use it
    $data = json_decode($response->getContent(), true);
    if (!empty($data['serviceable'])) {
        session(['delivery_km' => $data['km'] ?? 0]);
        session(['delivery_pincode' => $pincode]);
    }

    return $response;
}
    // ── HELPER: Build delivery response ────────────────────
    private function deliveryResponse($pincode, $km, $areaName = null)
    {
        if ($km > self::MAX_RADIUS_KM) {
            return response()->json([
                'serviceable' => false,
                'message'     => "❌ Pincode {$pincode} is out of our delivery zone.",
                'sub'         => 'We deliver within 10km of Mayur Vihar Phase-1.',
                'charge'      => null,
                'km'          => round($km, 1),
            ]);
        }

        $charge = 0;
        $chargeNote = '';
        if ($km <= 5) {
            $charge     = self::CHARGE_NEAR;
            $chargeNote = '₹' . self::CHARGE_NEAR . ' delivery fee (under 5km)';
        } else {
            $charge     = self::CHARGE_FAR;
            $chargeNote = '₹' . self::CHARGE_FAR . ' delivery fee (5–10km)';
        }

        $areaText = $areaName ? " ({$areaName})" : '';

        return response()->json([
            'serviceable' => true,
            'message'     => "✅ Delivery available to pincode {$pincode}{$areaText}!",
            'sub'         => "~{$km}km from our store · " .
                             ($charge == 0 ? 'FREE delivery' : $chargeNote) .
                             ' · FREE above ₹2000',
            'charge'      => $charge,
            'km'          => round($km, 1),
            'area'        => $areaName,
            'free_above'  => self::FREE_ABOVE,
        ]);
    }

    // ── HAVERSINE FORMULA: Distance between two coords ──────
    private function haversine($lat1, $lng1, $lat2, $lng2): float
    {
        $R = 6371; // Earth radius km
        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);
        $a = sin($dLat/2) * sin($dLat/2)
           + cos(deg2rad($lat1)) * cos(deg2rad($lat2))
           * sin($dLng/2) * sin($dLng/2);
        return $R * 2 * atan2(sqrt($a), sqrt(1 - $a));
    }

    // ── CHECKOUT: Auth-protected check ─────────────────────
    public function checkDelivery(Request $request)
    {
        return $this->checkDeliveryArea($request);
    }

    // ── CHECKOUT INDEX ──────────────────────────────────────
    public function index(Request $request)
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $products = [];
        $subtotal = 0;

        foreach ($cart as $id => $item) {
            $product = Product::active()->find($id);
            if ($product) {
                $qty       = $item['qty'] ?? 1;
                $subtotal += $product->current_price * $qty;
                $products[] = ['product' => $product, 'qty' => $qty];
            }
        }

        // Delivery charge calculation
        $delivery = $this->calcDelivery($subtotal, $request->session()->get('delivery_km', 0));
        $total    = $subtotal + $delivery;

        

        // Saved addresses
        $addresses = Auth::user()->addresses ?? collect();

        return view('frontend.checkout', compact('products', 'subtotal', 'delivery', 'total', 'addresses'));
    }

    // ── CALC DELIVERY CHARGE ────────────────────────────────
    public function calcDelivery($subtotal, $km = 0): int
    {
        if ($subtotal >= self::FREE_ABOVE) return 0;
        if ($km <= 0) return self::CHARGE_NEAR; // default if no location
        if ($km <= 5) return self::CHARGE_NEAR;
        if ($km <= self::MAX_RADIUS_KM) return self::CHARGE_FAR;
        return self::CHARGE_FAR; // max
    }

    // ── PLACE ORDER ─────────────────────────────────────────
  public function placeOrder(Request $request)
{
    $request->validate([
        'name'     => 'required|string|max:100',
        'phone'    => 'required|digits:10',
        'address'  => 'required|string|max:300',
        'city'     => 'required|string|max:80',
        'state'    => 'required|string|max:80',
        'pincode'  => 'required|digits:6',
        'payment'  => 'required|in:cod,online,upi',
    ]);

    $cart = session('cart', []);
    if (empty($cart)) {
        return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
    }

    // ✅ Prefer km from hidden field (location-based), fallback to pincode check
    $km = (float) $request->input('delivery_km', 0);

    if ($km <= 0 || $km > self::MAX_RADIUS_KM) {
        $pincodeCheck = $this->checkDeliveryArea(new Request(['pincode' => $request->pincode]));
        $checkData    = json_decode($pincodeCheck->getContent(), true);

        if (!$checkData['serviceable']) {
            return back()->withInput()
                ->with('error', 'Sorry, we don\'t deliver to pincode ' . $request->pincode . '. We deliver within 10km of Mayur Vihar Phase-1, Delhi.');
        }
        $km = $checkData['km'] ?? 0;
    }

    if ($km > self::MAX_RADIUS_KM) {
        return back()->withInput()
            ->with('error', 'Sorry, your location is outside our 10km delivery zone (Mayur Vihar Phase-1, Delhi).');
    }

    $subtotal    = 0;
$orderItems  = [];

foreach ($cart as $productId => $item) {
    $product = Product::active()->find($productId);
    if (!$product) continue;
    $qty       = $item['qty'] ?? 1;
    $subtotal += $product->current_price * $qty;
    $orderItems[] = ['product' => $product, 'qty' => $qty, 'price' => $product->current_price];
}
    $delivery = $this->calcDelivery($subtotal, $km);
    $total    = $subtotal + $delivery;

    // ... rest same (DB transaction etc.)

        DB::beginTransaction();
        try {
                $order = Order::create([
                'user_id'          => Auth::id(),
                'delivery_name'    => $request->name,
                'delivery_phone'   => $request->phone,
                'delivery_address' => $request->address,
                'delivery_city'    => $request->city,
                'delivery_state'   => $request->state,
                'delivery_pincode' => $request->pincode,
                'notes'            => $request->notes,
                'payment_method'   => $request->payment,
                'payment_status'   => 'pending',
                'status'           => 'pending',
                'subtotal'         => $subtotal,
                'delivery_charge'  => $delivery,
                'total'            => $total,
            ]);
foreach ($orderItems as $item) {
    OrderItem::create([
        'order_id'      => $order->id,
        'product_id'    => $item['product']->id,
        'product_name'  => $item['product']->name,
        'product_image' => $item['product']->thumbnail ?? $item['product']->image ?? null,
        'price'         => $item['price'],
        'quantity'      => $item['qty'],
        'subtotal'      => $item['price'] * $item['qty'],
    ]);

    $item['product']->decrement('stock_quantity', $item['qty']);
}

            DB::commit();

            // Clear cart
            session()->forget('cart');
            session()->forget('delivery_km');

            return redirect()->route('checkout.success', $order->order_number)
                ->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Order failed. Please try again. ' . $e->getMessage());
        }
    }

    // ── ORDER SUCCESS ───────────────────────────────────────
    public function success($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)
            ->where('user_id', Auth::id())
            ->with('items.product')
            ->firstOrFail();

        return view('frontend.order-success', compact('order'));
    }

    // ── ORDER FAILED ────────────────────────────────────────
    public function failed()
    {
        return view('frontend.order-failed');
    }

    // ── PAYMENT VERIFY (Razorpay) ───────────────────────────
    public function verifyPayment(Request $request)
    {
        // Razorpay integration placeholder
        return response()->json(['status' => 'ok']);
    }
}