<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Address extends Model {
    protected $fillable = ['user_id','label','full_name','phone','address_line1','address_line2','city','state','pincode','landmark','is_default'];
    protected $casts    = ['is_default'=>'boolean'];
    public function user() { return $this->belongsTo(User::class); }
    public function getFullAddressAttribute() { return collect([$this->address_line1,$this->address_line2,$this->city,$this->state,$this->pincode])->filter()->implode(', '); }
}
