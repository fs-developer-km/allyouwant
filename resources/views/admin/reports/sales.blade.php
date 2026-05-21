@extends('admin.layouts.admin')
@section('title','Sales Report')@section('breadcrumb','Sales Report')
@section('content')
<div class="page-header"><div><div class="page-title">📈 Sales Report</div><div class="page-sub">Total revenue: ₹{{ number_format($total) }}</div></div></div>
<div class="card">
  <div class="table-wrap" style="border:none">
    <table>
      <thead><tr><th>Order #</th><th>Customer</th><th>Total</th><th>Date</th><th>Status</th></tr></thead>
      <tbody>
        @forelse($orders as $order)
        <tr>
          <td><strong style="color:var(--green)">#{{ $order->order_number }}</strong></td>
          <td>{{ $order->user->name ?? 'N/A' }}</td>
          <td><strong>₹{{ number_format($order->total) }}</strong></td>
          <td>{{ $order->created_at->format('d M Y') }}</td>
          <td><span class="badge badge-success">Delivered</span></td>
        </tr>
        @empty
        <tr><td colspan="5" style="text-align:center;padding:40px;color:var(--text-muted)">No delivered orders yet</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
