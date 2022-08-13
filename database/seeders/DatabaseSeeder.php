<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Image;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        if ($this->command->confirm('Do You Want To Refresh Before Inserting ?')) {
            $this->command->call('migrate:fresh');
            $this->command->info('Database Refresh Successfully !');
        }
        $this->call([UserSeeder::class, PostSeeder::class, ImageSeeder::class, CommentSeeder::class]);
    }
}
