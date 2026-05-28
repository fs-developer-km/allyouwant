{{-- resources/views/admin/categories/create.blade.php --}}
@extends('admin.layouts.admin')
@section('title', isset($category) ? 'Edit Category' : 'Add Category')
@section('breadcrumb', isset($category) ? 'Edit Category' : 'Add Category')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">{{ isset($category) ? '✏️ Edit Category' : '➕ Add New Category' }}</div>
    <div class="page-sub">{{ isset($category) ? 'Update category details' : 'Create a new product category' }}</div>
  </div>
  <div class="page-actions">
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">← Back to Categories</a>
  </div>
</div>

<form action="{{ isset($category) ? route('admin.categories.update', $category->id) : route('admin.categories.store') }}"
      method="POST" enctype="multipart/form-data" id="catForm">
  @csrf
  @if(isset($category)) @method('PUT') @endif

  <div style="display:grid;grid-template-columns:1fr 340px;gap:20px;align-items:start">

    {{-- Left: Main Info --}}
    <div style="display:flex;flex-direction:column;gap:16px">

      {{-- Basic Info --}}
      <div class="card">
        <div class="card-header"><div class="card-title">📝 Basic Information</div></div>
        <div class="card-body">
          <div class="form-grid">
            <div class="form-group form-full">
              <label class="form-label">Category Name <span>*</span></label>
              <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $category->name ?? '') }}"
                placeholder="e.g. Fresh Vegetables" required>
              @error('name')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group form-full">
              <label class="form-label">Description</label>
              <textarea name="description" class="form-control" rows="3"
                placeholder="Short description of this category...">{{ old('description', $category->description ?? '') }}</textarea>
            </div>

            <div class="form-group">
              <label class="form-label">Parent Category</label>
              <select name="parent_id" class="form-control">
                <option value="">— None (Top Level) —</option>
                @foreach($parents as $parent)
                  <option value="{{ $parent->id }}"
                    {{ old('parent_id', $category->parent_id ?? '') == $parent->id ? 'selected' : '' }}>
                    {{ $parent->name }}
                  </option>
                @endforeach
              </select>
              <div class="form-hint">Leave empty for top-level category</div>
            </div>

            <div class="form-group">
              <label class="form-label">Sort Order</label>
              <input type="number" name="sort_order" class="form-control"
                value="{{ old('sort_order', $category->sort_order ?? 0) }}"
                min="0" placeholder="0">
              <div class="form-hint">Lower number = shown first</div>
            </div>
          </div>
        </div>
      </div>

      {{-- SEO --}}
      <div class="card">
        <div class="card-header"><div class="card-title">🔍 SEO & Visibility</div></div>
        <div class="card-body">
          <div class="form-group" style="margin-bottom:16px">
            <label class="form-label">URL Slug</label>
            <input type="text" id="slugPreview" class="form-control" readonly
              value="{{ isset($category) ? $category->slug : '' }}"
              style="background:#f8fafc;color:var(--text-muted)">
            <div class="form-hint">Auto-generated from name</div>
          </div>
          <div style="display:flex;flex-direction:column;gap:14px">
            <div class="toggle-wrap">
              <label class="toggle">
                <input type="checkbox" name="is_active"
                  {{ old('is_active', $category->is_active ?? true) ? 'checked' : '' }}>
                <span class="toggle-slider"></span>
              </label>
              <span class="toggle-label">Active — show on website</span>
            </div>
            <div class="toggle-wrap">
              <label class="toggle">
                <input type="checkbox" name="show_on_homepage"
                  {{ old('show_on_homepage', $category->show_on_homepage ?? false) ? 'checked' : '' }}>
                <span class="toggle-slider"></span>
              </label>
              <span class="toggle-label">Show on Homepage</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- Right: Image + Actions --}}
    <div style="display:flex;flex-direction:column;gap:16px">

      {{-- Image --}}
      <div class="card">
        <div class="card-header"><div class="card-title">🖼️ Category Image</div></div>
        <div class="card-body">
          {{-- Preview --}}
          <div id="imgPreviewWrap" >
            <img id="imgPreview"
              src="{{ isset($category) && $category->image ? asset('storage/'.$category->image) : '' }}"
              alt="Preview"
              style="width:100%;height:160px;object-fit:cover;border-radius:8px;border:1px solid var(--border)">
            <button type="button" onclick="removeImage()"
              style="display:block;width:100%;margin-top:8px;padding:6px;background:#fef2f2;color:#dc2626;border:1px solid #fecaca;border-radius:6px;font-size:12px;cursor:pointer">
              🗑️ Remove Image
            </button>
          </div>

          <div class="upload-area" id="uploadArea" onclick="document.getElementById('imageInput').click()"
            {{ isset($category) && $category->image ? 'style=display:none' : '' }}>
            <div class="upload-icon">📷</div>
            <div class="upload-title">Click to upload image</div>
            <div class="upload-sub">JPG, PNG, WebP — max 2MB</div>
          </div>
          <input type="file" id="imageInput" name="image" accept="image/*"
            style="display:none" onchange="previewImage(this)">
          @error('image')<div class="form-error" style="margin-top:8px">{{ $message }}</div>@enderror
        </div>
      </div>

      {{-- Actions --}}
      <div class="card">
        <div class="card-body" style="display:flex;flex-direction:column;gap:10px">
          <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center">
            {{ isset($category) ? '💾 Update Category' : '✅ Create Category' }}
          </button>
          <a href="{{ route('admin.categories.index') }}"
            class="btn btn-secondary" style="width:100%;justify-content:center">
            ✕ Cancel
          </a>
          @if(isset($category))
          <form action="{{ route('admin.categories.destroy', $category->id) }}"
            method="POST" onsubmit="return confirmDelete(this)">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-danger" style="width:100%;justify-content:center">
              🗑️ Delete Category
            </button>
          </form>
          @endif
        </div>
      </div>

      {{-- Tips --}}
      <div class="card" style="background:#f0faf4;border-color:#bbf7d0">
        <div class="card-body">
          <div style="font-size:13px;font-weight:600;color:#15803d;margin-bottom:8px">💡 Tips</div>
          <ul style="font-size:12.5px;color:#166534;line-height:1.8;padding-left:16px">
            <li>Use clear, descriptive names</li>
            <li>Square images look best (400×400px)</li>
            <li>Set sort order to control display sequence</li>
            <li>Enable "Show on Homepage" for featured categories</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</form>
