<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SettingsTableSeeder::class);
        
        $this->call(RoleTableSeeder::class);
        $this->call(BankingAccountSeeder::class);
       


        $role = Role::where('name', '=', 'Super Admin')->first();
        $role->permissions()->sync(Permission::get()->pluck('id'));

        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt(12345),
            'email_verified_at' => Carbon::now(),
            'phone' => '01800000000',
            'role_id' => Role::where('name', '=', 'Super Admin')->first()->id,

        ]);
    }
}
