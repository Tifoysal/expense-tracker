<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'company_name'          =>  'Admin Panel',
            'address'               =>  'uttara,dhaka',
            'email'                 =>  'info@gmail.com',
            'phone_number'          =>  '01700000000',
            'web_address'           =>  'info.com',
            'facebook'              =>  'www.facwbook.com',
            'twitter'               =>  'www.twitter.com',
            'instagram'             =>  'www.instagram.com',
            'youtube'               =>  'www.youtube.com',
            'linkedin'               =>  'www.linkedin.com',
            'tag_line'              =>  'Help people to grow a better world.',
            'about_us'              =>  'Add Info',
            'terms_and_conditions'  =>  'Add Terms_&_conditions'
        ]);
    }
}
