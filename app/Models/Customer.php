<?php

namespace App\Models;

use Devfaysal\BangladeshGeocode\Models\Division;
use Devfaysal\BangladeshGeocode\Models\Union;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

use Illuminate\Support\Facades\Storage;


class Customer extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public const RETAILER   = 'retailer';
    public const DEALER     = 'dealer';
    public const CUSTOMER   = 'customer';//equivalent to enduser
    public const CORPORATE  = 'corporate';
    public const STATUS     = 'pending';
    public const PENDING     = 'pending';
    public const ACTIVE     = 'active';
    public const INACTIVE     = 'inactive';
    public const REJECTED     = 'rejected';
    public const INSTITUTION     = 'institution';

    public function getImageAttribute($value)
    {
        if(!$value){
            return url('uploads/avatar.png');
        }
        return Storage::url('/uploads/customer/'.$value);
    }

    public function getFullNameAttribute($value)
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function getShopImageAttribute($value)
    {
        if(!$value){
            return url('uploads/dummy.png');
        }
        return Storage::url('/uploads/shop/'.$value);

    }
    public function getNidAttribute($value)
    {
    if(!$value){
            return url('uploads/dummy.png');
        }
        return Storage::url('/uploads/nid/'.$value);
    }
    public function getTradeLicenseFileAttribute($value)
    {
        if(!$value){
            return url('uploads/dummy.png');
        }
        return Storage::url('/uploads/trade-license-file/'.$value);
    }
        
    public function getNameAttribute($value)
    {
        return $this->first_name.' '.$this->last_name;
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function tso()
    {
        return $this->belongsTo(User::class, 'tso_id', 'id');
    }

    public function executive()
    {
        return $this->belongsTo(User::class, 'executive_id', 'id');
    }

    public function hasPermission($permission): bool
    {
        return $this->role->permissions()->where('slug', $permission)->first() ? true : false;
    }

    public function onlinePayment()
    {
        return $this->hasMany(OnlinePayment::class, 'retailer_id', 'id');
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }
    public function union()
    {
        return $this->belongsTo(Union::class);
    }
}
