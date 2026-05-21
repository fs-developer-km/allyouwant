{{-- resources/views/admin/orders/show.blade.php --}}
@extends('admin.layouts.admin')
@section('title','Order #'.$order->order_number)
@section('breadcrumb','Order Detail')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Order #{{ $order->order_number }}</div>
    <div class="page-sub">Placed on {{ optional($order->created_at)->format('d M Y, h:i A') ?? 'N/A' }}</div>
  </div>
  <div class="page-actions">
    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">← Back</a>
    <a href="{{ route('admin.orders.invoice', $order->id) }}" target="_blank" class="btn btn-secondary">🖨️ Print Invoice</a>
  </div>
</div>

<div style="display:grid;grid-template-columns:1fr 320px;gap:20px;align-items:start">

  {{-- Left --}}
  <div style="display:flex;flex-direction:column;gap:16px">

    {{-- Order Items --}}
    <div class="card">
      <div class="card-header"><div class="card-title">🛒 Order Items</div></div>
      <div class="table-wrap" style="border:none">
        <table>
          <thead><tr><th>Product</th><th>Price</th><th>Qty</th><th>Subtotal</th></tr></thead>
          <tbody>
            @foreach($order->items as $item)
            <tr>
              <td>
                <div class="td-flex">
                  @if($item->product_image)
                    <img src="{{ asset('storage/'.$item->product_image) }}" class="td-img" style="object-fit:cover">
                  @else
                    <div class="td-img">🛒</div>
                  @endif
                  <div class="td-name">{{ $item->product_name }}</div>
                </div>
              </td>
              <td>₹{{ number_format($item->price) }}</td>
              <td>× {{ $item->quantity }}</td>
              <td><strong>₹{{ number_format($item->subtotal) }}</strong></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="card-footer">
        <div style="max-width:250px;margin-left:auto">
          <div style="display:flex;justify-content:space-between;font-size:13px;padding:5px 0;border-bottom:1px solid var(--border)">
            <span>Subtotal</span><span>₹{{ number_format($order->subtotal) }}</span>
          </div>
          <div style="display:flex;justify-content:space-between;font-size:13px;padding:5px 0;border-bottom:1px solid var(--border)">
            <span>Delivery</span><span>{{ $order->delivery_charge > 0 ? '₹'.number_format($order->delivery_charge) : 'FREE' }}</span>
          </div>
          @if($order->discount > 0)
          <div style="display:flex;justify-content:space-between;font-size:13px;padding:5px 0;border-bottom:1px solid var(--border);color:#16a34a">
            <span>Discount {{ $order->coupon_code ? '('.$order->coupon_code.')' : '' }}</span>
            <span>-₹{{ number_format($order->discount) }}</span>
          </div>
          @endif
          <div style="display:flex;justify-content:space-between;font-size:15px;font-weight:700;padding:8px 0">
            <span>Total</span><span>₹{{ number_format($order->total) }}</span>
          </div>
        </div>
      </div>
    </div>

    {{-- Status Timeline --}}
    <div class="card">
      <div class="card-header"><div class="card-title">📋 Status History</div></div>
      <div class="card-body">
        @foreach($order->statusHistory as $history)
        <div style="display:flex;gap:14px;padding:10px 0;border-bottom:1px solid #f1f5f9">
          <div style="width:10px;height:10px;border-radius:50%;background:var(--green);margin-top:4px;flex-shrink:0"></div>
          <div style="flex:1">
            <div style="font-weight:600;font-size:13px">{{ ucwords(str_replace('_',' ',$history->status)) }}</div>
            <div style="font-size:12px;color:var(--text-muted)">{{ $history->comment }}</div>
            <div style="font-size:11.5px;color:var(--text-muted);margin-top:3px">
              {{ $history->created_at->format('d M Y h:i A') }}
              @if($history->updatedBy) · by {{ $history->updatedBy->name }} @endif
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>

  {{-- Right --}}
  <div style="display:flex;flex-direction:column;gap:16px">

    {{-- Update Status --}}
    <div class="card">
      <div class="card-header"><div class="card-title">🔄 Update Status</div></div>
      <div class="card-body">
        <form action="{{ route('admin.orders.status', $order->id) }}" method="POST">
          @csrf @method('PUT')
          <div class="form-group" style="margin-bottom:12px">
            <label class="form-label">New Status</label>
            <select name="status" class="form-control">
              @foreach(['pending','confirmed','processing','shipped','out_for_delivery','delivered','cancelled','refunded'] as $s)
                <option value="{{ $s }}" {{ $order->status === $s ? 'selected' : '' }}>
                  {{ ucwords(str_replace('_',' ',$s)) }}
                </option>
              @endforeach
            </select>
          </div>
          <div class="form-group" style="margin-bottom:14px">
            <label class="form-label">Comment (optional)</label>
            <textarea name="comment" class="form-control" rows="2" placeholder="Add a note..."></textarea>
          </div>
          <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center">
            Update Status
          </button>
        </form>
      </div>
    </div>

    {{-- Customer Info --}}
    <div class="card">
      <div class="card-header"><div class="card-title">👤 Customer</div></div>
      <div class="card-body" style="font-size:13px">
        <div style="display:flex;align-items:center;gap:10px;margin-bottom:14px">
          <div style="width:40px;height:40px;border-radius:50%;background:#dcfce7;color:#16a34a;display:flex;align-items:center;justify-content:center;font-weight:700">
            {{ substr($order->user->name ?? 'U', 0, 2) }}
          </div>
          <div>
            <div style="font-weight:600">{{ $order->user->name ?? 'N/A' }}</div>
            <div style="color:var(--text-muted)">{{ $order->user->email ?? '' }}</div>
          </div>
        </div>
        <div style="display:flex;flex-direction:column;gap:8px;color:var(--text-muted)">
          <div>📞 {{ $order->delivery_phone }}</div>
          <div>📍 {{ $order->delivery_address }}, {{ $order->delivery_city }}, {{ $order->delivery_state }} - {{ $order->delivery_pincode }}</div>
        </div>
      </div>
    </div>

    {{-- Payment Info --}}
    <div class="card">
      <div class="card-header"><div class="card-title">💳 Payment</div></div>
      <div class="card-body" style="font-size:13px;display:flex;flex-direction:column;gap:8px">
        <div style="display:flex;justify-content:space-between">
          <span style="color:var(--text-muted)">Method</span>
          <span class="badge {{ $order->payment_method==='cod' ? 'badge-secondary' : 'badge-info' }}">{{ strtoupper($order->payment_method) }}</span>
        </div>
        <div style="display:flex;justify-content:space-between">
          <span style="color:var(--text-muted)">Status</span>
          <span class="badge {{ $order->payment_status==='paid' ? 'badge-success' : 'badge-warning' }}">{{ ucfirst($order->payment_status) }}</span>
        </div>
        @if($order->payment_id)
        <div style="display:flex;justify-content:space-between">
          <span style="color:var(--text-muted)">Payment ID</span>
          <code style="font-size:11px">{{ $order->payment_id }}</code>
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection