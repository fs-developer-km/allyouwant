<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $fillable = ['name','slug','image','description','parent_id','sort_order','is_active','show_on_homepage'];
    protected $casts    = ['is_active'=>'boolean','show_on_homepage'=>'boolean'];

    public function scopeActive($q)    { return $q->where('is_active',true); }
    public function scopeHomepage($q)  { return $q->where('show_on_homepage',true); }
    public function scopeOrdered($q)   { return $q->orderBy('sort_order'); }
    public function getImageUrlAttribute() { return $this->image ? asset('storage/'.$this->image) : null; }

    public function products()       { return $this->hasMany(Product::class); }
    public function activeProducts() { return $this->hasMany(Product::class)->where('is_active',true); }
    public function parent()         { return $this->belongsTo(Category::class,'parent_id'); }
    public function children()       { return $this->hasMany(Category::class,'parent_id'); }
}
