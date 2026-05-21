{{-- ════════════════════════════════════════════
    resources/views/admin/categories/index.blade.php
════════════════════════════════════════════ --}}
@extends('admin.layouts.admin')
@section('title','Categories')
@section('breadcrumb','Categories')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">🗂️ Categories</div>
    <div class="page-sub">Manage product categories ({{ $categories->total() }} total)</div>
  </div>
  <div class="page-actions">
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">+ Add Category</a>
  </div>
</div>

{{-- Filters --}}
<div class="filters-bar">
  <form method="GET" action="{{ route('admin.categories.index') }}" style="display:flex;gap:10px;flex-wrap:wrap;width:100%">
    <div class="search-filter">
      🔍
      <input type="text" name="search" value="{{ request('search') }}" placeholder="Search categories...">
    </div>
    <select name="status" class="filter-select" onchange="this.form.submit()">
      <option value="">All Status</option>
      <option value="1" {{ request('status')==='1' ? 'selected' : '' }}>Active</option>
      <option value="0" {{ request('status')==='0' ? 'selected' : '' }}>Inactive</option>
    </select>
    <button type="submit" class="btn btn-secondary">Filter</button>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Reset</a>
  </form>
</div>

{{-- Table --}}
<div class="card">
  <div class="table-wrap" style="border:none">
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Category</th>
          <th>Slug</th>
          <th>Parent</th>
          <th>Products</th>
          <th>Homepage</th>
          <th>Status</th>
          <th>Sort</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($categories as $cat)
        <tr id="cat-row-{{ $cat->id }}">
          <td style="color:var(--text-muted)">{{ $cat->id }}</td>
          <td>
            <div class="td-flex">
              @if($cat->image)
                <img src="{{ asset('storage/'.$cat->image) }}" alt="" class="td-img">
              @else
                <div class="td-img">🗂️</div>
              @endif
              <div>
                <div class="td-name">{{ $cat->name }}</div>
                @if($cat->description)
                  <div class="td-sub">{{ Str::limit($cat->description, 40) }}</div>
                @endif
              </div>
            </div>
          </td>
          <td><code style="font-size:12px;background:#f1f5f9;padding:2px 6px;border-radius:4px">{{ $cat->slug }}</code></td>
           <td>
  @if($cat->parent?->name)
    {{ $cat->parent->name }}
  @else
    <span style="color:var(--text-muted)">—</span>
  @endif
</td>
          <td>
            <a href="{{ route('admin.products.index') }}?category={{ $cat->id }}" class="badge badge-info" style="text-decoration:none">
              {{ $cat->products_count }}
            </a>
          </td>
          <td>
            @if($cat->show_on_homepage)
              <span class="badge badge-success">Yes</span>
            @else
              <span class="badge badge-secondary">No</span>
            @endif
          </td>
          <td>
            <label class="toggle-wrap" style="cursor:pointer">
              <div class="toggle">
                <input type="checkbox"
                  {{ $cat->is_active ? 'checked' : '' }}
                  onchange="toggleStatus({{ $cat->id }}, this)">
                <span class="toggle-slider"></span>
              </div>
              <span class="toggle-label" id="status-lbl-{{ $cat->id }}">
                {{ $cat->is_active ? 'Active' : 'Inactive' }}
              </span>
            </label>
          </td>
          <td>{{ $cat->sort_order }}</td>
          <td>
            <div class="td-actions">
              <a href="{{ route('admin.categories.edit', $cat->id) }}"
                class="btn btn-secondary btn-sm btn-icon" title="Edit">✏️</a>
              <form action="{{ route('admin.categories.destroy', $cat->id) }}"
                method="POST" onsubmit="return confirmDelete(this)">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm btn-icon" title="Delete">🗑️</button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="9" style="text-align:center;padding:48px;color:var(--text-muted)">
            <div style="font-size:36px;margin-bottom:10px">🗂️</div>
            <div style="font-size:15px;font-weight:500;margin-bottom:6px">No categories yet</div>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary" style="margin-top:8px">+ Add First Category</a>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
  @if($categories->hasPages())
  <div class="card-footer" style="display:flex;align-items:center;justify-content:space-between">
    <div style="font-size:13px;color:var(--text-muted)">
      Showing {{ $categories->firstItem() }}–{{ $categories->lastItem() }} of {{ $categories->total() }}
    </div>
    <div class="pagination">
      @if($categories->onFirstPage())
        <div class="page-item disabled">‹</div>
      @else
        <a href="{{ $categories->previousPageUrl() }}" class="page-item">‹</a>
      @endif
      @foreach($categories->getUrlRange(1, $categories->lastPage()) as $page => $url)
        <a href="{{ $url }}" class="page-item {{ $categories->currentPage() == $page ? 'active' : '' }}">{{ $page }}</a>
      @endforeach
      @if($categories->hasMorePages())
        <a href="{{ $categories->nextPageUrl() }}" class="page-item">›</a>
      @else
        <div class="page-item disabled">›</div>
      @endif
    </div>
  </div>
  @endif
</div>
@endsection

@push('scripts')
<script>
function toggleStatus(id, checkbox) {
  fetch(`/admin/categories/${id}/toggle`, {
    method: 'POST',
    headers: { 'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/json' },
  })
  .then(r => r.json())
  .then(d => {
    document.getElementById('status-lbl-' + id).textContent = d.status ? 'Active' : 'Inactive';
    showToast(d.message, 'success');
  })
  .catch(() => { checkbox.checked = !checkbox.checked; showToast('Something went wrong', 'error'); });
}
</script>
@endpush


{{-- ════════════════════════════════════════════
    resources/views/admin/categories/create.blade.php
    (Also used as edit.blade.php with minor changes)
════════════════════════════════════════════ --}}