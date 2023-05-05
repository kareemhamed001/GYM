<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         \App\Models\User::factory(10)->create();
         \App\Models\coach::factory(10)->create();
//         \App\Models\course::factory(10)->create();
//         \App\Models\brand::factory(10)->create();
//         \App\Models\supplement::factory(10)->create();
////         \App\Models\video::factory(10)->create();
//         \App\Models\category::factory(10)->create();
//         \App\Models\subscription::factory(10)->create();
//         \App\Models\purchase::factory(100)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
