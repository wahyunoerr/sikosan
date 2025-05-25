<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserWithRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::where('name', 'customer')->first();

        for ($i = 1; $i <= 10; $i++) {
            $user = User::create([
                'name' => 'Tester' . $i,
                'email' => 'tester' . $i . '@example.com',
                'password' => Hash::make('password'),
            ]);

            $user->roles()->attach($role);
        }
    }
}
