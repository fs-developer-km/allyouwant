<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $fillable = ['category_id','name','slug','description','short_description','sku','price','sale_price','stock_quantity','unit','weight','thumbnail','is_active','is_featured','is_bestseller','is_new_arrival','track_inventory','low_stock_alert','tax_percent','views'];
    protected $casts    = ['price'=>'decimal:2','sale_price'=>'decimal:2','is_active'=>'boolean','is_featured'=>'boolean','is_bestseller'=>'boolean','is_new_arrival'=>'boolean','track_inventory'=>'boolean'];

    public function scopeActive($q)      { return $q->where('is_active',true); }
    public function scopeFeatured($q)    { return $q->where('is_featured',true); }
    public function scopeBestseller($q)  { return $q->where('is_bestseller',true); }
    public function scopeNewArrival($q)  { return $q->where('is_new_arrival',true); }
    public function scopeInStock($q)     { return $q->where('stock_quantity','>',0); }

    public function getCurrentPriceAttribute()    { return $this->sale_price ?? $this->price; }
    public function getIsOnSaleAttribute()         { return !is_null($this->sale_price) && $this->sale_price < $this->price; }
    public function getIsInStockAttribute()        { return $this->stock_quantity > 0; }
    public function getThumbnailUrlAttribute()     { return $this->thumbnail ? asset('storage/'.$this->thumbnail) : null; }
    public function getDiscountPercentAttribute()  {
        if ($this->sale_price && $this->price > 0) return round((($this->price - $this->sale_price) / $this->price) * 100);
        return 0;
    }

    public function category()        { return $this->belongsTo(Category::class); }
    public function images()          { return $this->hasMany(ProductImage::class)->orderBy('sort_order'); }
    public function reviews()         { return $this->hasMany(Review::class); }
    public function approvedReviews() { return $this->hasMany(Review::class)->where('is_approved',true); }
    public function orderItems()      { return $this->hasMany(OrderItem::class); }
}
