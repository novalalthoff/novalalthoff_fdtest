<?php

namespace Database\Seeders;

use App\Models\BookModel;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $fields = [
            [
                'name' => 'Noval Althoff',
                'email' => 'novalalthoff@gmail.com',
                'password' => Hash::make("password")
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make("password"),
                'email_verified_at' => now()
            ],
            [
                'name' => 'Alan Kay',
                'email' => 'alankay@gmail.com',
                'password' => Hash::make("password")
            ]
        ];

        foreach ($fields as $field) {
            User::create($field);
        }

        User::factory(20)->create();
        BookModel::factory(280)->create();
    }
}
