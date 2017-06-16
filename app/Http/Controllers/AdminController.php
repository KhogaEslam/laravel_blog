<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.3/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

/**
 * Class AdminController
 * @package App\Http\Controllers
 */
class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        return view('adminlte::home');
    }

    public function listUsers()
    {
        $users = User::all()->where("id", "!=", 1);
        return view('admin.users',
            [
                'users' => $users
            ]);
    }

    public function deleteUser(User $user){
        $user->delete();
        return back();
    }

    public function newUser(){
        if(\Auth::user()->id == 1) {
            return view('admin.new-user');
        }
        else {
            return response()->view("vendor.adminlte.errors.403", [], 403);
        }
    }

    public function createUser(Requests\UserRequest $request){
        $user = new User;
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input("password"));
        $user->name = $request->input("name");
        $user->save();

        return redirect('/admin/users');
    }


    public function editUser(User $user){
        if(\Auth::user()->id == 1) {
            return view('admin.edit-user',[
                'user' => $user,
            ]);
        }
        else {
            return response()->view("vendor.adminlte.errors.403", [], 403);
        }
    }

    public function updateUser(Requests\EditUserRequest $request, User $user){
        if(\Auth::user()->id == 1) {
            $name = $request->input("name");
            $password = $request->input("password");
            $email = $request->input("email");
            if (isset($name) && $name != null) {
                $user->name = $name;
            }
            if (isset($password) && $password != null) {
                $user->password = bcrypt($password);
            }
            if (isset($email) && $email != null) {
                $user->email = $email;
            }
            $user->save();
            return redirect()->action("AdminController@listUsers");
        }
        else {
            return response()->view("vendor.adminlte.errors.403", [], 403);
        }
    }

    public function listCategories(){
        $categories = Category::all();
        return view('admin.categories',
            [
                'categories' => $categories
            ]);
    }

    public function deleteCategory($cat){
        $cat = Category::find($cat);
        try {
            $cat->deleteTranslations();
            $cat->delete();
        }
        catch (\Exception $e){
        }
        return back();
    }


    public function newCategory(){
        if(\Auth::user()->id == 1) {
            return view('admin.new-category');
        }
        else {
            return response()->view("vendor.adminlte.errors.403", [], 403);
        }
    }

    public function createCategory(Requests\CategoryRequest $request){
        $data = $request->all();
        $category = new Category;
        $category->save();

        foreach (['en', 'ar'] as $locale) {
            $category->translateOrNew($locale)->name = $data[$locale]['name'];
            $category->translateOrNew($locale)->slug = $data[$locale]['slug'];
        }

        $category->save();

        return redirect('/admin/categories');
    }


    public function editCategory(Category $category){
        if(\Auth::user()->id == 1) {
            return view('admin.edit-category',[
                'category' => $category,
            ]);
        }
        else {
            return response()->view("vendor.adminlte.errors.403", [], 403);
        }
    }

    public function updateCategory(Requests\EditCategoryRequest $request, Category $category){
        if(\Auth::user()->id == 1) {
            $data = $request->all();
            foreach (['en', 'ar'] as $locale) {
                $category->translateOrNew($locale)->name = $data[$locale]['name'];
                $category->translateOrNew($locale)->slug = $data[$locale]['slug'];
            }
            $category->save();
            return redirect()->action("AdminController@listCategories");
        }
        else {
            return response()->view("vendor.adminlte.errors.403", [], 403);
        }
    }


    public function listPosts(){
        $posts = Post::all();
        return view('admin.posts',
            [
                'posts' => $posts
            ]);
    }

    public function deletePost($post){
        $post = Post::find($post);
        try {
            $post->deleteTranslations();
            $post->delete();
        }
        catch (\Exception $e){
        }
        return back();
    }


    public function newPost(){
        if(\Auth::user()->id == 1) {
            return view('admin.new-post');
        }
        else {
            return response()->view("vendor.adminlte.errors.403", [], 403);
        }
    }

    public function createPost(Requests\PostRequest $request){
        $data = $request->all();
        $post = new Post;
        $user = \Auth::user();
        $post->user()->associate($user);

        $post->category()->associate(Category::find($request->category));

        foreach (['en', 'ar'] as $locale) {
            $post->translateOrNew($locale)->title = $data[$locale]['title'];
            $post->translateOrNew($locale)->description = $data[$locale]['description'];
        }

        $upload_to = resource_path("img");

        $image = $request->image;
        $rules = array('file' => 'mimes:png,jpeg');
        $validator = Validator::make(array('file' => $image), $rules);
        if ($validator->passes() || true) {
            $filename = $image->getClientOriginalName();
            $fileNameStored = sha1(\Auth::user()->email . (string)time() . $filename);
            $upload_success = $image->move($upload_to, $fileNameStored);
        }
        $post->image = $fileNameStored;

        $post->save();

        return redirect('/admin/posts');
    }


    public function editPost(Post $post){
        if(\Auth::user()->id == 1) {
            return view('admin.edit-post',[
                'post' => $post,
            ]);
        }
        else {
            return response()->view("vendor.adminlte.errors.403", [], 403);
        }
    }

    public function updatePost(Requests\EditPostRequest $request, Post $post){
        if(\Auth::user()->id == 1) {
            $data = $request->all();

            $post->category_id = Category::find($request->category)->id;

            foreach (['en', 'ar'] as $locale) {
                $post->translateOrNew($locale)->title = $data[$locale]['title'];
                $post->translateOrNew($locale)->description = $data[$locale]['description'];
            }

            $upload_to = resource_path("img");

            $image = $request->image;
            if($image !== null) {
                $rules = array('file' => 'mimes:png,jpeg');
                $validator = Validator::make(array('file' => $image), $rules);
                if ($validator->passes() || true) {
                    $filename = $image->getClientOriginalName();
                    $fileNameStored = sha1(\Auth::user()->email . (string)time() . $filename);
                    $upload_success = $image->move($upload_to, $fileNameStored);
                }
                $post->image = $fileNameStored;
            }
            $post->save();
            return redirect()->action("AdminController@listPosts");
        }
        else {
            return response()->view("vendor.adminlte.errors.403", [], 403);
        }
    }
}