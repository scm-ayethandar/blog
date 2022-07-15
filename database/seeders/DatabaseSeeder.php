<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'name' => 'Mg Mg',
            'email' => 'mgmg@gmail.com',
            // 'password' => Hash::make('123123'),
            'password' => bcrypt('123123'),
            'image_path' => 'images\avatar.png',
        ]);

    $this->call(\Database\Seeders\UserSeeder::class);
    $this->call(\Database\Seeders\PostSeeder::class);
    Category::factory(5)->create();


        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
