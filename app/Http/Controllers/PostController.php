<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravel\Ui\Presets\React;

class PostController extends Controller
{
    // return add post view
    public function create() {
        return view('posts.create');
    }
    // store post
    public function add(Request $request) {
        $user = User::where('email', session()->get('loginEmail'))->first();
        if ($user) {
            $request->validate([
                'title' => 'required|min:5',
                'body' => 'required|min:5',
                'image' => 'required|image|mimes:png,jpg,jpeg,gif|max:10000'
            ]);
            // Create New Post Object
            $post = new Post();
            $post->title = $request->input('title');
            $post->body = $request->input('body');
            // Associate Post With User
            $post->user()->associate($user)->save();
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('posts');
                $image = new Image();
                $image->path = $path;
                $post->images()->save($image);
            }
            return back()->with('success', 'Post Added Successfully');
        }
    
    }

    public function fetchPosts(){
        $postsForSlider = Post::orderBy('created_at', 'desc')->with('images')->take(3)->get();
        $posts = Post::withCount('comments')->with('images')->get();
        $mostPostCommented = Post::withCount('comments')->orderBy('comments_count', 'desc')->take(7)->get();
        return view ('posts.index', ['posts' => $posts, 'mostPostCommented' => $mostPostCommented, 'postsForSlider' => $postsForSlider]);
    }

    public function fetchPost($id) {
        $post = Post::with(['comments' => function ($query) { $query->where('published', 1); }])->with('images')->find($id);
        return view('posts.post', ['post' => $post]);
    } 
    
    public function edit($id) {
        return view('posts.edit', ['post' => Post::findOrFail($id)]);
    }

    public function update(Request $request, $id) {
       	$post = Post::findOrFail($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->update();
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('posts');
            if (count($post->images) > 0) {
                Storage::delete($post->images[0]->path);
                $post->images[0]->path = $path;
                $post->images[0]->save();
                return back()->with('success', 'Post Updated Successfully');
            }
            else {
                $img = new Image(['path' => $path]);
                $post->images()->save($img);
                return back()->with('success', 'Post Updated Successfully');
            }
        }
        return back()->with('success', 'Post Updated Successfully');
    }

    public function destroy($id) {
        $post = Post::findOrFail($id);
        $post->delete();
        return back()->with('success', "Post Deleted Successfully");
    } 
}
