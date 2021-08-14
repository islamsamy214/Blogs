<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    
    public function run()
    {
        User::create([
            'name'=>'super admin',
            'email'=>'super_admin@app.com',
            'password'=>bcrypt('12345678'),
        ]);
        User::factory(50)->create();
    }
}
