
<?php $__env->startSection('title', 'Add Product'); ?>
<?php $__env->startSection('breadcrumb', 'Add Product'); ?>

<?php $__env->startPush('styles'); ?>
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
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
  <div>
    <div class="page-title">➕ Add New Product</div>
    <div class="page-sub">Fill in all details to add product to your store</div>
  </div>
  <div class="page-actions">
    <a href="<?php echo e(route('admin.products.index')); ?>" class="btn btn-secondary">← Back to Products</a>
  </div>
</div>

<?php if($errors->any()): ?>
<div class="alert alert-error">
  ❌ Please fix the following errors:
  <ul style="margin-top:6px;padding-left:20px">
    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li style="font-size:13px"><?php echo e($err); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </ul>
</div>
<?php endif; ?>


<form action="<?php echo e(route('admin.products.store')); ?>"
      method="POST"
      enctype="multipart/form-data"
      id="productForm">
  <?php echo csrf_field(); ?>

  <div style="display:grid;grid-template-columns:1fr 300px;gap:20px;align-items:start" class="prod-layout">

    
    <div style="display:flex;flex-direction:column;gap:16px">

      
      <div class="card">
        <div class="card-header"><div class="card-title">📝 Basic Information</div></div>
        <div class="card-body">
          <div class="form-grid">
            <div class="form-group form-full">
              <label class="form-label">Product Name <span>*</span></label>
              <input type="text" name="name" class="form-control"
                value="<?php echo e(old('name')); ?>" placeholder="e.g. Fresh Broccoli" required
                oninput="generateSlug(this.value)">
              <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="form-error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="form-group">
              <label class="form-label">Category <span>*</span></label>
              <select name="category_id" class="form-control" required>
                <option value="">-- Select Category --</option>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($cat->id); ?>" <?php echo e(old('category_id')==$cat->id ? 'selected':''); ?>><?php echo e($cat->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
              <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="form-error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="form-group">
              <label class="form-label">SKU / Barcode</label>
              <input type="text" name="sku" class="form-control" value="<?php echo e(old('sku')); ?>" placeholder="e.g. VEG-001">
              <div class="form-hint">Leave blank to auto-generate</div>
            </div>
            <div class="form-group form-full">
              <label class="form-label">Short Description</label>
              <input type="text" name="short_description" class="form-control"
                value="<?php echo e(old('short_description')); ?>" placeholder="One line summary...">
            </div>
            <div class="form-group form-full">
              <label class="form-label">Full Description</label>
              <textarea name="description" class="form-control" rows="4"
                placeholder="Detailed product description..."><?php echo e(old('description')); ?></textarea>
            </div>
          </div>
        </div>
      </div>

      
      <div class="card">
        <div class="card-header"><div class="card-title">💰 Pricing & Unit</div></div>
        <div class="card-body">
          <div class="form-grid">
            <div class="form-group">
              <label class="form-label">Original Price (₹) <span>*</span></label>
              <input type="number" name="price" class="form-control"
                value="<?php echo e(old('price')); ?>" placeholder="0" step="0.01" min="0" required
                id="origPrice" oninput="calcDiscount()">
              <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="form-error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="form-group">
              <label class="form-label">Sale Price (₹) <span style="color:#9ca3af;font-size:11px">(optional)</span></label>
              <input type="number" name="sale_price" class="form-control"
                value="<?php echo e(old('sale_price')); ?>" placeholder="0" step="0.01" min="0"
                id="salePrice" oninput="calcDiscount()">
              <div class="form-hint" id="discHint">Enter sale price to show discount badge</div>
            </div>
            <div class="form-group">
              <label class="form-label">Unit <span>*</span></label>
              <select name="unit" class="form-control" required>
                <?php $__currentLoopData = ['kg','gram','litre','ml','piece','packet','box','dozen','bundle']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($u); ?>" <?php echo e(old('unit')==$u ? 'selected':''); ?>><?php echo e(ucfirst($u)); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
            </div>
            <div class="form-group">
              <label class="form-label">Weight / Size</label>
              <input type="text" name="weight" class="form-control"
                value="<?php echo e(old('weight')); ?>" placeholder="e.g. 500g, 1kg, 250ml">
            </div>
          </div>
        </div>
      </div>

      
      <div class="card">
        <div class="card-header">
          <div class="card-title">🖼️ Product Images</div>
          <span style="font-size:12px;color:var(--text-muted)">JPG/PNG/WebP — Max 5MB each</span>
        </div>
        <div class="card-body">

          
          <div style="margin-bottom:24px">
            <label class="form-label" style="margin-bottom:10px;display:block">
              📸 Main Product Image (Thumbnail) <span>*</span>
            </label>
            <div style="display:flex;align-items:center;gap:16px;flex-wrap:wrap">
              
              <div id="thumbPreviewBox" style="display:none" class="thumb-preview-box">
                <img id="thumbPreviewImg" src="" alt="Thumbnail Preview">
                <button type="button" class="thumb-remove" onclick="removeThumb()">✕</button>
              </div>
              
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
            <?php $__errorArgs = ['thumbnail'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="form-error" style="margin-top:6px"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>

          
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

    
    <div style="display:flex;flex-direction:column;gap:16px">

      
      <div class="card">
        <div class="card-header"><div class="card-title">📦 Inventory</div></div>
        <div class="card-body" style="display:flex;flex-direction:column;gap:14px">
          <div class="form-group">
            <label class="form-label">Stock Quantity <span>*</span></label>
            <input type="number" name="stock_quantity" class="form-control"
              value="<?php echo e(old('stock_quantity', 0)); ?>" min="0" required>
          </div>
          <div class="form-group">
            <label class="form-label">Low Stock Alert</label>
            <input type="number" name="low_stock_alert" class="form-control"
              value="<?php echo e(old('low_stock_alert', 10)); ?>" min="0">
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

      
      <div class="card">
        <div class="card-header"><div class="card-title">🏷️ Status & Badges</div></div>
        <div class="card-body" style="display:flex;flex-direction:column;gap:14px">
          <div class="toggle-wrap">
            <label class="toggle">
              <input type="checkbox" name="is_active" <?php echo e(old('is_active', true) ? 'checked' : ''); ?>>
              <span class="toggle-slider"></span>
            </label>
            <span class="toggle-label">✅ Active (show on website)</span>
          </div>
          <div class="toggle-wrap">
            <label class="toggle">
              <input type="checkbox" name="is_featured" <?php echo e(old('is_featured') ? 'checked' : ''); ?>>
              <span class="toggle-slider"></span>
            </label>
            <span class="toggle-label">⭐ Featured Product</span>
          </div>
          <div class="toggle-wrap">
            <label class="toggle">
              <input type="checkbox" name="is_bestseller" <?php echo e(old('is_bestseller') ? 'checked' : ''); ?>>
              <span class="toggle-slider"></span>
            </label>
            <span class="toggle-label">🔥 Bestseller</span>
          </div>
          <div class="toggle-wrap">
            <label class="toggle">
              <input type="checkbox" name="is_new_arrival" <?php echo e(old('is_new_arrival') ? 'checked' : ''); ?>>
              <span class="toggle-slider"></span>
            </label>
            <span class="toggle-label">✨ New Arrival</span>
          </div>
        </div>
      </div>

      
      <div class="card">
        <div class="card-body" style="display:flex;flex-direction:column;gap:10px">
          <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;padding:13px;font-size:14px">
            ✅ Create Product
          </button>
          <a href="<?php echo e(route('admin.products.index')); ?>" class="btn btn-secondary" style="width:100%;justify-content:center">
            Cancel
          </a>
        </div>
      </div>

      
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
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
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
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\grocery-mart-final\resources\views\admin\products\create.blade.php ENDPATH**/ ?>