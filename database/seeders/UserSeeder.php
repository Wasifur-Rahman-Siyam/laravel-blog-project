<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $admin = User::create([
            'name'  =>   'Admin',
            'email'  =>   'admin@email.com',
            'username'  =>   'admin001',
            'password'  =>   bcrypt('admin001'),
        ]);
        $admin->assignRole('admin');

        $user = User::create([
            'name'  =>   'user',
            'email'  =>   'user@email.com',
            'username'  =>   'user001',
            'password'  =>   bcrypt('user001'),
        ]);
        $user->assignRole('user');
    }
}


