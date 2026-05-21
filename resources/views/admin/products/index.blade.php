{{-- ══════════════════════════════════════════════
    resources/views/admin/products/index.blade.php
══════════════════════════════════════════════ --}}
@extends('admin.layouts.admin')
@section('title','Products')
@section('breadcrumb','Products')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">🛒 Products</div>
    <div class="page-sub">Manage all products ({{ $products->total() }} total)</div>
  </div>
  <div class="page-actions">
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">+ Add Product</a>
  </div>
</div>

{{-- Filters --}}
<div class="filters-bar">
  <form method="GET" action="{{ route('admin.products.index') }}" style="display:flex;gap:10px;flex-wrap:wrap;width:100%">
    <div class="search-filter" style="max-width:280px">
      🔍
      <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name or SKU...">
    </div>
    <select name="category" class="filter-select" onchange="this.form.submit()">
      <option value="">All Categories</option>
      @foreach($categories as $cat)
        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
          {{ $cat->name }}
        </option>
      @endforeach
    </select>
    <select name="status" class="filter-select" onchange="this.form.submit()">
      <option value="">All Status</option>
      <option value="1" {{ request('status')==='1' ? 'selected' : '' }}>Active</option>
      <option value="0" {{ request('status')==='0' ? 'selected' : '' }}>Inactive</option>
    </select>
    <select name="stock" class="filter-select" onchange="this.form.submit()">
      <option value="">All Stock</option>
      <option value="low" {{ request('stock')==='low' ? 'selected' : '' }}>Low Stock</option>
      <option value="out" {{ request('stock')==='out' ? 'selected' : '' }}>Out of Stock</option>
    </select>
    <button type="submit" class="btn btn-secondary">Filter</button>
    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Reset</a>
  </form>
</div>

{{-- Table --}}
<div class="card">
  <div class="table-wrap" style="border:none">
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Product</th>
          <th>Category</th>
          <th>Price</th>
          <th>Stock</th>
          <th>Sales</th>
          <th>Badges</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($products as $product)
        <tr>
          <td style="color:var(--text-muted)">{{ $product->id }}</td>

          <td>
            <div class="td-flex">
              @if($product->thumbnail)
                <img src="{{ asset('storage/'.$product->thumbnail) }}"
                  class="td-img" alt="{{ $product->name }}" style="object-fit:cover">
              @else
                <div class="td-img">🛒</div>
              @endif
              <div>
                <div class="td-name">{{ $product->name }}</div>
                <div class="td-sub">SKU: {{ $product->sku ?? '—' }} · {{ $product->unit }}</div>
              </div>
            </div>
          </td>

          <td>
            <span class="badge badge-info">{{ $product->category->name ?? '—' }}</span>
          </td>

          <td>
            <div style="font-weight:700;color:var(--green)">₹{{ number_format($product->current_price) }}</div>
            @if($product->is_on_sale)
              <div style="font-size:12px;color:var(--text-muted);text-decoration:line-through">₹{{ number_format($product->price) }}</div>
              <div style="font-size:11px;font-weight:600;color:#dc2626">{{ $product->discount_percent }}% OFF</div>
            @endif
          </td>

          <td>
            @if($product->stock_quantity == 0)
              <span class="badge badge-danger">Out of Stock</span>
            @elseif($product->stock_quantity <= $product->low_stock_alert)
              <span class="badge badge-warning">Low: {{ $product->stock_quantity }}</span>
            @else
              <span class="badge badge-success">{{ $product->stock_quantity }}</span>
            @endif
          </td>

          <td style="color:var(--text-muted)">
            {{ $product->order_items_count ?? 0 }} sold
          </td>

          <td>
            <div style="display:flex;gap:4px;flex-wrap:wrap">
              @if($product->is_featured)   <span class="badge badge-purple">⭐ Featured</span>  @endif
              @if($product->is_bestseller) <span class="badge badge-warning">🔥 Best</span>     @endif
              @if($product->is_new_arrival)<span class="badge badge-info">✨ New</span>          @endif
            </div>
          </td>

          <td>
            <label class="toggle-wrap" style="cursor:pointer">
              <div class="toggle">
                <input type="checkbox"
                  {{ $product->is_active ? 'checked' : '' }}
                  onchange="toggleStatus({{ $product->id }}, this)">
                <span class="toggle-slider"></span>
              </div>
              <span style="font-size:12px;color:var(--text-muted)" id="plbl-{{ $product->id }}">
                {{ $product->is_active ? 'On' : 'Off' }}
              </span>
            </label>
          </td>

          <td>
            <div class="td-actions">
              <a href="{{ route('admin.products.edit', $product->id) }}"
                class="btn btn-secondary btn-sm btn-icon" title="Edit">✏️</a>
              <a href="{{ route('product.show', $product->slug) }}" target="_blank"
                class="btn btn-secondary btn-sm btn-icon" title="View on site">👁</a>
              <form action="{{ route('admin.products.destroy', $product->id) }}"
                method="POST" onsubmit="return confirmDelete(this)">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm btn-icon" title="Delete">🗑️</button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="9" style="text-align:center;padding:48px;color:var(--text-muted)">
            <div style="font-size:36px;margin-bottom:10px">🛒</div>
            <div style="font-size:15px;font-weight:500;margin-bottom:6px">No products yet</div>
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary" style="margin-top:8px">+ Add First Product</a>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  @if($products->hasPages())
  <div class="card-footer" style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px">
    <div style="font-size:13px;color:var(--text-muted)">
      Showing {{ $products->firstItem() }}–{{ $products->lastItem() }} of {{ $products->total() }}
    </div>
    <div class="pagination">
      @if($products->onFirstPage())
        <div class="page-item disabled">‹</div>
      @else
        <a href="{{ $products->previousPageUrl() }}" class="page-item">‹</a>
      @endif
      @foreach($products->getUrlRange(1, $products->lastPage()) as $page => $url)
        <a href="{{ $url }}" class="page-item {{ $products->currentPage() == $page ? 'active' : '' }}">{{ $page }}</a>
      @endforeach
      @if($products->hasMorePages())
        <a href="{{ $products->nextPageUrl() }}" class="page-item">›</a>
      @else
        <div class="page-item disabled">›</div>
      @endif
    </div>
  </div>
  @endif
</div>
@endsection

@push('scripts')
<script>
function toggleStatus(id, checkbox) {
  fetch(`/admin/products/${id}/toggle`, {
    method: 'POST',
    headers: { 'X-CSRF-TOKEN': csrfToken },
  })
  .then(r => r.json())
  .then(d => {
    document.getElementById('plbl-' + id).textContent = d.status ? 'On' : 'Off';
    showToast(d.message, 'success');
  })
  .catch(() => { checkbox.checked = !checkbox.checked; showToast('Error occurred', 'error'); });
}
</script>
@endpush