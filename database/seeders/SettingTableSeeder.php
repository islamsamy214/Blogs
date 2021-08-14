<?php
namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    public function run()
    {
        Setting::create([
            'site_name'=> 'blogs', 
            'contact_email'=>'eslamsamy019@gmail.com', 
            'address'=>'Egypt, Alexandria'
        ]);
    }
}
