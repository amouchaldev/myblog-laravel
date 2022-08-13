<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nbOfComments = $this->command->ask('How Many Comments You want To insert ?');
        $posts = Post::all();
        Comment::factory($nbOfComments)->make()->each(function ($comment) use($posts) {
            $comment->post_id = $posts->random()->id;
            $comment->save();
        });
    }
}