@endsection

@push('scripts')
<script>
// Auto-generate slug from name
document.querySelector('[name="name"]').addEventListener('input', function() {
  const slug = this.value.toLowerCase()
    .replace(/[^a-z0-9\s-]/g, '')
    .replace(/\s+/g, '-')
    .replace(/-+/g, '-');
  document.getElementById('slugPreview').value = slug;
});

// Image preview
function previewImage(input) {
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = e => {
      document.getElementById('imgPreview').src = e.target.result;
      document.getElementById('imgPreviewWrap').style.display = 'block';
      document.getElementById('uploadArea').style.display = 'none';
    };
    reader.readAsDataURL(input.files[0]);
  }
}

// Remove image
function removeImage() {
  document.getElementById('imageInput').value = '';
  document.getElementById('imgPreviewWrap').style.display = 'none';
  document.getElementById('uploadArea').style.display = 'block';
}

// Drag & drop
const uploadArea = document.getElementById('uploadArea');
uploadArea.addEventListener('dragover', e => { e.preventDefault(); uploadArea.style.borderColor='var(--green)'; });
uploadArea.addEventListener('dragleave', () => { uploadArea.style.borderColor=''; });
uploadArea.addEventListener('drop', e => {
  e.preventDefault();
  uploadArea.style.borderColor = '';
  const files = e.dataTransfer.files;
  if (files[0]) {
    document.getElementById('imageInput').files = files;
    previewImage({ files });
  }
});
</script>
@endpush