@extends('admin.layouts.admin')
@section('title','Reviews')@section('breadcrumb','Reviews')
@section('content')
<div class="page-header"><div><div class="page-title">⭐ Reviews</div></div></div>
<div class="card">
  <div class="table-wrap" style="border:none">
    <table>
      <thead><tr><th>Product</th><th>Customer</th><th>Rating</th><th>Review</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
        @forelse($reviews as $r)
        <tr>
          <td>{{ $r->product->name ?? '—' }}</td>
          <td>{{ $r->user->name ?? '—' }}</td>
          <td style="color:#f59e0b">{{ str_repeat('★',$r->rating) }}</td>
          <td style="max-width:200px">{{ Str::limit($r->body,60) }}</td>
          <td><span class="badge {{ $r->is_approved ? 'badge-success' : 'badge-warning' }}">{{ $r->is_approved ? 'Approved' : 'Pending' }}</span></td>
          <td>
            <form action="{{ route('admin.reviews.approve',$r->id) }}" method="POST" style="display:inline">@csrf<button type="submit" class="btn btn-secondary btn-sm">{{ $r->is_approved ? 'Unapprove' : 'Approve' }}</button></form>
            <form action="{{ route('admin.reviews.destroy',$r->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button type="submit" class="btn btn-danger btn-sm">Delete</button></form>
          </td>
        </tr>
        @empty
        <tr><td colspan="6" style="text-align:center;padding:40px;color:var(--text-muted)">No reviews yet</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
