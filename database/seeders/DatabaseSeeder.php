<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\category;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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


        if (!User::where('email','admin@gmail.com')->exists()){
            User::create([
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'phone_number' => '0123456789',
                'password' => Hash::make('123456789'),
                'country' => 'EG',
                'address' => '123 Main St.',
                'age' => 22,
                'gender' => 0, // 0 for male, 1 for female
                'role_as' => 1, // 0 for admin, 1 for coach, 2 for user
                'profile_image' => 'assets/images/1.jpg', // default profile image name
            ]);
        }

        if (!category::where('id',config('mainCategories.Equipments.id'))->exists()){

        \App\Models\category::factory()->create([
            'id'=>config('mainCategories.Equipments.id'),
            'name_en'=>config('mainCategories.Equipments.name'),
            'name_ar'=>'معدات رياضيه',
            'name_ku'=>'Equipment',
            'description_en'=>'Equipment',
            'description_ar'=>'معدات رياضيه',
            'description_ku'=>'Equipment',
            'cover_image'=>'assets/images/categories/trainigVideos/coverImages/1.jpg',
        ]);
        }
        if (!category::where('id',config('mainCategories.Accessories.id'))->exists()){
            \App\Models\category::factory()->create([
                'id'=>config('mainCategories.Accessories.id'),
                'name_en'=>config('mainCategories.Accessories.name'),
                'name_ar'=>'Accessories ',
                'name_ku'=>'Supplements',
                'description_en'=>'Accessories',
                'description_ar'=>' Accessories',
                'description_ku'=>'Accessories',
                'cover_image'=>'assets/images/categories/trainigVideos/coverImages/1.jpg',
            ]);
        }

        if (!category::where('id',config('mainCategories.SportWear.id'))->exists()){
            \App\Models\category::factory()->create([
                'id'=>config('mainCategories.SportWear.id'),
                'name_en'=>config('mainCategories.SportWear.name'),
                'name_ar'=>'Sport Wear',
                'name_ku'=>'Sport Wear',
                'description_en'=>'Sport Wear',
                'description_ar'=>'Sport Wear',
                'description_ku'=>'Sport Wear',
                'cover_image'=>'assets/images/categories/trainigVideos/coverImages/1.jpg',
            ]);
        }

        if (!category::where('id',config('mainCategories.DietFood.id'))->exists()){
            \App\Models\category::factory()->create([
                'id'=>config('mainCategories.DietFood.id'),
                'name_en'=>config('mainCategories.DietFood.name'),
                'name_ar'=>'Diet Food ',
                'name_ku'=>'Diet Food',
                'description_en'=>'Diet Food',
                'description_ar'=>' Diet Food',
                'description_ku'=>'Diet Food',
                'cover_image'=>'assets/images/categories/trainigVideos/coverImages/1.jpg',
            ]);
        }


        if (!category::where('id',config('mainCategories.Coaches.id'))->exists()){
            \App\Models\category::factory()->create([
                'id'=>config('mainCategories.Coaches.id'),
                'name_en'=>config('mainCategories.Coaches.name'),
                'name_ar'=>'Coaches',
                'name_ku'=>'Coaches',
                'description_en'=>'Coaches',
                'description_ar'=>' Coaches',
                'description_ku'=>'Coaches',
                'cover_image'=>'assets/images/categories/trainigVideos/coverImages/1.jpg',
            ]);
        }


        if (!category::where('id',config('mainCategories.Supplements.id'))->exists()){
            \App\Models\category::factory()->create([
                'id'=>config('mainCategories.Supplements.id'),
                'name_en'=>config('mainCategories.Supplements.name'),
                'name_ar'=>'Supplements',
                'name_ku'=>'Supplements',
                'description_en'=>'Supplements',
                'description_ar'=>' Supplements',
                'description_ku'=>'Supplements',
                'cover_image'=>'assets/images/categories/trainigVideos/coverImages/1.jpg',
            ]);
        }

        if (!category::where('id',config('mainCategories.GymDiscount.id'))->exists()){
            \App\Models\category::factory()->create([
                'id'=>config('mainCategories.GymDiscount.id'),
                'name_en'=>config('mainCategories.GymDiscount.name'),
                'name_ar'=>'Gym Discount',
                'name_ku'=>'Gym Discount',
                'description_en'=>'Gym Discount',
                'description_ar'=>' Gym Discount',
                'description_ku'=>'Gym Discount',
                'cover_image'=>'assets/images/categories/trainigVideos/coverImages/1.jpg',
            ]);
        }
        if (!category::where('id',config('mainCategories.MusclesVideos.id'))->exists()){
            \App\Models\category::factory()->create([
                'id'=>config('mainCategories.MusclesVideos.id'),
                'name_en'=>config('mainCategories.MusclesVideos.name'),
                'name_ar'=>'Muscles Videos',
                'name_ku'=>'Muscles Videos',
                'description_en'=>'Muscles Videos',
                'description_ar'=>'Muscles Videos',
                'description_ku'=>'Muscles Videos',
                'cover_image'=>'assets/images/categories/trainigVideos/coverImages/1.jpg',
            ]);
        }


        SiteSetting::create([
            'show_logo'=>1
        ]);








    }
}
