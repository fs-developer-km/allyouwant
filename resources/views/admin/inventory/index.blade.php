@extends('admin.layouts.admin')
@section('title','Inventory')@section('breadcrumb','Inventory')
@section('content')
<div class="page-header">
  <div><div class="page-title">📦 Inventory</div><div class="page-sub">Manage stock levels</div></div>
  <a href="{{ route('admin.inventory.low') }}" class="btn btn-danger">⚠️ Low Stock</a>
</div>
<div class="card">
  <div class="table-wrap" style="border:none">
    <table>
      <thead><tr><th>Product</th><th>Category</th><th>SKU</th><th>Stock</th><th>Alert At</th><th>Status</th><th>Update Stock</th></tr></thead>
      <tbody>
        @forelse($products as $p)
        <tr>
          <td><div class="td-name">{{ $p->name }}</div><div class="td-sub">{{ $p->unit }} · {{ $p->weight }}</div></td>
          <td>{{ $p->category->name ?? '—' }}</td>
          <td><code style="font-size:12px">{{ $p->sku ?? '—' }}</code></td>
          <td>
            @if($p->stock_quantity == 0) <span class="badge badge-danger">Out of Stock</span>
            @elseif($p->stock_quantity <= $p->low_stock_alert) <span class="badge badge-warning">Low: {{ $p->stock_quantity }}</span>
            @else <span class="badge badge-success">{{ $p->stock_quantity }}</span>
            @endif
          </td>
          <td>{{ $p->low_stock_alert }}</td>
          <td><span class="badge {{ $p->is_active?'badge-success':'badge-secondary' }}">{{ $p->is_active?'Active':'Off' }}</span></td>
          <td>
            <form action="{{ route('admin.inventory.update',$p->id) }}" method="POST" style="display:flex;gap:8px;align-items:center">
              @csrf
              <input type="number" name="stock_quantity" value="{{ $p->stock_quantity }}" min="0" style="width:80px;padding:6px 8px;border:1px solid #d1d5db;border-radius:6px;font-size:13px">
              <button type="submit" class="btn btn-primary btn-sm">Save</button>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="7" style="text-align:center;padding:40px;color:var(--text-muted)">No products found</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  @if($products->hasPages())<div class="card-footer">{{ $products->links() }}</div>@endif
</div>
@endsection
