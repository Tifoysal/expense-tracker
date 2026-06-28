<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Sanctum\HasApiTokens;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable  implements JWTSubject
{

    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getImageAttribute($value)
    {
        if (!$value) {
            return url('uploads/avatar.png');
        }
        return Storage::url('/uploads/users/' . $value);
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

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at'     => 'datetime',
        'created_at'            => 'datetime',
    ];

    public function scopeWhereLike($query, array $columns, string $search)
    {
        return $query->where(function ($query) use ($columns, $search) {
            foreach ($columns as $column) {
                $query->orWhere($column, 'like', "%{$search}%");
            }
        });
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id', 'id');
    }

    public function designationHistories()
    {
        return $this->hasMany(DesignationHistory::class, 'user_id', 'id')->orderBy('id', 'desc');
    }

    public function hasPermission($permission): bool
    {
        return $this->role->permissions()->where('slug', $permission)->first() ? true : false;
    }

    public function attendance()
    {
        return $this->belongsTo(Attendance::class, 'user_id', 'id');
    }
    public function leave()
    {
        return $this->belongsTo(Leave::class, 'user_id', 'id');
    }


    // Who this employee reports to
    public function executive()
    {
        return $this->belongsTo(User::class, 'executive_id');
    }

    // Direct subordinates
    public function subordinates()
    {
        return $this->hasMany(User::class, 'executive_id');
    }

    public function subordinatesRecursive()
    {
        return $this->subordinates()->with([
            'subordinatesRecursive',
            'designation'
        ]);
    }
    // সকল সাবোর্ডিনেটদের আইডি একসাথে পাওয়ার জন্য
    public function getAllSubordinateIds()
    {
        $ids = [];

        // প্রথমে সরাসরি নিচের মেম্বারদের লুপ চালান
        foreach ($this->subordinates as $subordinate) {
            $ids[] = $subordinate->id;

            // এরপর তাদের নিচের মেম্বারদের আইডি রিকার্সিভলি নিয়ে আসুন
            $ids = array_merge($ids, $subordinate->getAllSubordinateIds());
        }

        return $ids;
    }

    public function salaryStructure()
    {
        return $this->hasMany(SalaryStructure::class, 'user_id')
            ->orderBy('created_at', 'desc');
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'user_id', 'id');
    }


    // public function getImageAttribute($value)
    // {
    //     if(!$value){
    //         return url('/images/user.jpg');
    //     }
    //     return Storage::url('users/'.$value);

    // }


    // User.php

}
