<?php
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $fillable = [
        'name','email','phone','avatar','password','role','is_active',
    ];
    protected $hidden = ['password','remember_token'];
    protected $casts  = ['email_verified_at'=>'datetime','is_active'=>'boolean'];

    public function scopeCustomers($q) { return $q->where('role','customer'); }
    public function scopeAdmins($q)    { return $q->where('role','admin'); }
    public function scopeActive($q)    { return $q->where('is_active',true); }
    public function isAdmin(): bool    { return $this->role === 'admin'; }
    public function isCustomer(): bool { return $this->role === 'customer'; }

    public function orders()         { return $this->hasMany(Order::class); }
    public function addresses()      { return $this->hasMany(Address::class); }
    public function defaultAddress() { return $this->hasOne(Address::class)->where('is_default',true); }
    public function cart()           { return $this->hasMany(Cart::class); }
    public function reviews()        { return $this->hasMany(Review::class); }
    public function wishlist()       { return $this->hasMany(Wishlist::class); }
}
