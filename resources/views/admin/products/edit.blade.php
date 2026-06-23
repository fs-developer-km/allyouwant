{{-- resources/views/admin/products/create.blade.php --}}
@extends('admin.layouts.admin')
@section('title', isset($product) ? 'Edit Product' : 'Add Product')
@section('breadcrumb', isset($product) ? 'Edit Product' : 'Add Product')

@push('styles')
<style>
.img-gallery{display:grid;grid-template-columns:repeat(4,1fr);gap:10px;margin-top:12px}
.gallery-item{position:relative;aspect-ratio:1;border-radius:8px;overflow:hidden;border:1px solid var(--border)}
.gallery-item img{width:100%;height:100%;object-fit:cover}
.gallery-del{position:absolute;top:5px;right:5px;background:rgba(220,38,38,.9);border:none;color:#fff;width:24px;height:24px;border-radius:6px;font-size:13px;cursor:pointer;display:flex;align-items:center;justify-content:center}
@media(max-width:768px){
  .prod-form-grid{grid-template-columns:1fr!important}
}
</style>
@endpush

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">{{ isset($product) ? '✏️ Edit Product' : '➕ Add New Product' }}</div>
    <div class="page-sub">{{ isset($product) ? 'Update product details, images and pricing' : 'Fill in all the details to add a new product' }}</div>
  </div>
  <div class="page-actions">
    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">← Back</a>
  </div>
</div>

<form action="{{ isset($product) ? route('admin.products.update', $product->id) : route('admin.products.store') }}"
      method="POST" enctype="multipart/form-data">
  @csrf
  @if(isset($product)) @method('PUT') @endif

  <div style="display:grid;grid-template-columns:1fr 320px;gap:20px;align-items:start" class="prod-form-grid">

    {{-- LEFT COLUMN --}}
    <div style="display:flex;flex-direction:column;gap:16px">

      {{-- Basic Info --}}
      <div class="card">
        <div class="card-header"><div class="card-title">📝 Basic Information</div></div>
        <div class="card-body">
          <div class="form-grid">
            <div class="form-group form-full">
              <label class="form-label">Product Name <span>*</span></label>
              <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $product->name ?? '') }}"
                placeholder="e.g. Fresh Broccoli 500g" required>
              @error('name')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
              <label class="form-label">Category <span>*</span></label>
              <select name="category_id" class="form-control" required>
                <option value="">Select Category</option>
                @foreach($categories as $cat)
                  <option value="{{ $cat->id }}"
                    {{ old('category_id', $product->category_id ?? '') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                  </option>
                @endforeach
              </select>
              @error('category_id')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
              <label class="form-label">SKU / Barcode</label>
              <input type="text" name="sku" class="form-control"
                value="{{ old('sku', $product->sku ?? '') }}"
                placeholder="e.g. VEG-BRO-001">
              <div class="form-hint">Leave blank to auto-generate</div>
            </div>

            <div class="form-group form-full">
              <label class="form-label">Short Description</label>
              <input type="text" name="short_description" class="form-control"
                value="{{ old('short_description', $product->short_description ?? '') }}"
                placeholder="One line summary shown in listing...">
            </div>

            <div class="form-group form-full">
              <label class="form-label">Full Description</label>
              <textarea name="description" class="form-control" rows="4"
                placeholder="Detailed product description...">{{ old('description', $product->description ?? '') }}</textarea>
            </div>
          </div>
        </div>
      </div>

      {{-- Pricing --}}
      <div class="card">
        <div class="card-header"><div class="card-title">💰 Pricing</div></div>
        <div class="card-body">
          <div class="form-grid">
            <div class="form-group">
              <label class="form-label">Original Price (₹) <span>*</span></label>
              <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                value="{{ old('price', $product->price ?? '') }}"
                placeholder="0.00" step="0.01" min="0" required>
              @error('price')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
              <label class="form-label">Sale Price (₹)</label>
              <input type="number" name="sale_price" class="form-control"
                value="{{ old('sale_price', $product->sale_price ?? '') }}"
                placeholder="0.00" step="0.01" min="0" id="salePriceInput">
              <div class="form-hint" id="discountHint">Enter sale price to show discount badge</div>
            </div>

            <div class="form-group">
              <label class="form-label">Tax (%)</label>
              <input type="number" name="tax_percent" class="form-control"
                value="{{ old('tax_percent', $product->tax_percent ?? 0) }}"
                placeholder="0" step="0.01" min="0" max="100">
            </div>

            <div class="form-group">
              <label class="form-label">Unit <span>*</span></label>
              <select name="unit" class="form-control" required>
                @foreach(['kg','gram','litre','ml','piece','packet','box','dozen','bundle'] as $u)
                  <option value="{{ $u }}" {{ old('unit', $product->unit ?? '') == $u ? 'selected' : '' }}>
                    {{ ucfirst($u) }}
                  </option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label class="form-label">Weight / Size</label>
              <input type="text" name="weight" class="form-control"
                value="{{ old('weight', $product->weight ?? '') }}"
                placeholder="e.g. 500g, 1kg, 250ml">
            </div>
          </div>
        </div>
      </div>

      {{-- Images --}}
      <div class="card">
        <div class="card-header">
          <div class="card-title">🖼️ Product Images</div>
          <div style="font-size:12px;color:var(--text-muted)">First image = thumbnail. Max 2MB each</div>
        </div>
        <div class="card-body">
          {{-- Thumbnail --}}
          <div style="margin-bottom:20px">
            <label class="form-label">Main Thumbnail <span>*</span></label>
            <div style="display:flex;align-items:center;gap:14px;margin-top:8px">
              <div id="thumbWrap"
                style="{{ isset($product) && $product->thumbnail ? '' : 'display:none' }}">
                <img id="thumbPreview"
                  src="{{ isset($product) && $product->thumbnail ? asset('storage/'.$product->thumbnail) : '' }}"
                  style="width:80px;height:80px;object-fit:cover;border-radius:8px;border:1px solid var(--border)">
              </div>
              <div>
                <button type="button" onclick="document.getElementById('thumbInput').click()"
                  class="btn btn-secondary">📷 Choose Thumbnail</button>
                <div class="form-hint" style="margin-top:6px">JPG/PNG/WebP — 400×400px recommended</div>
              </div>
            </div>
            <input type="file" id="thumbInput" name="thumbnail" accept="image/*"
              style="display:none" onchange="previewThumb(this)">
          </div>

          {{-- Gallery --}}
          <div>
            <label class="form-label">Gallery Images</label>
            <div class="upload-area" style="margin-top:8px" onclick="document.getElementById('galleryInput').click()">
              <div class="upload-icon">📁</div>
              <div class="upload-title">Click to add gallery images</div>
              <div class="upload-sub">Multiple images allowed</div>
            </div>
            <input type="file" id="galleryInput" name="images[]" accept="image/*"
              style="display:none" multiple onchange="previewGallery(this)">

            {{-- Existing images (edit mode) --}}
            @if(isset($product) && $product->images->count() > 0)
            <div class="img-gallery" id="existingGallery">
              @foreach($product->images as $img)
              <div class="gallery-item" id="gimg-{{ $img->id }}">
                <img src="{{ asset('storage/'.$img->image) }}" alt="Gallery">
                <button type="button" class="gallery-del"
                  onclick="deleteGalleryImage({{ $img->id }})">✕</button>
              </div>
              @endforeach
            </div>
            @endif

            {{-- New image previews --}}
            <div class="img-gallery" id="newGallery" style="margin-top:10px"></div>
          </div>
        </div>
      </div>
    </div>

    {{-- RIGHT COLUMN --}}
    <div style="display:flex;flex-direction:column;gap:16px">

      {{-- Stock --}}
      <div class="card">
        <div class="card-header"><div class="card-title">📦 Inventory</div></div>
        <div class="card-body">
          <div style="display:flex;flex-direction:column;gap:14px">
            <div class="form-group">
              <label class="form-label">Stock Quantity <span>*</span></label>
              <input type="number" name="stock_quantity" class="form-control"
                value="{{ old('stock_quantity', $product->stock_quantity ?? 0) }}"
                min="0" required>
            </div>
            <div class="form-group">
              <label class="form-label">Low Stock Alert</label>
              <input type="number" name="low_stock_alert" class="form-control"
                value="{{ old('low_stock_alert', $product->low_stock_alert ?? 10) }}"
                min="0">
              <div class="form-hint">Alert when stock falls below this number</div>
            </div>
            <div class="toggle-wrap">
              <label class="toggle">
                <input type="checkbox" name="track_inventory"
                  {{ old('track_inventory', $product->track_inventory ?? true) ? 'checked' : '' }}>
                <span class="toggle-slider"></span>
              </label>
              <span class="toggle-label">Track inventory</span>
            </div>
          </div>
        </div>
      </div>

      {{-- Status & Badges --}}
      <div class="card">
        <div class="card-header"><div class="card-title">🏷️ Status & Badges</div></div>
        <div class="card-body">
          <div style="display:flex;flex-direction:column;gap:14px">
            <div class="toggle-wrap">
              <label class="toggle">
                <input type="checkbox" name="is_active"
                  {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }}>
                <span class="toggle-slider"></span>
              </label>
              <span class="toggle-label">Active — show on website</span>
            </div>
            <div class="toggle-wrap">
              <label class="toggle">
                <input type="checkbox" name="is_featured"
                  {{ old('is_featured', $product->is_featured ?? false) ? 'checked' : '' }}>
                <span class="toggle-slider"></span>
              </label>
              <span class="toggle-label">⭐ Featured product</span>
            </div>
            <div class="toggle-wrap">
              <label class="toggle">
                <input type="checkbox" name="is_bestseller"
                  {{ old('is_bestseller', $product->is_bestseller ?? false) ? 'checked' : '' }}>
                <span class="toggle-slider"></span>
              </label>
              <span class="toggle-label">🔥 Bestseller</span>
            </div>
            <div class="toggle-wrap">
              <label class="toggle">
                <input type="checkbox" name="is_new_arrival"
                  {{ old('is_new_arrival', $product->is_new_arrival ?? false) ? 'checked' : '' }}>
                <span class="toggle-slider"></span>
              </label>
              <span class="toggle-label">✨ New Arrival</span>
            </div>
          </div>
        </div>
      </div>

      {{-- Save Actions --}}
      <div class="card">
        <div class="card-body" style="display:flex;flex-direction:column;gap:10px">
          <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;padding:12px">
            {{ isset($product) ? '💾 Update Product' : '✅ Create Product' }}
          </button>
          <a href="{{ route('admin.products.index') }}"
            class="btn btn-secondary" style="width:100%;justify-content:center">
            Cancel
          </a>
          {{-- @if(isset($product))
          <form action="{{ route('admin.products.destroy', $product->id) }}"
            method="POST" onsubmit="return confirmDelete(this)">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-danger" style="width:100%;justify-content:center">
              🗑️ Delete Product
            </button>
          </form>
          @endif --}}
        </div>
      </div>
    </div>
  </div>
</form>

    @if(isset($product))
          <form action="{{ route('admin.products.destroy', $product->id) }}"
            method="POST" onsubmit="return confirmDelete(this)">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-danger" style="width:100%;justify-content:center">
              🗑️ Delete Product
            </button>
          </form>
          @endif
@endsection

@push('scripts')
<script>
// Thumbnail preview
function previewThumb(input) {
  if (input.files[0]) {
    const r = new FileReader();
    r.onload = e => {
      document.getElementById('thumbPreview').src = e.target.result;
      document.getElementById('thumbWrap').style.display = 'block';
    };
    r.readAsDataURL(input.files[0]);
  }
}

// Gallery preview
function previewGallery(input) {
  const gallery = document.getElementById('newGallery');
  gallery.innerHTML = '';
  Array.from(input.files).forEach((file, i) => {
    const r = new FileReader();
    r.onload = e => {
      const div = document.createElement('div');
      div.className = 'gallery-item';
      div.innerHTML = `<img src="${e.target.result}" alt="Preview">
        <button type="button" class="gallery-del" onclick="this.parentElement.remove()">✕</button>`;
      gallery.appendChild(div);
    };
    r.readAsDataURL(file);
  });
}

// Delete existing gallery image (AJAX)
function deleteGalleryImage(id) {
  if (!confirm('Delete this image?')) return;
  fetch(`/admin/products/image/${id}`, {
    method: 'DELETE',
    headers: { 'X-CSRF-TOKEN': csrfToken },
  })
  .then(r => r.json())
  .then(d => {
    if (d.success) {
      document.getElementById('gimg-' + id).remove();
      showToast('Image deleted', 'success');
    }
  });
}

// Discount % hint
const origPrice = document.querySelector('[name="price"]');
const salePrice = document.getElementById('salePriceInput');
const hint = document.getElementById('discountHint');

function updateDiscountHint() {
  const orig = parseFloat(origPrice.value);
  const sale = parseFloat(salePrice.value);
  if (orig > 0 && sale > 0 && sale < orig) {
    const pct = Math.round(((orig - sale) / orig) * 100);
    hint.textContent = `✅ Customer saves ${pct}% (₹${(orig - sale).toFixed(0)})`;
    hint.style.color = '#16a34a';
  } else {
    hint.textContent = 'Enter sale price to show discount badge';
    hint.style.color = '';
  }
}

origPrice.addEventListener('input', updateDiscountHint);
salePrice.addEventListener('input', updateDiscountHint);
</script>
@endpush