<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Builder::macro('whereLike', function ($attributes, string $searchTerm) {
        //     $searchTerm = trim($searchTerm);
        //     $this->where(static function (Builder $query) use ($searchTerm, $attributes) {
        //         foreach (Arr::wrap($attributes) as $attribute) {
        //             $query->when(Str::contains($attribute, '.'), static function (Builder $query) use ($searchTerm, $attribute) {
        //                 [$relationName, $relationAttribute] = explode('.', $attribute);
        //                 $query->orWhereHas($relationName, static function (Builder $query) use ($relationAttribute, $searchTerm) {
        //                     $query->where($relationAttribute, 'LIKE', "{$searchTerm}%");
        //                 });
        //             }, static function (Builder $query) use ($attribute, $searchTerm) {
        //                 $query->orWhere($attribute, 'LIKE', "{$searchTerm}%");
        //             });
        //         }
        //     });

        //     return $this;
        // });

        if (!app()->runningInConsole()) {
            if (Schema::hasTable('settings')) {
                $settings = Setting::first();
                View::share('settings', $settings);
            }
        }
        // Blade::if('permission', function ($permission) {
        //     if(auth(auth()->getDefaultDriver())->user()->role_id==1)
        //     {
        //         return true;
        //     }
        //     return auth(auth()->getDefaultDriver())->user()->hasPermission($permission);
        // });

        Blade::if('permission', function ($permissions) {

            $user = auth(auth()->getDefaultDriver())->user();
        
            if (!$user) {
                return false;
            }
        
            // Super Admin
            if ($user->role_id == 1) {
                return true;
            }
        
            // Support multiple permissions using |
            $permissions = explode('|', $permissions);
        
            foreach ($permissions as $permission) {
                if ($user->hasPermission(trim($permission))) {
                    return true;
                }
            }
        
            return false;
        });

        
    }
}
