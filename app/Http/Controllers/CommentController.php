<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
   public function store(Request $request,$id) {
    // return $request;
        $request->validate([
            'fullName' => 'required|min:7|max:64',
            'email' => 'required|email|max:64',
            'comment' => 'required|min:20|max:200'
        ]);
        $post = Post::findOrFail($id);
        $comment = new Comment([
            'fullName' => $request->input('fullName'),
            'email' => $request->input('email'),
            'content' => $request->input('comment')
        ]);
        $comment->post()->associate($post)->save();
        return back()->with('success', 'Thank You, Your Comment Send Successfully It will Reviewed Before Published');
   }


   public function fetchUnpublishedComments() {
        $comments = Comment::where('published', 0)->with('post')->get();
        return view('comments.review', ['comments' => $comments]);
   }
}
