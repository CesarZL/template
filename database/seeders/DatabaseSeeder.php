<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            DashboardTableSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => '2030191@upv.edu.mx',
            'password' => Hash::make('password'),
        ]);
    }
}
