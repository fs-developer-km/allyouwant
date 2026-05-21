@extends('admin.layouts.admin')
@section('title','Banners')@section('breadcrumb','Banners')
@section('content')
<div class="page-header">
  <div><div class="page-title">🖼️ Banners</div><div class="page-sub">Homepage slider banners</div></div>
  <div class="page-actions"><a href="{{ route('admin.banners.create') }}" class="btn btn-primary">+ Add Banner</a></div>
</div>
<div class="card">
  <div class="table-wrap" style="border:none">
    <table>
      <thead><tr><th>#</th><th>Banner</th><th>Button</th><th>Sort</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
        @forelse($banners as $b)
        <tr>
          <td>{{ $b->id }}</td>
          <td>
            <div class="td-flex">
              @if($b->image)<img src="{{ asset('storage/'.$b->image) }}" style="width:80px;height:44px;object-fit:cover;border-radius:6px">
              @else<div class="td-img">🖼️</div>@endif
              <div><div class="td-name">{{ $b->title }}</div><div class="td-sub">{{ $b->subtitle }}</div></div>
            </div>
          </td>
          <td>{{ $b->button_text }} → {{ $b->button_link }}</td>
          <td>{{ $b->sort_order }}</td>
          <td><span class="badge {{ $b->is_active ? 'badge-success' : 'badge-secondary' }}">{{ $b->is_active ? 'Active' : 'Inactive' }}</span></td>
          <td>
            <div class="td-actions">
              <a href="{{ route('admin.banners.edit',$b->id) }}" class="btn btn-secondary btn-sm">✏️ Edit</a>
              <form action="{{ route('admin.banners.destroy',$b->id) }}" method="POST" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="btn btn-danger btn-sm">🗑️</button></form>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="6" style="text-align:center;padding:40px;color:var(--text-muted)"><div style="font-size:36px;margin-bottom:10px">🖼️</div>No banners yet<br><a href="{{ route('admin.banners.create') }}" class="btn btn-primary" style="margin-top:12px;display:inline-flex">+ Add Banner</a></td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
