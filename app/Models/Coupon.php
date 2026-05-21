<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Coupon extends Model {
    protected $fillable = ['code','description','type','value','min_order_amount','max_discount','usage_limit','used_count','per_user_limit','start_date','end_date','is_active'];
    protected $casts    = ['value'=>'decimal:2','min_order_amount'=>'decimal:2','is_active'=>'boolean','start_date'=>'date','end_date'=>'date'];
    public function scopeActive($q) { return $q->where('is_active',true); }
    public function calculateDiscount(float $amount): float {
        if ($amount < $this->min_order_amount) return 0;
        $discount = $this->type === 'percent' ? ($amount * $this->value / 100) : $this->value;
        if ($this->max_discount) $discount = min($discount, $this->max_discount);
        return round($discount,2);
    }
}
