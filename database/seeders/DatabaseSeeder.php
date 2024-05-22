<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(3)->create();

        User::create([
            'name' => 'myresepiadmin',
            'username' => 'resepi.admin',
            'email' => 'myresepiadmin@gmail.com',
            'password' => bcrypt('resep123'),
            'is_admin' => 1
        ]);

        Category::create([
            'name' => 'Appetizer',
            'slug' => 'appetizer',
        ]);

        Category::create([
            'name' => 'Main Course Food',
            'slug' => 'main-course-food',
        ]);

        Category::create([
            'name' => 'Dessert',
            'slug' => 'dessert',
        ]);

        Category::create([
            'name' => 'Beverage',
            'slug' => 'beverages',
        ]);
        
        Post::factory(10)->create();

    }
}
