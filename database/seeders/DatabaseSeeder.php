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
//        \App\Models\User::factory(10)->create();
//        \App\Models\coach::factory(10)->create();
//         \App\Models\course::factory(10)->create();
//         \App\Models\brand::factory(10)->create();
//         \App\Models\supplement::factory(10)->create();
////         \App\Models\video::factory(10)->create();
//         \App\Models\category::factory(10)->create();
//         \App\Models\subscription::factory(10)->create();
//         \App\Models\purchase::factory(100)->create();

        \App\Models\category::factory()->create([
            'name_en'=>'Equipment',
            'name_ar'=>'معدات رياضيه',
            'name_ku'=>'Equipment',
            'description_en'=>'Equipment',
            'description_ar'=>'معدات رياضيه',
            'description_ku'=>'Equipment',
            'cover_image'=>'assets/images/categories/trainigVideos/coverImages/1.jpg',
        ]);
        \App\Models\category::factory()->create([
            'name_en'=>'Accessories',
            'name_ar'=>'Accessories ',
            'name_ku'=>'Supplements',
            'description_en'=>'Accessories',
            'description_ar'=>' Accessories',
            'description_ku'=>'Accessories',
            'cover_image'=>'assets/images/categories/trainigVideos/coverImages/1.jpg',
        ]);

        \App\Models\category::factory()->create([
            'name_en'=>'Sport Wear',
            'name_ar'=>'Sport Wear',
            'name_ku'=>'Sport Wear',
            'description_en'=>'Sport Wear',
            'description_ar'=>'Sport Wear',
            'description_ku'=>'Sport Wear',
            'cover_image'=>'assets/images/categories/trainigVideos/coverImages/1.jpg',
        ]);
        \App\Models\category::factory()->create([
            'name_en'=>'Diet Food',
            'name_ar'=>'Diet Food ',
            'name_ku'=>'Diet Food',
            'description_en'=>'Diet Food',
            'description_ar'=>' Diet Food',
            'description_ku'=>'Diet Food',
            'cover_image'=>'assets/images/categories/trainigVideos/coverImages/1.jpg',
        ]);




    }
}
