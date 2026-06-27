@extends('frontend.layouts.app')
@section('title', 'Shop')
@section('content')

@push('styles')
<style>
:root{--green:#0d6e39;--green-dark:#0a5a2e;--green-light:#f0faf4;--border:#e8edf0}

/* ── BREADCRUMB ── */
.breadcrumb{background:#fff;border-bottom:1px solid var(--border);padding:10px 0}
.bc-inner{max-width:1320px;margin:0 auto;padding:0 20px;display:flex;align-items:center;gap:6px;font-size:13px;color:#9ca3af;flex-wrap:wrap}
.bc-inner a{color:var(--green);font-weight:500}

/* ── SUB-CAT HORIZONTAL STRIP (sticky below navbar, desktop + mobile) ── */
.subcat-strip-wrap{background:#fff;border-bottom:2px solid var(--border);position:sticky;top:66px;z-index:300;min-height:0;transition:all .2s}
.subcat-strip-wrap.hidden{display:none}
.subcat-strip-inner{max-width:1320px;margin:0 auto;padding:0 16px;display:flex;align-items:center;gap:0;overflow-x:auto;scrollbar-width:none}
.subcat-strip-inner::-webkit-scrollbar{display:none}
.subcat-pill{display:inline-flex;align-items:center;gap:7px;padding:10px 16px;font-size:13px;font-weight:500;color:#4b5563;white-space:nowrap;border-bottom:2.5px solid transparent;transition:all .15s;text-decoration:none;flex-shrink:0;margin-bottom:-2px}
.subcat-pill:hover{color:var(--green);border-bottom-color:var(--green)}
.subcat-pill.active{color:var(--green);font-weight:700;border-bottom-color:var(--green)}
.subcat-pill-img{width:26px;height:26px;border-radius:50%;overflow:hidden;background:#f3f4f6;display:flex;align-items:center;justify-content:center;font-size:14px;flex-shrink:0;border:1.5px solid var(--border)}
.subcat-pill-img img{width:100%;height:100%;object-fit:cover}
.subcat-pill.active .subcat-pill-img{border-color:var(--green)}
.subcat-pill-cnt{font-size:10.5px;color:#9ca3af;background:#f3f4f6;padding:1px 6px;border-radius:9px}
.subcat-pill.active .subcat-pill-cnt{background:var(--green-light);color:var(--green)}
/* All pill special */
.subcat-all-pill{padding:10px 18px;font-size:13px;font-weight:600;color:#4b5563;border-bottom:2.5px solid transparent;text-decoration:none;white-space:nowrap;flex-shrink:0;margin-bottom:-2px;display:flex;align-items:center;gap:5px;transition:all .15s}
.subcat-all-pill:hover{color:var(--green);border-bottom-color:var(--green)}
.subcat-all-pill.active{color:var(--green);font-weight:700;border-bottom-color:var(--green)}
.subcat-strip-divider{width:1px;height:22px;background:var(--border);flex-shrink:0;margin:0 6px}

/* ── MAIN LAYOUT ── */
.wrap{max-width:1320px;margin:0 auto;padding:22px 20px}
.shop-layout{display:grid;grid-template-columns:252px 1fr;gap:22px;align-items:start}

/* ── SIDEBAR ── */
.sidebar{background:#fff;border:1px solid var(--border);border-radius:14px;overflow:hidden;position:sticky;top:130px;box-shadow:0 1px 6px rgba(0,0,0,.05)}
.sb-sec{border-bottom:1px solid #f1f5f9}
.sb-sec:last-child{border-bottom:none}
.sb-head{padding:13px 16px;font-size:11px;font-weight:700;color:#9ca3af;text-transform:uppercase;letter-spacing:.5px;background:#fafafa;border-bottom:1px solid #f1f5f9}

/* Category list in sidebar */
.sb-cat-item{display:flex;align-items:center;gap:10px;padding:10px 14px;font-size:13.5px;color:#374151;text-decoration:none;transition:all .15s;border-left:3px solid transparent;cursor:pointer;border:none;background:none;width:100%;text-align:left;font-family:inherit}
.sb-cat-item:hover{background:var(--green-light);color:var(--green)}
.sb-cat-item.active{background:var(--green-light);color:var(--green);font-weight:700;border-left:3px solid var(--green)}
.sb-cat-img{width:34px;height:34px;border-radius:9px;background:#f3f4f6;display:flex;align-items:center;justify-content:center;font-size:18px;overflow:hidden;flex-shrink:0;border:1px solid var(--border)}
.sb-cat-img img{width:100%;height:100%;object-fit:cover}
.sb-cat-name{flex:1;font-size:13px;font-weight:500}
.sb-cat-cnt{font-size:11px;color:#9ca3af;background:#f3f4f6;padding:2px 7px;border-radius:9px;flex-shrink:0}
.sb-cat-item.active .sb-cat-cnt{background:rgba(13,110,57,.12);color:var(--green)}
/* Sub-cat list in sidebar (shown when parent selected) */
.sb-subcat-list{background:#fafcfb;border-top:1px solid #f1f5f9}
.sb-subcat-item{display:flex;align-items:center;gap:8px;padding:8px 14px 8px 24px;font-size:12.5px;color:#4b5563;text-decoration:none;transition:all .15s;border-left:3px solid transparent}
.sb-subcat-item:hover{background:var(--green-light);color:var(--green)}
.sb-subcat-item.active{background:var(--green-light);color:var(--green);font-weight:700;border-left:3px solid var(--green)}
.sb-subcat-dot{width:6px;height:6px;border-radius:50%;background:#d1d5db;flex-shrink:0}
.sb-subcat-item.active .sb-subcat-dot{background:var(--green)}
.sb-subcat-img{width:24px;height:24px;border-radius:6px;background:#f3f4f6;display:flex;align-items:center;justify-content:center;font-size:13px;overflow:hidden;flex-shrink:0}
.sb-subcat-img img{width:100%;height:100%;object-fit:cover}
.sb-subcat-cnt{margin-left:auto;font-size:10.5px;color:#9ca3af;background:#f3f4f6;padding:1px 6px;border-radius:8px}

/* Price + availability filters */
.sb-filter{padding:14px 16px}
.sb-filter-label{font-size:12px;font-weight:700;color:#374151;margin-bottom:8px;text-transform:uppercase;letter-spacing:.3px}
.price-row{display:flex;align-items:center;gap:6px}
.price-inp{width:90px;padding:7px 10px;border:1.5px solid var(--border);border-radius:8px;font-size:13px;outline:none;font-family:inherit;transition:border-color .2s}
.price-inp:focus{border-color:var(--green)}
.filter-btn{width:100%;background:var(--green);color:#fff;border:none;padding:9px;border-radius:8px;font-size:13px;font-weight:600;cursor:pointer;margin-top:10px;font-family:inherit}
.avail-item{display:flex;align-items:center;gap:7px;padding:6px 0;font-size:13px;color:#374151;text-decoration:none;transition:color .15s;cursor:pointer}
.avail-item:hover{color:var(--green)}
.avail-item input[type=radio]{accent-color:var(--green);width:14px;height:14px;cursor:pointer}

/* ── TOPBAR ── */
.topbar-shop{display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;background:#fff;padding:10px 14px;border-radius:12px;border:1px solid var(--border);flex-wrap:wrap;gap:10px}
.results-info{font-size:13px;color:#64748b}
.results-info strong{color:#1a1a2e}
.topbar-right{display:flex;align-items:center;gap:8px}
.sort-select{padding:7px 12px;border:1.5px solid var(--border);border-radius:8px;font-size:13px;outline:none;background:#fff;cursor:pointer;font-family:inherit;color:#374151}
.sort-select:focus{border-color:var(--green)}
.view-toggle{display:flex;border:1.5px solid var(--border);border-radius:8px;overflow:hidden}
.view-btn{width:32px;height:32px;background:#fff;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:13px;color:#9ca3af;transition:all .15s}
.view-btn.active,.view-btn:hover{background:var(--green-light);color:var(--green)}

/* ── PRODUCT GRID ── */
.products-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(192px,1fr));gap:14px}
.products-grid.list-view{grid-template-columns:1fr;gap:10px}
.prod-card{background:#fff;border:1.5px solid var(--border);border-radius:12px;overflow:hidden;transition:all .22s cubic-bezier(.4,0,.2,1);position:relative}
.prod-card:hover{transform:translateY(-5px);box-shadow:0 16px 36px rgba(0,0,0,.11);border-color:#b7e4c7}
.prod-badge-abs{position:absolute;top:9px;left:9px;font-size:10px;font-weight:700;padding:3px 8px;border-radius:4px;z-index:2}
.badge-sale{background:#ff3b30;color:#fff}.badge-new{background:var(--green);color:#fff}
.badge-hot{background:#f97316;color:#fff}.badge-out{background:#94a3b8;color:#fff}
.prod-img{height:160px;background:#fff;display:flex;align-items:center;justify-content:center;overflow:hidden;font-size:68px}
.prod-img img{width:100%;height:100%;object-fit:contain;padding:8px;transition:transform .35s}
.prod-card:hover .prod-img img{transform:scale(1.07)}
.prod-body{padding:12px 13px 13px}
.prod-cat{font-size:10px;font-weight:700;color:var(--green);text-transform:uppercase;letter-spacing:.4px;margin-bottom:4px}
.prod-name{font-size:13.5px;font-weight:600;color:#1a1a2e;line-height:1.3;margin-bottom:3px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
.prod-weight{font-size:11.5px;color:#9ca3af;margin-bottom:8px}
.prod-footer{display:flex;align-items:flex-end;justify-content:space-between;gap:6px}
.prod-price{font-size:17px;font-weight:800;color:var(--green);line-height:1}
.prod-old{font-size:11.5px;color:#9ca3af;text-decoration:line-through;margin-top:2px}
.add-btn{width:34px;height:34px;background:var(--green);border:none;border-radius:9px;color:#fff;font-size:20px;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all .2s;flex-shrink:0}
.add-btn:hover{background:var(--green-dark);transform:scale(1.1)}
.add-btn:active{transform:scale(.93)}
.add-btn.added{background:#dcfce7;color:var(--green);font-size:14px}
.add-btn:disabled{background:#e2e8f0;color:#9ca3af;cursor:not-allowed;transform:none}

/* List view */
.products-grid.list-view .prod-card{display:flex}
.products-grid.list-view .prod-img{width:120px;height:110px;flex-shrink:0;font-size:48px}
.products-grid.list-view .prod-body{flex:1;display:flex;align-items:center;gap:16px;flex-wrap:wrap;padding:10px 14px 10px 8px}
.products-grid.list-view .prod-footer{margin-left:auto;flex-direction:column;align-items:flex-end;gap:6px}

/* Empty */
.empty-state{text-align:center;padding:72px 20px;grid-column:1/-1}
.empty-icon{font-size:64px;margin-bottom:14px}
.empty-title{font-size:20px;font-weight:700;margin-bottom:7px}
.empty-sub{font-size:14px;color:#9ca3af;margin-bottom:20px}

/* Pagination */
.pagination-wrap{margin-top:28px;display:flex;justify-content:center;gap:5px}
.page-item{width:36px;height:36px;border-radius:8px;border:1.5px solid var(--border);background:#fff;font-size:13px;font-weight:500;color:#374151;display:flex;align-items:center;justify-content:center;text-decoration:none;transition:all .15s}
.page-item:hover{border-color:var(--green);color:var(--green)}
.page-item.active{background:var(--green);color:#fff;border-color:var(--green)}
.page-item.disabled{opacity:.4;pointer-events:none}

/* Toast */
.toast-wrap{position:fixed;bottom:22px;left:50%;transform:translateX(-50%);z-index:9999;display:flex;flex-direction:column;align-items:center;gap:7px;pointer-events:none}
.toast{background:var(--green);color:#fff;padding:11px 22px;border-radius:50px;font-size:13.5px;font-weight:600;box-shadow:0 6px 24px rgba(0,0,0,.18);animation:tIn .3s ease;white-space:nowrap}
@keyframes tIn{from{opacity:0;transform:translateY(12px)}to{opacity:1;transform:translateY(0)}}

/* Mobile filter btn */
.mob-filter-fab{display:none;position:fixed;bottom:76px;right:16px;background:var(--green);color:#fff;border:none;border-radius:50px;padding:11px 18px;font-size:13px;font-weight:700;cursor:pointer;z-index:200;box-shadow:0 6px 20px rgba(13,110,57,.35);font-family:inherit;align-items:center;gap:7px}
.mob-filter-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:400}
.mob-filter-panel{position:fixed;left:0;bottom:0;right:0;background:#fff;border-radius:20px 20px 0 0;padding:20px 18px 36px;max-height:85vh;overflow-y:auto;transform:translateY(100%);transition:transform .3s;z-index:401}
.mob-filter-panel.open{transform:translateY(0)}
.mob-filter-overlay.open,.mob-filter-fab.show{display:flex}
.mob-handle{width:36px;height:4px;background:#e2e8f0;border-radius:2px;margin:0 auto 18px}

/* ── RESPONSIVE ── */
@media(max-width:1024px){.shop-layout{grid-template-columns:220px 1fr}}
@media(max-width:768px){
  .shop-layout{grid-template-columns:1fr}
  .sidebar{display:none}
  .mob-filter-fab{display:flex}
  .products-grid{grid-template-columns:repeat(2,1fr);gap:10px}
  .subcat-strip-wrap{top:58px}
  .sidebar{top:unset}
  .wrap{padding:14px 12px}
}
@media(max-width:400px){.products-grid{gap:8px}}
</style>
@endpush

@php
  $icons = ['Vegetables'=>'🥬','Fruits'=>'🍎','Dairy & Eggs'=>'🥛','Meat & Fish'=>'🍗',
    'Bakery'=>'🧁','Beverages'=>'🧃','Cold Drinks & Juices'=>'🥤','Instant Food'=>'🍜',
    'Personal Care'=>'🧴','Household'=>'🏠','Pet Care'=>'🐾'];

  // Selected category
  $selectedCatId  = request('category');
  $selectedSubId  = request('sub_category');
  $selectedCat    = $selectedCatId ? $categories->firstWhere('id', $selectedCatId) : null;

  // Sub-categories of selected parent
  $subCats = collect();
  if ($selectedCat) {
    // If selected cat has parent_id, it IS a sub-cat — find its parent and siblings
    if ($selectedCat->parent_id) {
      $parentCat = $categories->firstWhere('id', $selectedCat->parent_id);
      $subCats   = $categories->where('parent_id', $selectedCat->parent_id)->values();
    } else {
      // It's a parent — get its children
      $subCats = $categories->where('parent_id', $selectedCat->id)->values();
    }
  }

  // For sidebar: only show parent (top-level) categories
  $parentCats = $categories->whereNull('parent_id')->values();
@endphp

{{-- BREADCRUMB --}}
<div class="breadcrumb">
  <div class="bc-inner">
    <a href="{{ route('home') }}">🏠 Home</a> <span>›</span>
    @if($selectedCat)
      <a href="{{ route('shop') }}">Shop</a> <span>›</span>
      @if($selectedCat->parent_id)
        @php $par = $categories->firstWhere('id', $selectedCat->parent_id); @endphp
        @if($par)<a href="{{ route('shop') }}?category={{ $par->id }}">{{ $par->name }}</a><span>›</span>@endif
      @endif
      <span style="color:#374151;font-weight:600">{{ $selectedCat->name }}</span>
    @else
      <span style="color:#374151;font-weight:600">All Products</span>
    @endif
  </div>
</div>

{{-- SUB-CATEGORY STRIP (visible when a parent category is selected and has sub-cats) --}}
<div class="subcat-strip-wrap {{ $subCats->isEmpty() ? 'hidden' : '' }}" id="subcatStrip">
  <div class="subcat-strip-inner">

    {{-- "All [CategoryName]" pill --}}
    @if($selectedCat)
      @php
        $parentForAll = $selectedCat->parent_id
          ? $categories->firstWhere('id', $selectedCat->parent_id)
          : $selectedCat;
      @endphp
      <a href="{{ route('shop') }}?category={{ $parentForAll->id }}"
         class="subcat-all-pill {{ (!$selectedCat->parent_id && !$selectedSubId) ? 'active' : '' }}">
        🗂️ All {{ $parentForAll->name }}
      </a>
      <div class="subcat-strip-divider"></div>
    @endif

    {{-- Sub-cat pills --}}
    @foreach($subCats as $sc)
    @php
      $isActive = ($selectedCat && $selectedCat->id == $sc->id) ||
                  ($selectedSubId && $selectedSubId == $sc->id);
    @endphp
    <a href="{{ route('shop') }}?category={{ $sc->id }}"
       class="subcat-pill {{ $isActive ? 'active' : '' }}">
      <div class="subcat-pill-img">
        @if($sc->image)<img src="{{ asset('storage/'.$sc->image) }}" alt="{{ $sc->name }}">
        @else{{ $icons[$sc->name] ?? '🛒' }}@endif
      </div>
      {{ $sc->name }}
      <span class="subcat-pill-cnt">{{ $sc->activeProducts->count() }}</span>
    </a>
    @endforeach

  </div>
</div>

{{-- MAIN --}}
<div class="wrap">
  <div class="shop-layout">

    {{-- ── SIDEBAR ── --}}
    <aside class="sidebar">
      <div class="sb-head">🗂️ Categories</div>

      {{-- All Products --}}
      <a href="{{ route('shop') }}" class="sb-cat-item {{ !$selectedCatId ? 'active' : '' }}">
        <div class="sb-cat-img">🛒</div>
        <span class="sb-cat-name">All Products</span>
        <span class="sb-cat-cnt">{{ $products->total() }}</span>
      </a>

      {{-- Parent categories with images --}}
      @foreach($parentCats as $cat)
      @php
        $catIcon      = $icons[$cat->name] ?? '🛒';
        $isSelected   = $selectedCatId == $cat->id || ($selectedCat && $selectedCat->parent_id == $cat->id);
        $catSubCats   = $categories->where('parent_id', $cat->id)->values();
        $hasChildren  = $catSubCats->count() > 0;
      @endphp

      <a href="{{ route('shop') }}?category={{ $cat->id }}"
         class="sb-cat-item {{ $isSelected ? 'active' : '' }}">
        <div class="sb-cat-img">
          @if($cat->image)<img src="{{ asset('storage/'.$cat->image) }}" alt="{{ $cat->name }}">
          @else{{ $catIcon }}@endif
        </div>
        <span class="sb-cat-name">{{ $cat->name }}</span>
        <span class="sb-cat-cnt">{{ $cat->activeProducts->count() }}</span>
      </a>

      {{-- Show sub-categories inline in sidebar when this parent is selected --}}
      @if($isSelected && $hasChildren)
      <div class="sb-subcat-list">
        {{-- "All" sub option --}}
        <a href="{{ route('shop') }}?category={{ $cat->id }}"
           class="sb-subcat-item {{ $selectedCatId == $cat->id && !($selectedCat && $selectedCat->parent_id) ? 'active' : ($selectedCat && !$selectedCat->parent_id ? 'active' : '') }}">
          <div class="sb-subcat-dot"></div>
          <span style="flex:1">All {{ $cat->name }}</span>
          <span class="sb-subcat-cnt">{{ $cat->activeProducts->count() }}</span>
        </a>
        @foreach($catSubCats as $sc)
        <a href="{{ route('shop') }}?category={{ $sc->id }}"
           class="sb-subcat-item {{ $selectedCatId == $sc->id ? 'active' : '' }}">
          <div class="sb-subcat-img">
            @if($sc->image)<img src="{{ asset('storage/'.$sc->image) }}" alt="{{ $sc->name }}">
            @else{{ $icons[$sc->name] ?? '🛒' }}@endif
          </div>
          <span style="flex:1;font-size:12.5px">{{ $sc->name }}</span>
          <span class="sb-subcat-cnt">{{ $sc->activeProducts->count() }}</span>
        </a>
        @endforeach
      </div>
      @endif

      @endforeach

      {{-- Price filter --}}
      <div class="sb-sec">
        <form method="GET" action="{{ route('shop') }}" id="filterForm">
          @if($selectedCatId)<input type="hidden" name="category" value="{{ $selectedCatId }}">@endif
          @if(request('sort'))<input type="hidden" name="sort" value="{{ request('sort') }}">@endif
          @if(request('stock'))<input type="hidden" name="stock" value="{{ request('stock') }}">@endif

          <div class="sb-filter">
            <div class="sb-filter-label">💰 Price Range</div>
            <div class="price-row">
              <input type="number" name="min_price" class="price-inp" placeholder="Min ₹" value="{{ request('min_price') }}">
              <span style="color:#9ca3af;font-size:12px">–</span>
              <input type="number" name="max_price" class="price-inp" placeholder="Max ₹" value="{{ request('max_price') }}">
            </div>
            <button type="submit" class="filter-btn">Apply</button>
          </div>

          <div class="sb-filter" style="padding-top:0">
            <div class="sb-filter-label">📦 Availability</div>
            @foreach([''=> 'All Products', 'instock'=>'✅ In Stock Only', 'sale'=>'🏷️ On Sale'] as $val => $lbl)
            <label class="avail-item">
              <input type="radio" name="stock" value="{{ $val }}" {{ request('stock')===$val ? 'checked':'' }} onchange="this.form.submit()">
              {{ $lbl }}
            </label>
            @endforeach
          </div>
        </form>
        @if(request()->hasAny(['category','min_price','max_price','stock','sort']))
          <div style="padding:0 16px 12px">
            <a href="{{ route('shop') }}" style="font-size:12.5px;color:var(--green);font-weight:600;text-decoration:none">✕ Clear All Filters</a>
          </div>
        @endif
      </div>
    </aside>

    {{-- ── PRODUCTS ── --}}
    <div>

      {{-- Topbar --}}
      <div class="topbar-shop">
        <div class="results-info">
          Showing <strong>{{ $products->count() }}</strong> of <strong>{{ $products->total() }}</strong>
          @if($selectedCat)
            in <strong>{{ $selectedCat->name }}</strong>
          @endif
        </div>
        <div class="topbar-right">
          <select class="sort-select" onchange="applySort(this.value)">
            <option value=""          {{ !request('sort')              ? 'selected':'' }}>Latest</option>
            <option value="price_asc" {{ request('sort')==='price_asc' ? 'selected':'' }}>Price ↑</option>
            <option value="price_desc"{{ request('sort')==='price_desc'? 'selected':'' }}>Price ↓</option>
            <option value="bestseller"{{ request('sort')==='bestseller'? 'selected':'' }}>Best Sellers</option>
            <option value="newest"    {{ request('sort')==='newest'    ? 'selected':'' }}>Newest</option>
          </select>
          <div class="view-toggle">
            <button class="view-btn active" id="gridBtn" onclick="setView('grid')" title="Grid">⊞</button>
            <button class="view-btn" id="listBtn" onclick="setView('list')" title="List">☰</button>
          </div>
        </div>
      </div>

      {{-- Grid --}}
      <div class="products-grid" id="productsGrid">
        @forelse($products as $product)
        @php $pIcon = $icons[$product->category->name ?? ''] ?? '🛒'; @endphp
        <div class="prod-card">
          @if(!$product->is_in_stock)<span class="prod-badge-abs badge-out">Out of Stock</span>
          @elseif($product->is_on_sale)<span class="prod-badge-abs badge-sale">{{ $product->discount_percent }}% OFF</span>
          @elseif($product->is_new_arrival)<span class="prod-badge-abs badge-new">NEW</span>
          @elseif($product->is_bestseller)<span class="prod-badge-abs badge-hot">🔥 BEST</span>@endif

          <a href="{{ route('product.show', $product->slug) }}">
            <div class="prod-img">
              @if($product->thumbnail)
                <img src="{{ asset('storage/'.$product->thumbnail) }}" alt="{{ $product->name }}" loading="lazy">
              @else{{ $pIcon }}@endif
            </div>
          </a>
          <div class="prod-body">
            <div class="prod-cat">{{ $product->category->name ?? '' }}</div>
            <a href="{{ route('product.show', $product->slug) }}" style="text-decoration:none;color:inherit">
              <div class="prod-name">{{ $product->name }}</div>
            </a>
            <div class="prod-weight">{{ $product->weight }} · per {{ $product->unit }}</div>
            <div class="prod-footer">
              <div>
                <div class="prod-price">₹{{ number_format($product->current_price) }}</div>
                @if($product->is_on_sale)
                  <div class="prod-old">₹{{ number_format($product->price) }}</div>
                @endif
              </div>
              @if($product->is_in_stock)
                <form action="{{ route('cart.add') }}" method="POST" style="margin:0">
                  @csrf
                  <input type="hidden" name="product_id" value="{{ $product->id }}">
                  <input type="hidden" name="qty" value="1">
                  <button type="submit" class="add-btn" onclick="cartAnim(this)">+</button>
                </form>
              @else
                <button class="add-btn" disabled>✕</button>
              @endif
            </div>
          </div>
        </div>
        @empty
        <div class="empty-state">
          <div class="empty-icon">🔍</div>
          <div class="empty-title">No products found</div>
          <div class="empty-sub">Try a different category or clear filters</div>
          <a href="{{ route('shop') }}" style="display:inline-block;background:var(--green);color:#fff;padding:11px 26px;border-radius:50px;font-size:14px;font-weight:600;text-decoration:none">Clear Filters</a>
        </div>
        @endforelse
      </div>

      {{-- Pagination --}}
      @if($products->hasPages())
      <div class="pagination-wrap">
        @if($products->onFirstPage())
          <span class="page-item disabled">‹</span>
        @else
          <a href="{{ $products->previousPageUrl() }}" class="page-item">‹</a>
        @endif
        @foreach($products->getUrlRange(max(1,$products->currentPage()-2), min($products->lastPage(),$products->currentPage()+2)) as $page => $url)
          <a href="{{ $url }}" class="page-item {{ $products->currentPage()==$page ? 'active':'' }}">{{ $page }}</a>
        @endforeach
        @if($products->hasMorePages())
          <a href="{{ $products->nextPageUrl() }}" class="page-item">›</a>
        @else
          <span class="page-item disabled">›</span>
        @endif
      </div>
      @endif

    </div>
  </div>
</div>

{{-- Mobile filter panel --}}
<button class="mob-filter-fab show" onclick="openMobFilter()">🔧 Filter & Sort</button>
<div class="mob-filter-overlay" id="mobFilterOverlay" onclick="closeMobFilter()"></div>
<div class="mob-filter-panel" id="mobFilterPanel">
  <div class="mob-handle"></div>
  <form method="GET" action="{{ route('shop') }}">
    @if($selectedCatId)<input type="hidden" name="category" value="{{ $selectedCatId }}">@endif
    <div style="font-size:15px;font-weight:700;margin-bottom:16px">Filters & Sort</div>

    <div style="font-size:11px;font-weight:700;color:#9ca3af;text-transform:uppercase;letter-spacing:.4px;margin-bottom:8px">Sort</div>
    <div style="display:flex;flex-wrap:wrap;gap:7px;margin-bottom:18px">
      @foreach(['newest'=>'Newest','price_asc'=>'Price ↑','price_desc'=>'Price ↓','bestseller'=>'Best Sellers'] as $val=>$lbl)
        <button type="submit" name="sort" value="{{ $val }}" style="padding:7px 14px;border-radius:50px;border:1.5px solid {{ request('sort')===$val ? 'var(--green)':'var(--border)' }};background:{{ request('sort')===$val ? 'var(--green)':'#fff' }};font-size:12.5px;font-weight:600;color:{{ request('sort')===$val ? '#fff':'#374151' }};cursor:pointer;font-family:inherit">{{ $lbl }}</button>
      @endforeach
    </div>

    <div style="font-size:11px;font-weight:700;color:#9ca3af;text-transform:uppercase;letter-spacing:.4px;margin-bottom:8px">Availability</div>
    <div style="display:flex;flex-wrap:wrap;gap:7px;margin-bottom:18px">
      @foreach([''=> 'All','instock'=>'✅ In Stock','sale'=>'🏷️ On Sale'] as $val=>$lbl)
        <button type="submit" name="stock" value="{{ $val }}" style="padding:7px 14px;border-radius:50px;border:1.5px solid {{ request('stock')===$val ? 'var(--green)':'var(--border)' }};background:{{ request('stock')===$val ? 'var(--green)':'#fff' }};font-size:12.5px;font-weight:600;color:{{ request('stock')===$val ? '#fff':'#374151' }};cursor:pointer;font-family:inherit">{{ $lbl }}</button>
      @endforeach
    </div>

    <div style="font-size:11px;font-weight:700;color:#9ca3af;text-transform:uppercase;letter-spacing:.4px;margin-bottom:8px">Price Range</div>
    <div style="display:flex;gap:8px;align-items:center;margin-bottom:14px">
      <input type="number" name="min_price" class="price-inp" placeholder="Min ₹" value="{{ request('min_price') }}" style="flex:1;width:auto">
      <span style="color:#9ca3af">–</span>
      <input type="number" name="max_price" class="price-inp" placeholder="Max ₹" value="{{ request('max_price') }}" style="flex:1;width:auto">
    </div>

    <div style="display:flex;gap:9px">
      <a href="{{ route('shop') }}" style="flex:1;padding:12px;border:1.5px solid var(--border);border-radius:9px;font-size:13.5px;font-weight:600;color:#374151;text-align:center;text-decoration:none">Clear All</a>
      <button type="submit" style="flex:1.4;padding:12px;background:var(--green);color:#fff;border:none;border-radius:9px;font-size:13.5px;font-weight:700;cursor:pointer;font-family:inherit">Apply</button>
    </div>
  </form>
</div>

{{-- Toast --}}
<div class="toast-wrap" id="toastWrap"></div>

@push('scripts')
<script>
// ── CART ANIMATION ──
function cartAnim(btn) {
  btn.innerHTML = '✓'; btn.classList.add('added');
  gToast('✅ Added to cart!');
  document.querySelectorAll('.cart-count-badge,.mbn-badge,.nav-badge,.cart-pill').forEach(el => {
    el.textContent = (parseInt(el.textContent) || 0) + 1;
    el.style.display = 'flex';
  });
  setTimeout(() => { btn.innerHTML = '+'; btn.classList.remove('added'); }, 1800);
}

// ── SORT ──
function applySort(val) {
  const url = new URL(window.location.href);
  if (val) url.searchParams.set('sort', val); else url.searchParams.delete('sort');
  url.searchParams.delete('page');
  window.location = url.toString();
}

// ── VIEW TOGGLE ──
function setView(v) {
  const g = document.getElementById('productsGrid');
  document.getElementById('gridBtn').classList.toggle('active', v === 'grid');
  document.getElementById('listBtn').classList.toggle('active', v === 'list');
  g.classList.toggle('list-view', v === 'list');
  localStorage.setItem('shopView', v);
}
if (localStorage.getItem('shopView') === 'list') setView('list');

// ── MOBILE FILTER ──
function openMobFilter() {
  document.getElementById('mobFilterPanel').classList.add('open');
  document.getElementById('mobFilterOverlay').classList.add('open');
  document.body.style.overflow = 'hidden';
}
function closeMobFilter() {
  document.getElementById('mobFilterPanel').classList.remove('open');
  document.getElementById('mobFilterOverlay').classList.remove('open');
  document.body.style.overflow = '';
}

// ── TOAST ──
function gToast(msg) {
  const w = document.getElementById('toastWrap'); if (!w) return;
  const t = document.createElement('div'); t.className = 'toast'; t.textContent = msg;
  w.appendChild(t);
  setTimeout(() => { t.style.opacity='0'; t.style.transition='opacity .25s'; setTimeout(() => t.remove(), 250); }, 2500);
}

// ── SCROLL REVEAL ──
const io = new IntersectionObserver(entries => {
  entries.forEach((e, i) => {
    if (e.isIntersecting) { setTimeout(() => { e.target.style.opacity='1'; e.target.style.transform='translateY(0)'; }, i * 50); io.unobserve(e.target); }
  });
}, { threshold: 0.05 });
document.querySelectorAll('.prod-card').forEach((el, i) => {
  el.style.opacity='0'; el.style.transform='translateY(16px)';
  el.style.transition='opacity .4s ease, transform .4s ease';
  io.observe(el);
});
</script>
@endpush

@endsection