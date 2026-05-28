@extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')

{{-- HERO --}}
<div class="page-wrap">
  <div class="hero-section">
    <div class="hero-grid">

      {{-- Sidebar --}}
      <div class="sidebar-cats">
        @foreach($categories as $cat)
        @php
          $icons = ['Vegetables'=>'🥬','Fruits'=>'🍎','Dairy & Eggs'=>'🥛','Meat & Fish'=>'🍗','Bakery'=>'🧁','Beverages'=>'🧃','Instant Food'=>'🍜','Personal Care'=>'🧴','Household'=>'🏠','Pet Care'=>'🐾'];
          $icon = $icons[$cat->name] ?? '🛒';
          $bg = ['Vegetables'=>'#f0faf4','Fruits'=>'#fff8f0','Dairy & Eggs'=>'#f0f8ff','Meat & Fish'=>'#fff0f0','Bakery'=>'#fffbf0','Beverages'=>'#f0f0ff','Instant Food'=>'#fff0fa','Personal Care'=>'#f5f0ff','Household'=>'#f0fff8','Pet Care'=>'#fff8f0'][$cat->name] ?? '#f3f4f6';
        @endphp
        <a href="{{ route('category.show', $cat->slug) }}" class="sidebar-cat-item">
          <div class="sidebar-cat-left">
            <div class="sidebar-cat-icon" style="background:{{ $bg }}">
              @if($cat->image)
                <img src="{{ asset('storage/'.$cat->image) }}" alt="{{ $cat->name }}" style="width:100%;height:100%;object-fit:cover;border-radius:6px">
              @else
                {{ $icon }}
              @endif
            </div>
            <span class="sidebar-cat-name">{{ $cat->name }}</span>
          </div>
          <span class="sidebar-chevron">›</span>
        </a>
        @endforeach
      </div>

      {{-- Slider --}}
      <div class="hero-slider" id="heroSlider">
        <div class="slide slide-1 active" id="slide0">
          <div class="slide-eyebrow">🌿 100% Organic & Farm Fresh</div>
          <div class="slide-title">Fresh Groceries<br><em>Delivered in 60 min</em></div>
          <div class="slide-desc">Order fresh vegetables, fruits, dairy & daily essentials. Delivered at Mayur Vihar Phase-1.</div>
          <div class="slide-actions">
            <a href="{{ route('shop') }}" class="btn-white">🛍️ Shop Now</a>
            <a href="{{ route('offers') }}" class="btn-ghost">View Offers →</a>
          </div>
          <div class="slide-stats">
            <div><div class="slide-stat-n">10K+</div><div class="slide-stat-l">Happy Customers</div></div>
            <div><div class="slide-stat-n">{{ $featured->count() + $bestsellers->count() }}+</div><div class="slide-stat-l">Fresh Products</div></div>
            <div><div class="slide-stat-n">60 min</div><div class="slide-stat-l">Express Delivery</div></div>
          </div>
          <div class="slide-img">🥗</div>
        </div>
        <div class="slide slide-2" id="slide1">
          <div class="slide-eyebrow">🔥 Today's Special Deal</div>
          <div class="slide-title">Flat 30% OFF<br><em>on All Fruits</em></div>
          <div class="slide-desc">Freshly sourced seasonal fruits delivered to your door every morning.</div>
          <div class="slide-actions">
            @php $fruitCat = $categories->firstWhere('name','Fruits'); @endphp
            <a href="{{ $fruitCat ? route('category.show',$fruitCat->slug) : route('shop') }}" class="btn-white">🍎 Buy Fruits</a>
            <a href="{{ route('offers') }}" class="btn-ghost">All Offers →</a>
          </div>
          <div class="slide-stats">
            <div><div class="slide-stat-n">₹49</div><div class="slide-stat-l">Starting from</div></div>
            <div><div class="slide-stat-n">30%</div><div class="slide-stat-l">Discount today</div></div>
            <div><div class="slide-stat-n">Free</div><div class="slide-stat-l">Delivery above ₹499</div></div>
          </div>
          <div class="slide-img">🍊</div>
        </div>
        <div class="slide slide-3" id="slide2">
          <div class="slide-eyebrow">🎁 New Customer Offer</div>
          <div class="slide-title">First Order<br><em>Flat ₹100 OFF</em></div>
          <div class="slide-desc">Use code WELCOME100. Valid on min ₹299. Near Mitra Di Chap & Sameer Restaurant.</div>
          <div class="slide-actions">
            <a href="{{ route('register') }}" class="btn-white">Register Now</a>
            <a href="{{ route('shop') }}" class="btn-ghost">Browse Shop →</a>
          </div>
          <div class="slide-stats">
            <div><div class="slide-stat-n">₹100</div><div class="slide-stat-l">Off first order</div></div>
            <div><div class="slide-stat-n">COD</div><div class="slide-stat-l">Available</div></div>
            <div><div class="slide-stat-n">Safe</div><div class="slide-stat-l">Secure payment</div></div>
          </div>
          <div class="slide-img">🎁</div>
        </div>
        <div class="slider-dots">
          <div class="dot active" onclick="goSlide(0)"></div>
          <div class="dot" onclick="goSlide(1)"></div>
          <div class="dot" onclick="goSlide(2)"></div>
        </div>
      </div>

      {{-- Mini banners --}}
      <div class="hero-right">
        @php
          $vegCat   = $categories->firstWhere('name','Vegetables');
          $fruitCat2= $categories->firstWhere('name','Fruits');
          $dairyCat = $categories->firstWhere('name','Dairy & Eggs');
        @endphp
        <a href="{{ $fruitCat2 ? route('category.show',$fruitCat2->slug) : route('shop') }}" class="mini-card mini-c1">
          <div class="mini-emoji">🍓</div>
          <div class="mini-tag">Fresh Picks</div>
          <div class="mini-title">Seasonal Fruits</div>
          <div class="mini-sub">Starting ₹49/kg</div>
          <div class="mini-cta">Shop Now →</div>
        </a>
        <a href="{{ $vegCat ? route('category.show',$vegCat->slug) : route('shop') }}" class="mini-card mini-c2">
          <div class="mini-emoji">🥦</div>
          <div class="mini-tag">Farm Direct</div>
          <div class="mini-title">Organic Vegetables</div>
          <div class="mini-sub">Upto 25% OFF today</div>
          <div class="mini-cta">Shop Now →</div>
        </a>
        <a href="{{ $dairyCat ? route('category.show',$dairyCat->slug) : route('shop') }}" class="mini-card mini-c3">
          <div class="mini-emoji">🥛</div>
          <div class="mini-tag">Daily Essentials</div>
          <div class="mini-title">Dairy & Eggs</div>
          <div class="mini-sub">Always fresh, always on time</div>
          <div class="mini-cta">Shop Now →</div>
        </a>
      </div>
    </div>

    {{-- Mobile mini banners --}}
    <div class="hero-right-mobile" style="display:none">
      <a href="{{ $fruitCat2 ? route('category.show',$fruitCat2->slug) : route('shop') }}" class="mini-card mini-c1">
        <div class="mini-emoji">🍓</div><div class="mini-tag">Fresh Picks</div><div class="mini-title">Seasonal Fruits</div><div class="mini-cta">Shop Now →</div>
      </a>
      <a href="{{ $vegCat ? route('category.show',$vegCat->slug) : route('shop') }}" class="mini-card mini-c2">
        <div class="mini-emoji">🥦</div><div class="mini-tag">Farm Direct</div><div class="mini-title">Organic Veggies</div><div class="mini-cta">Shop Now →</div>
      </a>
    </div>
  </div>
