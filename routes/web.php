<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ],
    function()
    {
        /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
        Route::get('/', 'MainController@index');
        Route::get('categories', 'MainController@categories');
        Route::get('categories/{slug}', ['as' => 'category.show', 'uses' => 'MainController@catPosts']);
        Route::get('post/{id}', ['as' => 'post.show', 'uses' => 'MainController@post']);

        Route::group(['middleware' => 'auth'], function () {

            Route::get('/admin/home', function ()    {
                return view('vendor.adminlte.home');
            });

            Route::get('/admin/about', function ()    {
                return view('admin.about');
            });

            Route::get('/admin/posts', function ()    {
                return view('admin.posts');
            });

            Route::get('/admin/categories', function ()    {
                return view('admin.categories');
            });

            Route::get('/admin/users', ['as' => 'admin.users', 'uses' => 'AdminController@listUsers']);
            Route::get('/admin/users/new-user','AdminController@newUser');
            Route::post('/admin/users/create-user','AdminController@createUser');
            Route::post('/admin/users/{user}/delete', 'AdminController@deleteUser');
            Route::get('/admin/users/{user}/edit','AdminController@editUser');
            Route::post('/admin/users/{user}/update','AdminController@updateUser');

            Route::get('/admin/categories', ['as' => 'admin.categories', 'uses' => 'AdminController@listCategories']);
            Route::get('/admin/categories/new-category','AdminController@newCategory');
            Route::post('/admin/categories/create-category', ['as' => 'admin.create-category', 'uses' => 'AdminController@createCategory']);
            Route::post('/admin/categories/{category}/delete', 'AdminController@deleteCategory');
            Route::get('/admin/categories/{category}/edit','AdminController@editCategory');
            Route::post('/admin/categories/{category}/update', ['as' => 'admin.update-category', 'uses' => 'AdminController@updateCategory']);

            Route::get('/admin/posts', ['as' => 'admin.posts', 'uses' => 'AdminController@listPosts']);
            Route::get('/admin/posts/new-post','AdminController@newPost');
            Route::post('/admin/posts/create-post', ['as' => 'admin.create-post', 'uses' => 'AdminController@createPost']);
            Route::post('/admin/posts/{post}/delete', 'AdminController@deletePost');
            Route::get('/admin/posts/{post}/edit','AdminController@editPost');
            Route::post('/admin/posts/{post}/update', ['as' => 'admin.update-post', 'uses' => 'AdminController@updatePost']);

        });
    });

Route::get('images/{filename}', function($filename){
    $path = resource_path() . '/img/' . $filename;
    if(!File::exists($path)) {
        return response()->json(['message' => 'Image not found.'], 404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
})->name("image");