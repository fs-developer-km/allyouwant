@extends('admin.layouts.admin')
@section('title','Product Report')@section('breadcrumb','Product Report')
@section('content')
<div class="page-header"><div><div class="page-title">📦 Product Report</div></div></div>
<div class="card">
  <div class="table-wrap" style="border:none">
    <table>
      <thead><tr><th>Product</th><th>Category</th><th>Price</th><th>Stock</th><th>Orders</th><th>Revenue</th></tr></thead>
      <tbody>
        @forelse($products as $i => $p)
        <tr>
          <td><strong>{{ $p->name }}</strong></td>
          <td>{{ $p->category->name ?? '—' }}</td>
          <td>₹{{ number_format($p->current_price) }}</td>
          <td><span class="badge {{ $p->stock_quantity > 10 ? 'badge-success' : 'badge-warning' }}">{{ $p->stock_quantity }}</span></td>
          <td>{{ $p->order_items_count ?? 0 }}</td>
          <td><strong style="color:var(--green)">₹{{ number_format($p->order_items_sum_subtotal ?? 0) }}</strong></td>
        </tr>
        @empty
        <tr><td colspan="6" style="text-align:center;padding:40px;color:var(--text-muted)">No data</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
