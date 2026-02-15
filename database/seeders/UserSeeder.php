<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@test.dev',
            'password' => bcrypt('password'),
        ]);
        $admin->assignRole('admin');
        
        $user = User::factory()->count(30)->create();
        $user->each(function ($user) {
            $user->assignRole('user');
        });
    }
}
