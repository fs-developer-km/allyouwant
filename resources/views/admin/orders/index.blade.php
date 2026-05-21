{{-- resources/views/admin/orders/index.blade.php --}}
@extends('admin.layouts.admin')
@section('title','Orders')
@section('breadcrumb','Orders')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">🧾 Orders</div>
    <div class="page-sub">Manage all customer orders</div>
  </div>
</div>

{{-- Status tabs --}}
<div style="display:flex;gap:6px;flex-wrap:wrap;margin-bottom:16px">
  @foreach([
    'all'=>['label'=>'All','color'=>'secondary'],
    'pending'=>['label'=>'Pending','color'=>'warning'],
    'confirmed'=>['label'=>'Confirmed','color'=>'info'],
    'processing'=>['label'=>'Processing','color'=>'info'],
    'shipped'=>['label'=>'Shipped','color'=>'secondary'],
    'out_for_delivery'=>['label'=>'Out for Delivery','color'=>'info'],
    'delivered'=>['label'=>'Delivered','color'=>'success'],
    'cancelled'=>['label'=>'Cancelled','color'=>'danger'],
  ] as $key => $info)
  <a href="{{ route('admin.orders.index') }}?status={{ $key === 'all' ? '' : $key }}&search={{ request('search') }}"
    class="badge badge-{{ $info['color'] }}"
    style="padding:6px 14px;font-size:12.5px;cursor:pointer;text-decoration:none;{{ request('status', 'all') === $key ? 'outline:2px solid currentColor' : '' }}">
    {{ $info['label'] }} ({{ $statusCounts[$key] ?? 0 }})
  </a>
  @endforeach
</div>

{{-- Filters --}}
<div class="filters-bar">
  <form method="GET" style="display:flex;gap:10px;flex-wrap:wrap;width:100%">
    <input type="hidden" name="status" value="{{ request('status') }}">
    <div class="search-filter">
      🔍
      <input type="text" name="search" value="{{ request('search') }}" placeholder="Order # or customer name...">
    </div>
    <select name="payment" class="filter-select" onchange="this.form.submit()">
      <option value="">All Payments</option>
      <option value="cod" {{ request('payment')==='cod' ? 'selected' : '' }}>COD</option>
      <option value="online" {{ request('payment')==='online' ? 'selected' : '' }}>Online</option>
    </select>
    <input type="date" name="date_from" value="{{ request('date_from') }}" class="filter-select">
    <input type="date" name="date_to" value="{{ request('date_to') }}" class="filter-select">
    <button type="submit" class="btn btn-secondary">Filter</button>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Reset</a>
  </form>
</div>

<div class="card">
  <div class="table-wrap" style="border:none">
    <table>
      <thead>
        <tr>
          <th>Order #</th>
          <th>Customer</th>
          <th>Items</th>
          <th>Total</th>
          <th>Payment</th>
          <th>Status</th>
          <th>Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($orders as $order)
        <tr>
          <td><strong style="color:var(--green)">#{{ $order->order_number }}</strong></td>
          <td>
            <div class="td-name">{{ $order->delivery_name }}</div>
            <div class="td-sub">{{ $order->user->email ?? '' }}</div>
          </td>
          <td style="color:var(--text-muted)">{{ $order->items->count() }} items</td>
          <td>
            <strong>₹{{ number_format($order->total) }}</strong>
            @if($order->discount > 0)
              <div style="font-size:11px;color:#16a34a">-₹{{ number_format($order->discount) }} off</div>
            @endif
          </td>
          <td>
            <span class="badge {{ $order->payment_method === 'cod' ? 'badge-secondary' : 'badge-info' }}">
              {{ strtoupper($order->payment_method) }}
            </span>
            <div>
              <span class="badge {{ $order->payment_status === 'paid' ? 'badge-success' : 'badge-warning' }}" style="margin-top:3px">
                {{ ucfirst($order->payment_status) }}
              </span>
            </div>
          </td>
          <td>
            <span class="badge badge-{{ $order->status_badge_color }}">
              {{ $order->status_label }}
            </span>
          </td>
          <td style="color:var(--text-muted);font-size:12px;white-space:nowrap">
            {{ $order->created_at->format('d M Y') }}<br>
            {{ $order->created_at->format('h:i A') }}
          </td>
          <td>
            <div class="td-actions">
              <a href="{{ route('admin.orders.show', $order->id) }}"
                class="btn btn-secondary btn-sm">View</a>
              <a href="{{ route('admin.orders.invoice', $order->id) }}" target="_blank"
                class="btn btn-secondary btn-sm btn-icon" title="Invoice">🖨️</a>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="8" style="text-align:center;padding:48px;color:var(--text-muted)">
            <div style="font-size:36px;margin-bottom:10px">🧾</div>
            No orders found
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
  @if($orders->hasPages())
  <div class="card-footer" style="display:flex;align-items:center;justify-content:space-between">
    <div style="font-size:13px;color:var(--text-muted)">{{ $orders->firstItem() }}–{{ $orders->lastItem() }} of {{ $orders->total() }}</div>
    <div class="pagination">
      @if(!$orders->onFirstPage())<a href="{{ $orders->previousPageUrl() }}" class="page-item">‹</a>@else<div class="page-item disabled">‹</div>@endif
      @foreach($orders->getUrlRange(max(1,$orders->currentPage()-2), min($orders->lastPage(),$orders->currentPage()+2)) as $page => $url)
        <a href="{{ $url }}" class="page-item {{ $orders->currentPage()==$page ? 'active' : '' }}">{{ $page }}</a>
      @endforeach
      @if($orders->hasMorePages())<a href="{{ $orders->nextPageUrl() }}" class="page-item">›</a>@else<div class="page-item disabled">›</div>@endif
    </div>
  </div>
  @endif
</div>
@endsection


{{-- ══════════════════════════════════════════════
    resources/views/admin/orders/show.blade.php
══════════════════════════════════════════════ --}}