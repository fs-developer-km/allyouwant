@extends('frontend.layouts.app')
@section('title','Offers')
@section('content')
<div style="max-width:1200px;margin:0 auto;padding:24px 20px">
  <h1 style="font-size:24px;font-weight:700;margin-bottom:20px">🔥 Today's Offers</h1>
  <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:16px">
    @forelse($products as $p)
    <div style="background:#fff;border-radius:12px;overflow:hidden;border:1px solid #e2e8f0;padding:16px">
      <div style="font-size:11px;font-weight:700;color:#dc2626;background:#fef2f2;padding:3px 8px;border-radius:5px;display:inline-block;margin-bottom:8px">{{ $p->discount_percent }}% OFF</div>
      <div style="font-size:14px;font-weight:600">{{ $p->name }}</div>
      <div style="margin-top:8px;display:flex;justify-content:space-between;align-items:center">
        <div><span style="font-size:16px;font-weight:700;color:#16a34a">₹{{ $p->current_price }}</span> <span style="font-size:12px;color:#9ca3af;text-decoration:line-through">₹{{ $p->price }}</span></div>
        <form action="{{ route('cart.add') }}" method="POST">@csrf<input type="hidden" name="product_id" value="{{ $p->id }}"><button style="background:#16a34a;color:#fff;border:none;padding:6px 14px;border-radius:7px;cursor:pointer">Add</button></form>
      </div>
    </div>
    @empty
    <p style="color:#9ca3af">No offers right now. Check back soon!</p>
    @endforelse
  </div>
</div>
@endsection
