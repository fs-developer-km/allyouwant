@extends('admin.layouts.admin')
@section('title','Customers')@section('breadcrumb','Customers')
@section('content')
<div class="page-header"><div><div class="page-title">👥 Customers</div><div class="page-sub">{{ $customers->total() }} total customers</div></div></div>
<div class="card">
  <div class="table-wrap" style="border:none">
    <table>
      <thead><tr><th>#</th><th>Name</th><th>Email</th><th>Phone</th><th>Orders</th><th>Joined</th></tr></thead>
      <tbody>
        @forelse($customers as $c)
        <tr>
          <td>{{ $c->id }}</td>
          <td><strong>{{ $c->name }}</strong></td>
          <td>{{ $c->email }}</td>
          <td>{{ $c->phone ?? '—' }}</td>
          <td><span class="badge badge-info">{{ $c->orders->count() }}</span></td>
          <td style="color:var(--text-muted)">{{ $c->created_at->format('d M Y') }}</td>
        </tr>
        @empty
        <tr><td colspan="6" style="text-align:center;padding:40px;color:var(--text-muted)">No customers yet</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  @if($customers->hasPages())<div class="card-footer">{{ $customers->links() }}</div>@endif
</div>
@endsection
