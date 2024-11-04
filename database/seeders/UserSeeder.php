<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'phone' => '081234567890',
            'email_verified_at' => now(),
            'password' => bcrypt('admin123')
        ]);

        $admin->assignRole('superadmin');

        $kasir = User::create([
            'name' => 'kasir',
            'email' => 'kasir@gmail.com',
            'phone' => '081234567810',
            'email_verified_at' => now(),
            'password' => bcrypt('kasir123'),
            'gender' => 'perempuan',
            'address' => 'Jl. Pahlawan No. 1 Magelang',
        ]);

        $kasir->assignRole('cashier');
    }
}
