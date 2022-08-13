<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = Post::all();
        $i = 0;
            Image::factory(40)->make()->each(function ($image) use($posts, &$i) {
                $image->post_id = $posts[$i]->id;
                $image->save();
                $i++;
            });
        
    }
}
