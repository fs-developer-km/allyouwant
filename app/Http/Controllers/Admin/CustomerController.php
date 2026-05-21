<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role','customer')->latest();
        if ($request->search) $query->where('name','like','%'.$request->search.'%')->orWhere('email','like','%'.$request->search.'%');
        $customers = $query->paginate(15)->withQueryString();
        return view('admin.customers.index', compact('customers'));
    }
    public function show($id)
    {
        $customer = User::where('role','customer')->with(['orders'])->findOrFail($id);
        return view('admin.customers.show', compact('customer'));
    }
}