</div>

{{-- FEATURES BAR --}}
<div class="features-bar" style="margin-top:20px">
  <div class="features-bar-inner">
    <div class="feat-item"><div class="feat-icon">🚚</div><div><div class="feat-title">Free Delivery</div><div class="feat-sub">On orders above ₹499</div></div></div>
    <div class="feat-item"><div class="feat-icon">⚡</div><div><div class="feat-title">60-Min Express</div><div class="feat-sub">Ultra-fast delivery</div></div></div>
    <div class="feat-item"><div class="feat-icon">🌿</div><div><div class="feat-title">100% Fresh</div><div class="feat-sub">Farm to your doorstep</div></div></div>
    <div class="feat-item"><div class="feat-icon">🔒</div><div><div class="feat-title">Secure Payment</div><div class="feat-sub">Razorpay, UPI & COD</div></div></div>
  </div>
</div>

{{-- SHOP BY CATEGORY --}}
<div class="page-wrap">
  <div class="section">
    <div class="sec-header">
      <div>
        <div class="sec-title">Shop by <span>Category</span></div>
        <div class="sec-sub">Browse from {{ $categories->count() }}+ product categories</div>
      </div>
      <a href="{{ route('shop') }}" class="sec-view-all">View All Categories →</a>
    </div>

    <div class="cat-scroll">
      @foreach($categories as $cat)
      @php
        $icons = ['Vegetables'=>'🥬','Fruits'=>'🍎','Dairy & Eggs'=>'🥛','Meat & Fish'=>'🍗','Bakery'=>'🧁','Beverages'=>'🧃','Instant Food'=>'🍜','Personal Care'=>'🧴','Household'=>'🏠','Pet Care'=>'🐾'];
        $icon = $icons[$cat->name] ?? '🛒';
      @endphp
      <a href="{{ route('category.show', $cat->slug) }}" class="cat-box">
        <div class="cat-box-icon">
          @if($cat->image)
            <img src="{{ asset('storage/'.$cat->image) }}" alt="{{ $cat->name }}">
          @else
            <span style="font-size:24px">{{ $icon }}</span>
          @endif
        </div>
        <div class="cat-box-name">{{ $cat->name }}</div>
        <div class="cat-box-count">{{ $cat->activeProducts->count() }} items</div>
      </a>
      @endforeach
    </div>
  </div>

  {{-- FEATURED PRODUCTS --}}
  <div class="section">
    <div class="sec-header">
      <div>
        <div class="sec-title">Featured <span>Products</span></div>
        <div class="sec-sub">Handpicked fresh products for you</div>
      </div>
      <a href="{{ route('shop') }}" class="sec-view-all">View All →</a>
    </div>
    <div class="tabs">
      <button class="tab-btn active" onclick="setTab(this)">All</button>
      <button class="tab-btn" onclick="setTab(this)">Vegetables</button>
      <button class="tab-btn" onclick="setTab(this)">Fruits</button>
      <button class="tab-btn" onclick="setTab(this)">Dairy</button>
      <button class="tab-btn" onclick="setTab(this)">Bestsellers</button>
    </div>
    <div class="products-row">
      @forelse($featured as $product)
      @php
        $pIcon = ['Vegetables'=>'🥬','Fruits'=>'🍎','Dairy & Eggs'=>'🥛','Meat & Fish'=>'🍗','Bakery'=>'🧁','Beverages'=>'🧃','Instant Food'=>'🍜','Personal Care'=>'🧴','Household'=>'🏠','Pet Care'=>'🐾'][$product->category->name ?? ''] ?? '🛒';
      @endphp
      <div class="prod-card">
        @if($product->is_on_sale)
          <div class="prod-badge badge-sale">{{ $product->discount_percent }}% OFF</div>
        @elseif($product->is_new_arrival)
          <div class="prod-badge badge-new">NEW</div>
        @elseif($product->is_bestseller)
          <div class="prod-badge badge-hot">HOT</div>
        @endif
        <button class="prod-wish" onclick="toggleWish(this)" title="Wishlist">🤍</button>
        <a href="{{ route('product.show', $product->slug) }}">
          <div class="prod-img-wrap">
            @if($product->thumbnail)
              <img src="{{ asset('storage/'.$product->thumbnail) }}" alt="{{ $product->name }}">
            @else
              <div class="prod-emoji">{{ $pIcon }}</div>
            @endif
          </div>
        </a>
        <div class="prod-body">
          <div class="prod-cat-tag">{{ $product->category->name ?? '' }}</div>
          <a href="{{ route('product.show', $product->slug) }}" style="text-decoration:none;color:inherit">
            <div class="prod-name">{{ $product->name }}</div>
          </a>
          <div class="prod-weight">{{ $product->weight }} · {{ $product->unit }}</div>
          <div class="prod-rating">
            <span class="stars">★★★★☆</span>
            <span class="rating-n">({{ $product->approvedReviews->count() }})</span>
          </div>
          <div class="prod-footer">
            <div class="prod-price-wrap">
              <div class="prod-price">₹{{ number_format($product->current_price) }}</div>
              @if($product->is_on_sale)
                <div class="prod-price-old">₹{{ number_format($product->price) }}</div>
              @endif
            </div>
            @if($product->is_in_stock)
            <form action="{{ route('cart.add') }}" method="POST">
              @csrf
              <input type="hidden" name="product_id" value="{{ $product->id }}">
              <input type="hidden" name="qty" value="1">
              <button type="submit" class="btn-add" onclick="addToCartAnim(this)">+</button>
            </form>
            @else
              <button class="btn-add" disabled style="background:#e2e8f0;color:#9ca3af;cursor:not-allowed">✕</button>
            @endif
          </div>
        </div>
      </div>
      @empty
      <div style="grid-column:1/-1;text-align:center;padding:48px;color:#9ca3af">
        <div style="font-size:48px;margin-bottom:12px">🛒</div>
        <div style="font-size:15px;font-weight:600;margin-bottom:8px">No products yet</div>
        <a href="{{ route('admin.products.create') }}" style="color:#0d6e39;font-weight:600">Add products from Admin Panel →</a>
      </div>
      @endforelse
    </div>
  </div>

  {{-- BESTSELLERS --}}
  @if($bestsellers->count() > 0)
  <div class="section">
    <div class="sec-header">
      <div>
        <div class="sec-title">🔥 <span>Bestsellers</span></div>
        <div class="sec-sub">Most loved products by our customers</div>
      </div>
      <a href="{{ route('shop') }}" class="sec-view-all">View All →</a>
    </div>
    <div class="products-row">
      @foreach($bestsellers->take(6) as $product)
      @php $pIcon = ['Vegetables'=>'🥬','Fruits'=>'🍎','Dairy & Eggs'=>'🥛','Meat & Fish'=>'🍗','Bakery'=>'🧁','Beverages'=>'🧃'][$product->category->name ?? ''] ?? '🛒'; @endphp
      <div class="prod-card">
        <div class="prod-badge badge-hot">BEST</div>
        <button class="prod-wish" onclick="toggleWish(this)">🤍</button>
        <a href="{{ route('product.show', $product->slug) }}">
          <div class="prod-img-wrap">
            @if($product->thumbnail)
              <img src="{{ asset('storage/'.$product->thumbnail) }}" alt="{{ $product->name }}">
            @else
              <div class="prod-emoji">{{ $pIcon }}</div>
            @endif
          </div>
        </a>
        <div class="prod-body">
          <div class="prod-cat-tag">{{ $product->category->name ?? '' }}</div>
          <a href="{{ route('product.show',$product->slug) }}" style="text-decoration:none;color:inherit">
            <div class="prod-name">{{ $product->name }}</div>
          </a>
          <div class="prod-weight">{{ $product->weight }} · {{ $product->unit }}</div>
          <div class="prod-footer">
            <div class="prod-price-wrap">
              <div class="prod-price">₹{{ number_format($product->current_price) }}</div>
              @if($product->is_on_sale)
                <div class="prod-price-old">₹{{ number_format($product->price) }}</div>
              @endif
            </div>
            @if($product->is_in_stock)
            <form action="{{ route('cart.add') }}" method="POST">
              @csrf
              <input type="hidden" name="product_id" value="{{ $product->id }}">
              <input type="hidden" name="qty" value="1">
              <button type="submit" class="btn-add" onclick="addToCartAnim(this)">+</button>
            </form>
            @endif
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  @endif

  {{-- OFFER BANNERS --}}
  <div class="section" style="padding-bottom:40px">
    <div class="sec-header">
      <div>
        <div class="sec-title">🔥 Exclusive <span>Offers</span></div>
        <div class="sec-sub">Limited time deals — grab before they're gone!</div>
      </div>
    </div>
    <div class="offer-grid">
      <a href="{{ route('offers') }}" class="offer-banner ob-1">
        <div class="ob-glow"></div><div class="ob-glow2"></div>
        <div class="ob-text">
          <div class="ob-eyebrow">Weekend Special</div>
          <div class="ob-title">30% OFF<br>Fresh Veggies</div>
          <div class="ob-sub">Code: VEGGIE30 · Min. order ₹299</div>
          <div class="ob-btn">Grab Deal →</div>
        </div>
        <div class="ob-emoji">🥗</div>
      </a>
      <a href="{{ route('register') }}" class="offer-banner ob-2">
        <div class="ob-glow"></div><div class="ob-glow2"></div>
        <div class="ob-text">
          <div class="ob-eyebrow">First Order</div>
          <div class="ob-title">Flat ₹100<br>OFF Welcome</div>
          <div class="ob-sub">Code: WELCOME100 · Min. order ₹299</div>
          <div class="ob-btn">Register Now →</div>
        </div>
        <div class="ob-emoji">🎁</div>
      </a>
      <a href="{{ route('shop') }}" class="offer-banner ob-3">
        <div class="ob-glow"></div><div class="ob-glow2"></div>
        <div class="ob-text">
          <div class="ob-eyebrow">Near You</div>
          <div class="ob-title">Earn ₹50<br>Per Referral</div>
          <div class="ob-sub">Mayur Vihar Phase-1 · Near Mitra Di Chap</div>
          <div class="ob-btn">Start Earning →</div>
        </div>
        <div class="ob-emoji">💰</div>
      </a>
    </div>
  </div>
