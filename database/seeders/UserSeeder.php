<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $var = [
            'admin' => [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123')
            ],
            'costumer' => [
                'name' => 'costumer',
                'email' => 'costumer@gmail.com',
                'password' => Hash::make('costumer123')
            ],
        ];

        foreach ($var as $key => $userRole) {
            $createUser = User::create($userRole);

            if ($key === 'admin') {
                $createUser->assignRole(Role::where('name', 'admin')->first());
            }
            if ($key === 'costumer') {
                $createUser->assignRole(Role::where('name', 'costumer')->first());
            }
        }
    }
}
