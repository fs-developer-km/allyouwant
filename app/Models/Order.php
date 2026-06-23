<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
protected $fillable = ['order_number','user_id','address_id','delivery_name','delivery_phone','delivery_address','delivery_city','delivery_state','delivery_pincode','delivery_km','subtotal','delivery_charge','discount','tax','total','coupon_code','payment_method','payment_status','payment_id','status','notes','delivered_at'];
    protected $casts    = ['subtotal'=>'decimal:2','delivery_charge'=>'decimal:2','discount'=>'decimal:2','tax'=>'decimal:2','total'=>'decimal:2','delivered_at'=>'datetime'];

    public static $statusColors = ['pending'=>'warning','confirmed'=>'info','processing'=>'primary','shipped'=>'secondary','out_for_delivery'=>'info','delivered'=>'success','cancelled'=>'danger','refunded'=>'dark'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function($order){
            $order->order_number = 'GM-'.date('Y').'-'.str_pad((Order::max('id') ?? 0)+1,5,'0',STR_PAD_LEFT);
        });
    }

    public function getStatusBadgeColorAttribute() { return self::$statusColors[$this->status] ?? 'secondary'; }
    public function getStatusLabelAttribute()      { return ucwords(str_replace('_',' ',$this->status)); }

    public function user()          { return $this->belongsTo(User::class); }
    public function items()         { return $this->hasMany(OrderItem::class); }
    public function address()
{
    return $this->belongsTo(Address::class);
}
    public function statusHistory() { return $this->hasMany(OrderStatusHistory::class)->orderByDesc('created_at'); }
}
