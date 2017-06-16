<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function categories(){
        $categories = Category::latest()->get();
//        dd($categories);
        return view('blog',[
            'categories' => $categories,
        ]);
    }

    public function catPosts($slug){
        // This is the only difference you need be aware of
        $category = Category::whereTranslation('slug', $slug)->firstOrFail();

        $posts = $category->posts()->get();

        //dd($category, $posts);
        return view('posts',[
            'category' => $category,
            'posts' => $posts,
        ]);
    }

    public function post(Post $post){
        $post = Post::firstOrFail();
        return view('post',[
            'post' => $post,
        ]);
    }
}
