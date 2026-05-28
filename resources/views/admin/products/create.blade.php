@extends('admin.layouts.admin')
@section('title', 'Add Product')
@section('breadcrumb', 'Add Product')

@push('styles')
<style>
.img-gallery{display:grid;grid-template-columns:repeat(4,1fr);gap:10px;margin-top:12px}
.gallery-item{position:relative;aspect-ratio:1;border-radius:8px;overflow:hidden;border:1px solid var(--border)}
.gallery-item img{width:100%;height:100%;object-fit:cover}
.gallery-del{position:absolute;top:5px;right:5px;background:rgba(220,38,38,.9);border:none;color:#fff;width:24px;height:24px;border-radius:6px;font-size:13px;cursor:pointer;display:flex;align-items:center;justify-content:center}
.upload-drop{border:2px dashed var(--border);border-radius:10px;padding:28px;text-align:center;cursor:pointer;transition:all .2s;background:#fafafa}
.upload-drop:hover,.upload-drop.drag{border-color:var(--green);background:var(--green-light)}
.upload-drop .icon{font-size:32px;margin-bottom:8px}
.upload-drop .title{font-size:13.5px;font-weight:600;color:var(--text);margin-bottom:4px}
.upload-drop .sub{font-size:12px;color:var(--text-muted)}
.thumb-preview-box{width:100px;height:100px;border-radius:10px;overflow:hidden;border:2px solid var(--green);flex-shrink:0;position:relative}
.thumb-preview-box img{width:100%;height:100%;object-fit:cover}
.thumb-remove{position:absolute;top:4px;right:4px;background:rgba(220,38,38,.9);border:none;color:#fff;width:20px;height:20px;border-radius:50%;font-size:11px;cursor:pointer;display:flex;align-items:center;justify-content:center}
@media(max-width:768px){.prod-layout{grid-template-columns:1fr!important}}
</style>
@endpush

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">➕ Add New Product</div>
    <div class="page-sub">Fill in all details to add product to your store</div>
  </div>
  <div class="page-actions">
    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">← Back to Products</a>
  </div>
</div>

@if($errors->any())
<div class="alert alert-error">
  ❌ Please fix the following errors:
  <ul style="margin-top:6px;padding-left:20px">
    @foreach($errors->all() as $err)<li style="font-size:13px">{{ $err }}</li>@endforeach
  </ul>
</div>
@endif

{{-- IMPORTANT: Use POST with enctype for file upload --}}
<form action="{{ route('admin.products.store') }}"
      method="POST"
      enctype="multipart/form-data"
      id="productForm">
  @csrf

  <div style="display:grid;grid-template-columns:1fr 300px;gap:20px;align-items:start" class="prod-layout">

    {{-- LEFT --}}
    <div style="display:flex;flex-direction:column;gap:16px">

      {{-- Basic Info --}}
      <div class="card">
        <div class="card-header"><div class="card-title">📝 Basic Information</div></div>
        <div class="card-body">
          <div class="form-grid">
            <div class="form-group form-full">
              <label class="form-label">Product Name <span>*</span></label>
              <input type="text" name="name" class="form-control"
                value="{{ old('name') }}" placeholder="e.g. Fresh Broccoli" required
                oninput="generateSlug(this.value)">
              @error('name')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
              <label class="form-label">Category <span>*</span></label>
              <select name="category_id" class="form-control" required>
                <option value="">-- Select Category --</option>
                @foreach($categories as $cat)
                  <option value="{{ $cat->id }}" {{ old('category_id')==$cat->id ? 'selected':'' }}>{{ $cat->name }}</option>
                @endforeach
              </select>
              @error('category_id')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
              <label class="form-label">SKU / Barcode</label>
              <input type="text" name="sku" class="form-control" value="{{ old('sku') }}" placeholder="e.g. VEG-001">
              <div class="form-hint">Leave blank to auto-generate</div>
            </div>
            <div class="form-group form-full">
              <label class="form-label">Short Description</label>
              <input type="text" name="short_description" class="form-control"
                value="{{ old('short_description') }}" placeholder="One line summary...">
            </div>
            <div class="form-group form-full">
              <label class="form-label">Full Description</label>
              <textarea name="description" class="form-control" rows="4"
                placeholder="Detailed product description...">{{ old('description') }}</textarea>
            </div>
          </div>
        </div>
      </div>

      {{-- Pricing --}}
      <div class="card">
        <div class="card-header"><div class="card-title">💰 Pricing & Unit</div></div>
        <div class="card-body">
          <div class="form-grid">
            <div class="form-group">
              <label class="form-label">Original Price (₹) <span>*</span></label>
              <input type="number" name="price" class="form-control"
                value="{{ old('price') }}" placeholder="0" step="0.01" min="0" required
                id="origPrice" oninput="calcDiscount()">
              @error('price')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
              <label class="form-label">Sale Price (₹) <span style="color:#9ca3af;font-size:11px">(optional)</span></label>
              <input type="number" name="sale_price" class="form-control"
                value="{{ old('sale_price') }}" placeholder="0" step="0.01" min="0"
                id="salePrice" oninput="calcDiscount()">
              <div class="form-hint" id="discHint">Enter sale price to show discount badge</div>
            </div>
            <div class="form-group">
              <label class="form-label">Unit <span>*</span></label>
              <select name="unit" class="form-control" required>
                @foreach(['kg','gram','litre','ml','piece','packet','box','dozen','bundle'] as $u)
                  <option value="{{ $u }}" {{ old('unit')==$u ? 'selected':'' }}>{{ ucfirst($u) }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label class="form-label">Weight / Size</label>
              <input type="text" name="weight" class="form-control"
                value="{{ old('weight') }}" placeholder="e.g. 500g, 1kg, 250ml">
            </div>
          </div>
        </div>
      </div>

      {{-- *** IMAGE UPLOAD SECTION *** --}}
      <div class="card">
        <div class="card-header">
          <div class="card-title">🖼️ Product Images</div>
          <span style="font-size:12px;color:var(--text-muted)">JPG/PNG/WebP — Max 5MB each</span>
        </div>
        <div class="card-body">

          {{-- MAIN THUMBNAIL --}}
          <div style="margin-bottom:24px">
            <label class="form-label" style="margin-bottom:10px;display:block">
              📸 Main Product Image (Thumbnail) <span>*</span>
            </label>
            <div style="display:flex;align-items:center;gap:16px;flex-wrap:wrap">
              {{-- Preview box --}}
              <div id="thumbPreviewBox" style="display:none" class="thumb-preview-box">
                <img id="thumbPreviewImg" src="" alt="Thumbnail Preview">
                <button type="button" class="thumb-remove" onclick="removeThumb()">✕</button>
              </div>
              {{-- Upload area --}}
              <div id="thumbUploadArea" class="upload-drop" style="flex:1;min-width:200px;padding:20px"
                onclick="document.getElementById('thumbInput').click()"
                ondragover="event.preventDefault();this.classList.add('drag')"
                ondragleave="this.classList.remove('drag')"
                ondrop="handleThumbDrop(event)">
                <div class="icon">📷</div>
                <div class="title">Click to upload main image</div>
                <div class="sub">or drag & drop here</div>
              </div>
              <input type="file" id="thumbInput" name="thumbnail" accept="image/jpeg,image/png,image/webp,image/jpg"
                style="display:none" onchange="previewThumb(this)">
            </div>
            @error('thumbnail')<div class="form-error" style="margin-top:6px">{{ $message }}</div>@enderror
          </div>

          {{-- GALLERY IMAGES --}}
          <div>
            <label class="form-label" style="margin-bottom:10px;display:block">
              🖼️ Gallery Images <span style="color:#9ca3af;font-size:11px">(optional, multiple)</span>
            </label>
            <div class="upload-drop" id="galleryDrop"
              onclick="document.getElementById('galleryInput').click()"
              ondragover="event.preventDefault();this.classList.add('drag')"
              ondragleave="this.classList.remove('drag')"
              ondrop="handleGalleryDrop(event)">
              <div class="icon">📁</div>
              <div class="title">Click to add gallery images</div>
              <div class="sub">Multiple images allowed — shown in product detail</div>
            </div>
            <input type="file" id="galleryInput" name="images[]" accept="image/*"
              style="display:none" multiple onchange="previewGallery(this.files)">
            <div class="img-gallery" id="galleryPreview" style="margin-top:12px"></div>
          </div>
        </div>
      </div>
    </div>

    {{-- RIGHT --}}
    <div style="display:flex;flex-direction:column;gap:16px">

      {{-- Inventory --}}
      <div class="card">
        <div class="card-header"><div class="card-title">📦 Inventory</div></div>
        <div class="card-body" style="display:flex;flex-direction:column;gap:14px">
          <div class="form-group">
            <label class="form-label">Stock Quantity <span>*</span></label>
            <input type="number" name="stock_quantity" class="form-control"
              value="{{ old('stock_quantity', 0) }}" min="0" required>
          </div>
          <div class="form-group">
            <label class="form-label">Low Stock Alert</label>
            <input type="number" name="low_stock_alert" class="form-control"
              value="{{ old('low_stock_alert', 10) }}" min="0">
            <div class="form-hint">Alert when stock falls below this</div>
          </div>
          <div class="toggle-wrap">
            <label class="toggle">
              <input type="checkbox" name="track_inventory" checked>
              <span class="toggle-slider"></span>
            </label>
            <span class="toggle-label">Track inventory</span>
          </div>
        </div>
      </div>

      {{-- Status --}}
      <div class="card">
        <div class="card-header"><div class="card-title">🏷️ Status & Badges</div></div>
        <div class="card-body" style="display:flex;flex-direction:column;gap:14px">
          <div class="toggle-wrap">
            <label class="toggle">
              <input type="checkbox" name="is_active" {{ old('is_active', true) ? 'checked' : '' }}>
              <span class="toggle-slider"></span>
            </label>
            <span class="toggle-label">✅ Active (show on website)</span>
          </div>
          <div class="toggle-wrap">
            <label class="toggle">
              <input type="checkbox" name="is_featured" {{ old('is_featured') ? 'checked' : '' }}>
              <span class="toggle-slider"></span>
            </label>
            <span class="toggle-label">⭐ Featured Product</span>
          </div>
          <div class="toggle-wrap">
            <label class="toggle">
              <input type="checkbox" name="is_bestseller" {{ old('is_bestseller') ? 'checked' : '' }}>
              <span class="toggle-slider"></span>
            </label>
            <span class="toggle-label">🔥 Bestseller</span>
          </div>
          <div class="toggle-wrap">
            <label class="toggle">
              <input type="checkbox" name="is_new_arrival" {{ old('is_new_arrival') ? 'checked' : '' }}>
              <span class="toggle-slider"></span>
            </label>
            <span class="toggle-label">✨ New Arrival</span>
          </div>
        </div>
      </div>

      {{-- Actions --}}
      <div class="card">
        <div class="card-body" style="display:flex;flex-direction:column;gap:10px">
          <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;padding:13px;font-size:14px">
            ✅ Create Product
          </button>
          <a href="{{ route('admin.products.index') }}" class="btn btn-secondary" style="width:100%;justify-content:center">
            Cancel
          </a>
        </div>
      </div>

      {{-- Tips --}}
      <div class="card" style="background:#f0faf4;border-color:#bbf7d0">
        <div class="card-body">
          <div style="font-size:13px;font-weight:700;color:#15803d;margin-bottom:8px">💡 Image Tips</div>
          <ul style="font-size:12px;color:#166534;line-height:1.9;padding-left:16px">
            <li>Square images look best (400×400px)</li>
            <li>White background recommended</li>
            <li>Max file size: 5MB per image</li>
            <li>Formats: JPG, PNG, WebP</li>
            <li>First upload = product thumbnail</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</form>
@endsection

@push('scripts')
<script>
// ── THUMBNAIL PREVIEW ──────────────────────────
function previewThumb(input) {
  const file = input.files[0];
  if (!file) return;
  if (file.size > 5 * 1024 * 1024) { alert('File too large! Max 5MB allowed.'); input.value = ''; return; }
  const reader = new FileReader();
  reader.onload = e => {
    document.getElementById('thumbPreviewImg').src = e.target.result;
    document.getElementById('thumbPreviewBox').style.display = 'block';
    document.getElementById('thumbUploadArea').style.display = 'none';
  };
  reader.readAsDataURL(file);
}

function removeThumb() {
  document.getElementById('thumbInput').value = '';
  document.getElementById('thumbPreviewBox').style.display = 'none';
  document.getElementById('thumbUploadArea').style.display = 'flex';
}

function handleThumbDrop(e) {
  e.preventDefault();
  e.currentTarget.classList.remove('drag');
  const files = e.dataTransfer.files;
  if (files[0]) {
    document.getElementById('thumbInput').files = files;
    previewThumb(document.getElementById('thumbInput'));
  }
}

// ── GALLERY PREVIEW ─────────────────────────────
function previewGallery(files) {
  const gallery = document.getElementById('galleryPreview');
  gallery.innerHTML = '';
  if (!files || files.length === 0) return;
  Array.from(files).forEach((file, i) => {
    if (file.size > 5 * 1024 * 1024) return;
    const reader = new FileReader();
    reader.onload = e => {
      const div = document.createElement('div');
      div.className = 'gallery-item';
      div.innerHTML = `<img src="${e.target.result}" alt="Preview">
        <button type="button" class="gallery-del" onclick="this.parentElement.remove()">✕</button>`;
      gallery.appendChild(div);
    };
    reader.readAsDataURL(file);
  });
}

function handleGalleryDrop(e) {
  e.preventDefault();
  e.currentTarget.classList.remove('drag');
  previewGallery(e.dataTransfer.files);
}

// ── DISCOUNT CALCULATOR ──────────────────────────
function calcDiscount() {
  const orig = parseFloat(document.getElementById('origPrice').value) || 0;
  const sale = parseFloat(document.getElementById('salePrice').value) || 0;
  const hint = document.getElementById('discHint');
  if (orig > 0 && sale > 0 && sale < orig) {
    const pct = Math.round(((orig - sale) / orig) * 100);
    hint.textContent = `✅ Customer saves ${pct}% — ₹${(orig-sale).toFixed(0)} off!`;
    hint.style.color = '#16a34a';
  } else if (sale >= orig && sale > 0) {
    hint.textContent = '⚠️ Sale price must be less than original price';
    hint.style.color = '#dc2626';
  } else {
    hint.textContent = 'Enter sale price to show discount badge';
    hint.style.color = '';
  }
}

// ── SLUG PREVIEW ─────────────────────────────────
function generateSlug(name) {
  const slug = name.toLowerCase().replace(/[^a-z0-9\s-]/g,'').replace(/\s+/g,'-').replace(/-+/g,'-');
  // Just for display purposes
}

// ── FORM VALIDATION BEFORE SUBMIT ───────────────
document.getElementById('productForm').addEventListener('submit', function(e) {
  const name = document.querySelector('[name="name"]').value.trim();
  const cat  = document.querySelector('[name="category_id"]').value;
  const price= document.querySelector('[name="price"]').value;
  if (!name || !cat || !price) {
    e.preventDefault();
    alert('Please fill all required fields: Name, Category, Price');
    return;
  }
  const btn = this.querySelector('button[type="submit"]');
  btn.textContent = '⏳ Saving product...';
  btn.disabled = true;
});
</script>
@endpush