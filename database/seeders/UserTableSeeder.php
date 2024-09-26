<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $role= Role::create([
            'name'=> 'admin',
        ]);
        User::create([

            'email'=> 'admin@gmail.com',
            'password'=> Hash::make(12345678),
            'role_id'=> $role->id,
        ]);
    }
}
