<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    private function getCart() { return session()->get('cart', []); }
    private function saveCart($cart) { session()->put('cart', $cart); }

    public function index()
    {
        $cart     = $this->getCart();
        $products = [];
        $total    = 0;
        foreach ($cart as $id => $qty) {
            $p = Product::find($id);
            if ($p) { $products[] = ['product'=>$p,'qty'=>$qty]; $total += $p->current_price * $qty; }
        }
        return view('frontend.cart', compact('products','total'));
    }

    public function add(Request $request)
    {
        $request->validate(['product_id'=>'required|exists:products,id','qty'=>'integer|min:1']);
        $cart = $this->getCart();
        $id   = $request->product_id;
        $cart[$id] = ($cart[$id] ?? 0) + ($request->qty ?? 1);
        $this->saveCart($cart);
        return back()->with('success','Product added to cart!');
    }

    public function update(Request $request, $id)
    {
        $cart = $this->getCart();
        if ($request->qty < 1) unset($cart[$id]);
        else $cart[$id] = $request->qty;
        $this->saveCart($cart);
        return back()->with('success','Cart updated!');
    }

    public function remove($id)
    {
        $cart = $this->getCart();
        unset($cart[$id]);
        $this->saveCart($cart);
        return back()->with('success','Item removed!');
    }

    public function applyCoupon(Request $request)
    {
        return back()->with('info','Coupon feature coming soon!');
    }

    public function checkout()
    {
        $cart = $this->getCart();
        if (empty($cart)) return redirect()->route('cart.index')->with('error','Your cart is empty!');
        $products = [];
        $subtotal = 0;
        foreach ($cart as $id => $qty) {
            $p = Product::find($id);
            if ($p) { $products[] = ['product'=>$p,'qty'=>$qty]; $subtotal += $p->current_price * $qty; }
        }
        $delivery = $subtotal >= 499 ? 0 : 40;
        $total    = $subtotal + $delivery;
        $addresses= Auth::user()->addresses;
        return view('frontend.checkout', compact('products','subtotal','delivery','total','addresses'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'name'    => 'required|string',
            'phone'   => 'required|string',
            'address' => 'required|string',
            'city'    => 'required|string',
            'state'   => 'required|string',
            'pincode' => 'required|string',
            'payment' => 'required|in:cod,online',
        ]);
        $cart     = $this->getCart();
        $subtotal = 0;
        $items    = [];
        foreach ($cart as $id => $qty) {
            $p = Product::find($id);
            if ($p) { $sub = $p->current_price * $qty; $subtotal += $sub; $items[] = ['product'=>$p,'qty'=>$qty,'price'=>$p->current_price,'subtotal'=>$sub]; }
        }
        $delivery = $subtotal >= 499 ? 0 : 40;
        $total    = $subtotal + $delivery;

        $order = Order::create([
            'user_id'          => Auth::id(),
            'delivery_name'    => $request->name,
            'delivery_phone'   => $request->phone,
            'delivery_address' => $request->address,
            'delivery_city'    => $request->city,
            'delivery_state'   => $request->state,
            'delivery_pincode' => $request->pincode,
            'subtotal'         => $subtotal,
            'delivery_charge'  => $delivery,
            'discount'         => 0,
            'tax'              => 0,
            'total'            => $total,
            'payment_method'   => $request->payment,
            'payment_status'   => 'pending',
            'status'           => 'pending',
        ]);

        foreach ($items as $item) {
            OrderItem::create([
                'order_id'      => $order->id,
                'product_id'    => $item['product']->id,
                'product_name'  => $item['product']->name,
                'product_image' => $item['product']->thumbnail,
                'price'         => $item['price'],
                'quantity'      => $item['qty'],
                'subtotal'      => $item['subtotal'],
            ]);
            if ($item['product']->track_inventory) {
                $item['product']->decrement('stock_quantity', $item['qty']);
            }
        }
        session()->forget('cart');
        return redirect()->route('checkout.success', $order->id)->with('success','Order placed successfully!');
    }

    public function success($id)
    {
        $order = Order::with('items')->findOrFail($id);
        return view('frontend.order-success', compact('order'));
    }
}
