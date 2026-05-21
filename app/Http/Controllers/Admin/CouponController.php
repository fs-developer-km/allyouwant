<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::latest()->paginate(15);
        return view('admin.coupons.index', compact('coupons'));
    }
    public function create() { return view('admin.coupons.create'); }
    public function store(Request $request)
    {
        $request->validate(['code'=>'required|unique:coupons,code','type'=>'required','value'=>'required|numeric|min:0']);
        $data = $request->only(['code','description','type','value','min_order_amount','max_discount','usage_limit','per_user_limit','start_date','end_date']);
        $data['is_active'] = $request->has('is_active');
        Coupon::create($data);
        return redirect()->route('admin.coupons.index')->with('success','Coupon created!');
    }
    public function edit(Coupon $coupon) { return view('admin.coupons.edit', compact('coupon')); }
    public function update(Request $request, Coupon $coupon)
    {
        $data = $request->only(['code','description','type','value','min_order_amount','max_discount','usage_limit','per_user_limit','start_date','end_date']);
        $data['is_active'] = $request->has('is_active');
        $coupon->update($data);
        return redirect()->route('admin.coupons.index')->with('success','Coupon updated!');
    }
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('admin.coupons.index')->with('success','Coupon deleted!');
    }
    public function toggleStatus($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->update(['is_active'=>!$coupon->is_active]);
        return response()->json(['success'=>true,'status'=>$coupon->is_active]);
    }
}
