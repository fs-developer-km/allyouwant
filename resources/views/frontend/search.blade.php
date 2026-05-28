@extends('frontend.layouts.app')

@section('title', 'Shop')



@section('content')
<div class="wrap" style="max-width:1280px;margin:0 auto;padding:24px 20px">

  {{-- Search Header --}}
  <div style="margin-bottom:20px">
    <h2 style="font-size:20px;font-weight:700;color:#1a1a2e">
      Search Results
      @if($q)
        for "<span style="color:#16a34a">{{ $q }}</span>"
      @endif
    </h2>
    <p style="color:#9ca3af;font-size:13px;margin-top:4px">
      {{ $products->total() }} products found
    </p>
  </div>

  {{-- Products Grid --}}
  <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px">
    @forelse($products as $product)
    <div style="background:#fff;border:1.5px solid #e2e8f0;border-radius:12px;overflow:hidden">
      <a href="{{ route('product.show', $product->slug) }}">
        <div style="height:160px;background:#f8fafc;display:flex;align-items:center;justify-content:center;font-size:60px">
          @if($product->thumbnail)
            <img src="{{ asset('storage/'.$product->thumbnail) }}" alt="{{ $product->name }}"
              style="width:100%;height:100%;object-fit:cover">
          @else
            🛒
          @endif
        </div>
      </a>
      <div style="padding:13px">
        <div style="font-size:11px;color:#16a34a;font-weight:600;margin-bottom:4px">
          {{ $product->category->name ?? '' }}
        </div>
        <a href="{{ route('product.show', $product->slug) }}" style="text-decoration:none;color:#1a1a2e;font-size:13.5px;font-weight:600">
          {{ $product->name }}
        </a>
        <div style="display:flex;align-items:center;justify-content:space-between;margin-top:10px">
          <div>
            <div style="font-size:18px;font-weight:800;color:#16a34a">
              ₹{{ number_format($product->sale_price ?? $product->price) }}
            </div>
            @if($product->sale_price)
              <div style="font-size:12px;color:#9ca3af;text-decoration:line-through">
                ₹{{ number_format($product->price) }}
              </div>
            @endif
          </div>
          <form action="{{ route('cart.add') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="qty" value="1">
            <button type="submit"
              style="width:34px;height:34px;background:#16a34a;border:none;border-radius:8px;color:#fff;font-size:20px;cursor:pointer">
              +
            </button>
          </form>
        </div>
      </div>
    </div>
    @empty
    <div style="text-align:center;padding:64px 20px;grid-column:1/-1">
      <div style="font-size:56px;margin-bottom:16px">🔍</div>
      <div style="font-size:18px;font-weight:600;color:#374151">No products found</div>
      <div style="font-size:14px;color:#9ca3af;margin-top:6px">Try a different keyword</div>
      <a href="{{ route('shop') }}"
        style="display:inline-block;margin-top:16px;background:#16a34a;color:#fff;padding:10px 24px;border-radius:8px;font-weight:600;font-size:13px">
        Browse All Products
      </a>
    </div>
    @endforelse
  </div>

  {{-- Pagination --}}
  @if($products->hasPages())
  <div style="margin-top:28px;display:flex;justify-content:center;gap:4px">
    @if(!$products->onFirstPage())
      <a href="{{ $products->previousPageUrl() }}"
        style="width:36px;height:36px;border-radius:8px;display:flex;align-items:center;justify-content:center;border:1.5px solid #e2e8f0;color:#374151;text-decoration:none">‹</a>
    @endif
    @foreach($products->getUrlRange(1, $products->lastPage()) as $page => $url)
      <a href="{{ $url }}"
        style="width:36px;height:36px;border-radius:8px;display:flex;align-items:center;justify-content:center;border:1.5px solid {{ $products->currentPage()==$page ? '#16a34a' : '#e2e8f0' }};background:{{ $products->currentPage()==$page ? '#16a34a' : '#fff' }};color:{{ $products->currentPage()==$page ? '#fff' : '#374151' }};text-decoration:none;font-size:13px;font-weight:500">
        {{ $page }}
      </a>
    @endforeach
    @if($products->hasMorePages())
      <a href="{{ $products->nextPageUrl() }}"
        style="width:36px;height:36px;border-radius:8px;display:flex;align-items:center;justify-content:center;border:1.5px solid #e2e8f0;color:#374151;text-decoration:none">›</a>
    @endif
  </div>
  @endif

</div>
@endsection