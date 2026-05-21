<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Shop — GroceryMart</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Inter',sans-serif;background:#f8f9fa;color:#1a1a2e}
a{text-decoration:none;color:inherit}
:root{--green:#16a34a;--green-dark:#15803d;--green-light:#dcfce7;--border:#e2e8f0}

/* NAVBAR */
.navbar{background:#fff;border-bottom:1px solid var(--border);position:sticky;top:0;z-index:200;box-shadow:0 1px 4px rgba(0,0,0,.06)}
.nav-inner{max-width:1280px;margin:0 auto;padding:0 20px;height:60px;display:flex;align-items:center;gap:16px}
.logo{font-size:20px;font-weight:800;color:#1a1a2e;flex-shrink:0}.logo span{color:var(--green)}
.search-wrap{flex:1;display:flex;border:1.5px solid var(--border);border-radius:50px;overflow:hidden;max-width:500px;transition:border-color .2s}
.search-wrap:focus-within{border-color:var(--green)}
.search-wrap input{flex:1;border:none;padding:9px 16px;font-size:13px;outline:none;font-family:inherit}
.search-wrap button{background:var(--green);border:none;color:#fff;padding:0 20px;font-size:13px;font-weight:500;cursor:pointer}
.nav-right{display:flex;align-items:center;gap:8px;margin-left:auto}
.nav-link{font-size:13px;font-weight:500;color:#374151;padding:7px 12px;border-radius:7px;transition:all .15s}
.nav-link:hover{background:var(--green-light);color:var(--green)}
.btn-cart{background:var(--green);color:#fff;padding:8px 16px;border-radius:8px;font-size:13px;font-weight:600;display:flex;align-items:center;gap:6px}
.cart-badge{background:rgba(255,255,255,.25);border-radius:4px;padding:1px 6px;font-size:11px;font-weight:700}
.alert{padding:10px 20px;font-size:13px}
.alert-success{background:#dcfce7;color:#15803d;border-bottom:1px solid #bbf7d0}

/* BREADCRUMB */
.breadcrumb{background:#fff;border-bottom:1px solid var(--border);padding:10px 0}
.bc-inner{max-width:1280px;margin:0 auto;padding:0 20px;display:flex;align-items:center;gap:6px;font-size:13px;color:#9ca3af}
.bc-inner a{color:#16a34a;font-weight:500}.bc-inner span{color:#d1d5db}

/* LAYOUT */
.wrap{max-width:1280px;margin:0 auto;padding:24px 20px}
.shop-layout{display:grid;grid-template-columns:240px 1fr;gap:24px;align-items:start}

/* SIDEBAR */
.sidebar{background:#fff;border:1px solid var(--border);border-radius:12px;overflow:hidden;position:sticky;top:80px}
.sidebar-section{padding:18px 20px;border-bottom:1px solid #f1f5f9}
.sidebar-section:last-child{border-bottom:none}
.sidebar-title{font-size:13px;font-weight:700;color:#374151;margin-bottom:14px;display:flex;align-items:center;gap:6px}
.cat-item{display:flex;align-items:center;justify-content:space-between;padding:7px 10px;border-radius:7px;font-size:13px;color:#4b5563;cursor:pointer;transition:all .15s;text-decoration:none;margin-bottom:2px}
.cat-item:hover,.cat-item.active{background:var(--green-light);color:var(--green);font-weight:600}
.cat-count{background:#f1f5f9;color:#9ca3af;font-size:11px;padding:1px 7px;border-radius:10px;font-weight:600}
.cat-item.active .cat-count{background:var(--green);color:#fff}
.price-range{display:flex;gap:8px;align-items:center}
.price-input{width:80px;padding:7px 10px;border:1.5px solid var(--border);border-radius:7px;font-size:13px;outline:none;font-family:inherit}
.price-input:focus{border-color:var(--green)}
.filter-btn{width:100%;background:var(--green);color:#fff;border:none;padding:9px;border-radius:8px;font-size:13px;font-weight:600;cursor:pointer;margin-top:10px;font-family:inherit;transition:background .15s}
.filter-btn:hover{background:var(--green-dark)}
.clear-btn{width:100%;background:#f1f5f9;color:#64748b;border:none;padding:8px;border-radius:8px;font-size:13px;cursor:pointer;margin-top:6px;font-family:inherit;transition:background .15s}
.clear-btn:hover{background:#e2e8f0}

/* TOP BAR */
.topbar-shop{display:flex;align-items:center;justify-content:space-between;margin-bottom:18px;flex-wrap:wrap;gap:12px}
.results-info{font-size:13.5px;color:#64748b}
.results-info strong{color:#1a1a2e}
.sort-select{padding:8px 14px;border:1.5px solid var(--border);border-radius:8px;font-size:13px;outline:none;font-family:inherit;cursor:pointer;background:#fff;color:#374151;transition:border-color .2s}
.sort-select:focus{border-color:var(--green)}

/* PRODUCT GRID */
.products-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px}
.prod-card{background:#fff;border:1.5px solid var(--border);border-radius:12px;overflow:hidden;transition:all .2s;position:relative}
.prod-card:hover{transform:translateY(-4px);box-shadow:0 12px 32px rgba(0,0,0,.10);border-color:#bbf7d0}
.prod-badge{position:absolute;top:10px;left:10px;font-size:10.5px;font-weight:700;padding:3px 9px;border-radius:5px;z-index:2}
.badge-sale{background:#ef4444;color:#fff}
.badge-new{background:var(--green);color:#fff}
.badge-hot{background:#f97316;color:#fff}
.out-badge{background:#94a3b8;color:#fff}
.prod-img{height:160px;background:#f8fafc;display:flex;align-items:center;justify-content:center;overflow:hidden;transition:transform .3s;font-size:70px}
.prod-img img{width:100%;height:100%;object-fit:cover}
.prod-card:hover .prod-img{transform:scale(1.05)}
.prod-body{padding:13px}
.prod-cat{font-size:11px;color:var(--green);font-weight:600;text-transform:uppercase;letter-spacing:.3px;margin-bottom:4px}
.prod-name{font-size:13.5px;font-weight:600;color:#1a1a2e;line-height:1.35;margin-bottom:3px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
.prod-weight{font-size:12px;color:#9ca3af;margin-bottom:8px}
.prod-footer{display:flex;align-items:center;justify-content:space-between}
.prod-price{font-size:18px;font-weight:800;color:var(--green)}
.prod-old{font-size:12px;color:#9ca3af;text-decoration:line-through;margin-top:1px}
.add-btn{width:34px;height:34px;background:var(--green);border:none;border-radius:8px;color:#fff;font-size:20px;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all .15s;flex-shrink:0}
.add-btn:hover{background:var(--green-dark);transform:scale(1.1)}
.add-btn:disabled{background:#e2e8f0;color:#9ca3af;cursor:not-allowed;transform:none}

/* EMPTY STATE */
.empty{text-align:center;padding:64px 20px;grid-column:1/-1}
.empty-icon{font-size:56px;margin-bottom:16px}
.empty-title{font-size:18px;font-weight:600;color:#374151;margin-bottom:6px}
.empty-sub{font-size:14px;color:#9ca3af}

/* PAGINATION */
.pagination-wrap{margin-top:28px;display:flex;justify-content:center}
.pagination{display:flex;gap:4px}
.page-item{width:36px;height:36px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:500;cursor:pointer;border:1.5px solid var(--border);color:#374151;background:#fff;text-decoration:none;transition:all .15s}
.page-item:hover{border-color:var(--green);color:var(--green)}
.page-item.active{background:var(--green);color:#fff;border-color:var(--green)}
.page-item.disabled{opacity:.45;cursor:not-allowed;pointer-events:none}

/* RESPONSIVE */
@media(max-width:1024px){.products-grid{grid-template-columns:repeat(3,1fr)}}
@media(max-width:768px){.shop-layout{grid-template-columns:1fr}.sidebar{display:none}.products-grid{grid-template-columns:repeat(2,1fr)}}
@media(max-width:480px){.products-grid{grid-template-columns:repeat(2,1fr);gap:10px}}
</style>
</head>
<body>
<nav class="navbar">
  <div class="nav-inner">
    <a href="{{ route('home') }}" class="logo">Grocery<span>Mart</span></a>
    <form action="{{ route('shop.search') }}" method="GET" class="search-wrap">
      <input type="text" name="q" placeholder="Search products..." value="{{ request('q') }}">
      <button type="submit">🔍</button>
    </form>
    <div class="nav-right">
      <a href="{{ route('home') }}" class="nav-link">Home</a>
      <a href="{{ route('offers') }}" class="nav-link">🔥 Offers</a>
      @auth
        <a href="{{ route('account.index') }}" class="nav-link">👤 Account</a>
      @else
        <a href="{{ route('login') }}" class="nav-link">Login</a>
      @endauth
      <a href="{{ route('cart.index') }}" class="btn-cart">
        🛒 Cart
        @php $c=count(session('cart',[]));@endphp
        @if($c>0)<span class="cart-badge">{{$c}}</span>@endif
      </a>
    </div>
  </div>
</nav>

@if(session('success'))<div class="alert alert-success">✅ {{ session('success') }}</div>@endif

<div class="breadcrumb">
  <div class="bc-inner">
    <a href="{{ route('home') }}">Home</a><span>›</span>
    @if(request('category') && $categories->find(request('category')))
      <a href="{{ route('shop') }}">Shop</a><span>›</span>
      <span style="color:#374151">{{ $categories->find(request('category'))->name }}</span>
    @else
      <span style="color:#374151">Shop</span>
    @endif
  </div>
</div>

<div class="wrap">
  <div class="shop-layout">

    {{-- SIDEBAR --}}
    <aside class="sidebar">
      <form method="GET" action="{{ route('shop') }}" id="filterForm">

        {{-- Categories --}}
        <div class="sidebar-section">
          <div class="sidebar-title">🗂️ Categories</div>
          <a href="{{ route('shop') }}" class="cat-item {{ !request('category') ? 'active' : '' }}">
            All Products
            <span class="cat-count">{{ $products->total() }}</span>
          </a>
          @foreach($categories as $cat)
          <a href="{{ route('shop') }}?category={{ $cat->id }}{{ request('sort') ? '&sort='.request('sort') : '' }}"
            class="cat-item {{ request('category') == $cat->id ? 'active' : '' }}">
            {{ $cat->name }}
            <span class="cat-count">{{ $cat->activeProducts->count() }}</span>
          </a>
          @endforeach
        </div>

        {{-- Price --}}
        <div class="sidebar-section">
          <div class="sidebar-title">💰 Price Range</div>
          <div class="price-range">
            <input type="number" name="min_price" class="price-input" placeholder="Min ₹" value="{{ request('min_price') }}">
            <span style="color:#9ca3af;font-size:13px">to</span>
            <input type="number" name="max_price" class="price-input" placeholder="Max ₹" value="{{ request('max_price') }}">
          </div>
          <input type="hidden" name="category" value="{{ request('category') }}">
          <input type="hidden" name="sort" value="{{ request('sort') }}">
          <button type="submit" class="filter-btn">Apply Filter</button>
          <a href="{{ route('shop') }}" class="clear-btn" style="display:block;text-align:center">Clear All</a>
        </div>

        {{-- Stock Filter --}}
        <div class="sidebar-section">
          <div class="sidebar-title">📦 Availability</div>
          <a href="{{ route('shop') }}?{{ http_build_query(array_merge(request()->except(['stock','page']), ['stock'=>'instock'])) }}"
            class="cat-item {{ request('stock')==='instock' ? 'active' : '' }}">
            ✅ In Stock Only
          </a>
          <a href="{{ route('shop') }}?{{ http_build_query(array_merge(request()->except(['stock','page']), ['stock'=>'sale'])) }}"
            class="cat-item {{ request('stock')==='sale' ? 'active' : '' }}">
            🏷️ On Sale
          </a>
        </div>

      </form>
    </aside>

    {{-- MAIN CONTENT --}}
    <div>
      <div class="topbar-shop">
        <div class="results-info">
          Showing <strong>{{ $products->count() }}</strong> of <strong>{{ $products->total() }}</strong> products
          @if(request('q'))<span> for "<strong>{{ request('q') }}</strong>"</span>@endif
        </div>
        <select class="sort-select" onchange="window.location='{{ route('shop') }}?'+new URLSearchParams({...Object.fromEntries(new URLSearchParams(location.search)),...{sort:this.value}}).toString()">
          <option value="" {{ !request('sort') ? 'selected':'' }}>Latest First</option>
          <option value="price_asc"  {{ request('sort')==='price_asc'  ? 'selected':'' }}>Price: Low to High</option>
          <option value="price_desc" {{ request('sort')==='price_desc' ? 'selected':'' }}>Price: High to Low</option>
          <option value="bestseller" {{ request('sort')==='bestseller' ? 'selected':'' }}>Bestsellers</option>
          <option value="newest"     {{ request('sort')==='newest'     ? 'selected':'' }}>New Arrivals</option>
        </select>
      </div>

      <div class="products-grid">
        @forelse($products as $product)
        <div class="prod-card">
          @if(!$product->is_in_stock)
            <div class="prod-badge out-badge">OUT OF STOCK</div>
          @elseif($product->is_on_sale)
            <div class="prod-badge badge-sale">{{ $product->discount_percent }}% OFF</div>
          @elseif($product->is_new_arrival)
            <div class="prod-badge badge-new">NEW</div>
          @elseif($product->is_bestseller)
            <div class="prod-badge badge-hot">BEST</div>
          @endif

          <a href="{{ route('product.show', $product->slug) }}">
            <div class="prod-img">
              @if($product->thumbnail)
                <img src="{{ asset('storage/'.$product->thumbnail) }}" alt="{{ $product->name }}">
              @else
                {{ ['Vegetables'=>'🥬','Fruits'=>'🍎','Dairy & Eggs'=>'🥛','Meat & Fish'=>'🍗','Bakery'=>'🧁','Beverages'=>'🧃','Instant Food'=>'🍜','Personal Care'=>'🧴','Household'=>'🏠','Pet Care'=>'🐾'][$product->category->name ?? ''] ?? '🛒' }}
              @endif
            </div>
          </a>

          <div class="prod-body">
            <div class="prod-cat">{{ $product->category->name ?? '' }}</div>
            <a href="{{ route('product.show', $product->slug) }}" style="text-decoration:none">
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
                <form action="{{ route('cart.add') }}" method="POST">
                  @csrf
                  <input type="hidden" name="product_id" value="{{ $product->id }}">
                  <input type="hidden" name="qty" value="1">
                  <button type="submit" class="add-btn" title="Add to cart">+</button>
                </form>
              @else
                <button class="add-btn" disabled title="Out of stock">✕</button>
              @endif
            </div>
          </div>
        </div>
        @empty
        <div class="empty">
          <div class="empty-icon">🔍</div>
          <div class="empty-title">No products found</div>
          <div class="empty-sub">Try a different search or filter</div>
          <a href="{{ route('shop') }}" style="display:inline-block;margin-top:16px;background:var(--green);color:#fff;padding:10px 24px;border-radius:8px;font-weight:600;font-size:13px">Clear Filters</a>
        </div>
        @endforelse
      </div>

      {{-- PAGINATION --}}
      @if($products->hasPages())
      <div class="pagination-wrap">
        <div class="pagination">
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
      </div>
      @endif
    </div>
  </div>
</div>

{{-- FOOTER --}}
<div style="background:#0f1c14;color:rgba(255,255,255,.6);text-align:center;padding:24px;font-size:13px;margin-top:44px">
  © {{ date('Y') }} GroceryMart — <a href="{{ route('home') }}" style="color:#4ade80">Back to Home</a>
</div>
</body>
</html>