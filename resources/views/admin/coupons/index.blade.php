@extends('admin.layouts.admin')
@section('title','Coupons')@section('breadcrumb','Coupons')
@section('content')
<div class="page-header">
  <div><div class="page-title">🎟️ Coupons</div><div class="page-sub">{{ $coupons->total() }} total coupons</div></div>
  <div class="page-actions"><a href="{{ route('admin.coupons.create') }}" class="btn btn-primary">+ Add Coupon</a></div>
</div>
<div class="card">
  <div class="table-wrap" style="border:none">
    <table>
      <thead><tr><th>Code</th><th>Type</th><th>Value</th><th>Min Order</th><th>Used</th><th>Expiry</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
        @forelse($coupons as $c)
        <tr>
          <td><strong style="font-family:monospace;font-size:14px;color:var(--green)">{{ $c->code }}</strong><div class="td-sub">{{ $c->description }}</div></td>
          <td><span class="badge badge-info">{{ ucfirst($c->type) }}</span></td>
          <td><strong>{{ $c->type==='percent' ? $c->value.'%' : '₹'.$c->value }}</strong></td>
          <td>₹{{ number_format($c->min_order_amount) }}</td>
          <td>{{ $c->used_count }}{{ $c->usage_limit ? '/'.$c->usage_limit : '' }}</td>
          <td style="font-size:12px;color:var(--text-muted)">{{ $c->end_date ? $c->end_date->format('d M Y') : '—' }}</td>
          <td><span class="badge {{ $c->is_active ? 'badge-success':'badge-secondary' }}">{{ $c->is_active?'Active':'Off' }}</span></td>
          <td>
            <div class="td-actions">
              <a href="{{ route('admin.coupons.edit',$c->id) }}" class="btn btn-secondary btn-sm">✏️</a>
              <form action="{{ route('admin.coupons.destroy',$c->id) }}" method="POST" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="btn btn-danger btn-sm">🗑️</button></form>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="8" style="text-align:center;padding:40px;color:var(--text-muted)">No coupons yet<br><a href="{{ route('admin.coupons.create') }}" class="btn btn-primary" style="margin-top:12px;display:inline-flex">+ Add Coupon</a></td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  @if($coupons->hasPages())<div class="card-footer">{{ $coupons->links() }}</div>@endif
</div>
@endsection