</div>

{{-- REVIEWS --}}
<div class="reviews-bg">
  <div class="page-wrap">
    <div class="sec-header">
      <div>
        <div class="sec-title">What Customers <span>Say</span></div>
        <div class="sec-sub">Trusted by 10,000+ happy customers</div>
      </div>
    </div>
    <div class="reviews-grid">
      <div class="rev-card"><div class="rev-top"><div class="rev-avatar">RK</div><div><div class="rev-name">Rahul Kumar</div><div class="rev-date">2 days ago</div></div></div><div class="rev-stars">★★★★★</div><div class="rev-text">Vegetables are super fresh! Delivery was on time. Highly recommend to everyone in Mayur Vihar!</div><div class="rev-prod">✔ Verified • Mixed Vegetables Pack</div></div>
      <div class="rev-card"><div class="rev-top"><div class="rev-avatar" style="background:#7c3aed">PS</div><div><div class="rev-name">Priya Sharma</div><div class="rev-date">5 days ago</div></div></div><div class="rev-stars">★★★★★</div><div class="rev-text">Best grocery delivery in our area! Fruits are always fresh and prices are very competitive.</div><div class="rev-prod">✔ Verified • Seasonal Fruit Basket</div></div>
      <div class="rev-card"><div class="rev-top"><div class="rev-avatar" style="background:#c2410c">AM</div><div><div class="rev-name">Amit Mehta</div><div class="rev-date">1 week ago</div></div></div><div class="rev-stars">★★★★☆</div><div class="rev-text">Dairy products are always fresh. Milk and paneer quality is outstanding. 60-min delivery is real!</div><div class="rev-prod">✔ Verified • Daily Dairy Pack</div></div>
      <div class="rev-card"><div class="rev-top"><div class="rev-avatar" style="background:#0369a1">SK</div><div><div class="rev-name">Sunita Kumari</div><div class="rev-date">3 days ago</div></div></div><div class="rev-stars">★★★★★</div><div class="rev-text">Been ordering weekly for 3 months. Never disappointed. Customer support is very responsive!</div><div class="rev-prod">✔ Verified • Weekly Grocery Bundle</div></div>
    </div>
  </div>
</div>

{{-- NEWSLETTER --}}
<div class="newsletter">
  <div class="nl-inner">
    <div class="nl-icon">📧</div>
    <div class="nl-title">Get Exclusive Deals in Your Inbox</div>
    <div class="nl-sub">Subscribe and get 10% OFF on your next order. No spam, only fresh deals!</div>
    <div class="nl-form">
      <input class="nl-input" type="email" placeholder="Enter your email address...">
      <button class="nl-btn" type="button">Subscribe →</button>
    </div>
  </div>
</div>

@push('styles')
<style>
/* Category cards — proper image support */
.cat-box-icon {
  width: 64px;
  height: 64px;
  border-radius: 50%;
  background: #f3f4f6;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  transition: background .2s;
  flex-shrink: 0;
}
.cat-box-icon img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 50%;
  display: block;
}
.cat-box:hover .cat-box-icon {
  background: #e8f5ee;
}
/* Sidebar icon images */
.sidebar-cat-icon img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 6px;
  display: block;
}
</style>
@endpush

@push('scripts')
<script>
// Slider
let cur=0;
const slides=document.querySelectorAll('.slide');
const dots=document.querySelectorAll('.dot');
let timer;
function goSlide(n){
  slides[cur].classList.remove('active');
  dots[cur].classList.remove('active');
  cur=n;
  slides[cur].classList.add('active');
  dots[cur].classList.add('active');
  clearInterval(timer);
  timer=setInterval(()=>goSlide((cur+1)%slides.length),4500);
}
timer=setInterval(()=>goSlide((cur+1)%slides.length),4500);

// Touch swipe on slider
let tx=0;
const sl=document.getElementById('heroSlider');
if(sl){
  sl.addEventListener('touchstart',e=>{tx=e.changedTouches[0].screenX},{passive:true});
  sl.addEventListener('touchend',e=>{
    const d=tx-e.changedTouches[0].screenX;
    if(Math.abs(d)>50) goSlide(d>0?(cur+1)%slides.length:(cur-1+slides.length)%slides.length);
  });
}

// Scroll reveal
const io=new IntersectionObserver(entries=>entries.forEach(e=>{
  if(e.isIntersecting){e.target.style.opacity='1';e.target.style.transform='translateY(0)'}
}),{threshold:.06});
document.querySelectorAll('.prod-card,.cat-box,.rev-card,.offer-banner,.feat-item').forEach(el=>{
  el.style.opacity='0';
  el.style.transform='translateY(16px)';
  el.style.transition='opacity .4s ease,transform .4s ease';
  io.observe(el);
});
</script>
@endpush

@endsection