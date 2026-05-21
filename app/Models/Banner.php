<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = ['title','subtitle','image','button_text','button_link','badge_text','sort_order','is_active'];
    protected $casts    = ['is_active'=>'boolean'];
    public function scopeActive($q) { return $q->where('is_active',true)->orderBy('sort_order'); }
    public function getImageUrlAttribute() { return $this->image ? asset('storage/'.$this->image) : null; }
}
