<?php
declare(strict_types=1);

namespace App\Models;

use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;
    use Sluggable;

    protected $guarded = [];

    const EMPLOYEE='employee';

    public function sluggable(): array
    {
        return [
            'source' => 'name',
        ];
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class,'role_permissions','role_id','permission_id');
    }

    
}
