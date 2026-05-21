@extends('admin.layouts.admin')
@section('title','Low Stock')@section('breadcrumb','Low Stock')
@section('content')
<div class="page-header">
  <div><div class="page-title">⚠️ Low Stock Items</div><div class="page-sub">{{ $products->total() }} products need restocking</div></div>
  <a href="{{ route('admin.inventory.index') }}" class="btn btn-secondary">← All Inventory</a>
</div>
<div class="card">
  <div class="table-wrap" style="border:none">
    <table>
      <thead><tr><th>Product</th><th>Category</th><th>Current Stock</th><th>Alert Level</th><th>Update Stock</th></tr></thead>
      <tbody>
        @forelse($products as $p)
        <tr style="background:#fffbeb">
          <td><div class="td-name">{{ $p->name }}</div></td>
          <td>{{ $p->category->name ?? '—' }}</td>
          <td><span class="badge {{ $p->stock_quantity==0?'badge-danger':'badge-warning' }}">{{ $p->stock_quantity == 0 ? 'OUT' : $p->stock_quantity }}</span></td>
          <td>{{ $p->low_stock_alert }}</td>
          <td>
            <form action="{{ route('admin.inventory.update',$p->id) }}" method="POST" style="display:flex;gap:8px">
              @csrf
              <input type="number" name="stock_quantity" value="{{ $p->stock_quantity }}" min="0" style="width:80px;padding:6px;border:1px solid #d1d5db;border-radius:6px;font-size:13px">
              <button type="submit" class="btn btn-primary btn-sm">Update</button>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="5" style="text-align:center;padding:40px;color:var(--text-muted)">✅ All products have sufficient stock!</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
