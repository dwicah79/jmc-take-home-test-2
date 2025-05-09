<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $operatorRole = Role::firstOrCreate(['name' => 'operator']);

        $admin = User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'is_locked' => false,
        ]);
        $admin->assignRole($adminRole);
        $operator = User::create([
            'name' => 'Operator User',
            'username' => 'operator',
            'email' => 'operator@gmail.com',
            'password' => Hash::make('password'),
            'is_locked' => false,
        ]);
        $operator->assignRole($operatorRole);
        $operator = User::create([
            'name' => 'Contoh Locked User',
            'username' => 'locked',
            'email' => 'locked@gmail.com',
            'password' => Hash::make('password'),
            'is_locked' => true,
        ]);
        $operator->assignRole($operatorRole);
    }
}
