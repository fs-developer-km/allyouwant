@extends('admin.layouts.admin')
@section('title','Customer Detail')@section('breadcrumb','Customer Detail')
@section('content')
<div class="page-header">
  <div><div class="page-title">👤 {{ $customer->name }}</div><div class="page-sub">{{ $customer->email }}</div></div>
  <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary">← Back</a>
</div>
<div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
  <div class="card">
    <div class="card-header"><div class="card-title">Customer Info</div></div>
    <div class="card-body" style="font-size:13px;display:flex;flex-direction:column;gap:10px">
      <div style="display:flex;justify-content:space-between"><span style="color:var(--text-muted)">Name</span><strong>{{ $customer->name }}</strong></div>
      <div style="display:flex;justify-content:space-between"><span style="color:var(--text-muted)">Email</span><span>{{ $customer->email }}</span></div>
      <div style="display:flex;justify-content:space-between"><span style="color:var(--text-muted)">Phone</span><span>{{ $customer->phone ?? '—' }}</span></div>
      <div style="display:flex;justify-content:space-between"><span style="color:var(--text-muted)">Joined</span><span>{{ $customer->created_at->format('d M Y') }}</span></div>
      <div style="display:flex;justify-content:space-between"><span style="color:var(--text-muted)">Total Orders</span><strong>{{ $customer->orders->count() }}</strong></div>
      <div style="display:flex;justify-content:space-between"><span style="color:var(--text-muted)">Total Spent</span><strong style="color:var(--green)">₹{{ number_format($customer->orders->sum('total')) }}</strong></div>
    </div>
  </div>
  <div class="card">
    <div class="card-header"><div class="card-title">Recent Orders</div></div>
    <div class="table-wrap" style="border:none">
      <table>
        <thead><tr><th>Order #</th><th>Total</th><th>Status</th><th>Date</th></tr></thead>
        <tbody>
          @forelse($customer->orders->take(5) as $o)
          <tr>
            <td><a href="{{ route('admin.orders.show',$o->id) }}" style="color:var(--green)">#{{ $o->order_number }}</a></td>
            <td>₹{{ number_format($o->total) }}</td>
            <td><span class="badge badge-{{ $o->status_badge_color }}">{{ $o->status_label }}</span></td>
            <td style="font-size:12px;color:var(--text-muted)">{{ $o->created_at->format('d M Y') }}</td>
          </tr>
          @empty
          <tr><td colspan="4" style="text-align:center;padding:20px;color:var(--text-muted)">No orders yet</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
