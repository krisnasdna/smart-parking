<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com', // Ganti dengan email admin yang diinginkan
            'password' => Hash::make('admin123'), // Ganti dengan password admin yang diinginkan
            'is_admin' => true, // Menandakan bahwa ini adalah admin
        ]);
        
        $this->call(AdminSeeder::class);
    }
}
