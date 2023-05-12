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
            'name_en'=>'Training Video',
            'name_ar'=>'فيديوهات تدريبية',
            'name_ku'=>'Vîdyoya Perwerdehiyê',
            'description_en'=>'Training Video',
            'description_ar'=>'فيديوهات تدريبية',
            'description_ku'=>'Vîdyoya Perwerdehiyê',
            'cover_image'=>'assets/images/categories/trainigVideos/coverImages/1.jpg',
        ]);
        \App\Models\category::factory()->create([
            'name_en'=>'Supplements',
            'name_ar'=>'معداات الجيم',
            'name_ku'=>'Supplements',
            'description_en'=>'Supplements',
            'description_ar'=>'معداات الجيم',
            'description_ku'=>'Supplements',
            'cover_image'=>'assets/images/categories/trainigVideos/coverImages/1.jpg',
        ]);

        \App\Models\category::factory()->create([
            'name_en'=>'Coaches',
            'name_ar'=>'المدربين',
            'name_ku'=>'Coaches',
            'description_en'=>'Coaches',
            'description_ar'=>'المدربين',
            'description_ku'=>'Coaches',
            'cover_image'=>'assets/images/categories/trainigVideos/coverImages/1.jpg',
        ]);

        \App\Models\category::factory()->create([
            'name_en'=>'Training Video',
            'name_ar'=>'فيديوهات تدريبية',
            'name_ku'=>'Vîdyoya Perwerdehiyê',
            'description_en'=>'Training Video',
            'description_ar'=>'فيديوهات تدريبية',
            'description_ku'=>'Vîdyoya Perwerdehiyê',
            'cover_image'=>'assets/images/categories/trainigVideos/coverImages/1.jpg',
        ]);

        \App\Models\category::factory()->create([
            'name_en'=>'Training Video',
            'name_ar'=>'فيديوهات تدريبية',
            'name_ku'=>'Vîdyoya Perwerdehiyê',
            'description_en'=>'Training Video',
            'description_ar'=>'فيديوهات تدريبية',
            'description_ku'=>'Vîdyoya Perwerdehiyê',
            'cover_image'=>'assets/images/categories/trainigVideos/coverImages/1.jpg',
        ]);

        \App\Models\category::factory()->create([
            'name_en'=>'Training Video',
            'name_ar'=>'فيديوهات تدريبية',
            'name_ku'=>'Vîdyoya Perwerdehiyê',
            'description_en'=>'Training Video',
            'description_ar'=>'فيديوهات تدريبية',
            'description_ku'=>'Vîdyoya Perwerdehiyê',
            'cover_image'=>'assets/images/categories/trainigVideos/coverImages/1.jpg',
        ]);
    }
}
