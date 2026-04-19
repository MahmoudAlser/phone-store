<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CPost;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});

require __DIR__.'/auth.php';

Route::get('/posts', function () {
    $posts=\App\Models\Post::paginate(6);
    return view('posts',['posts'=>$posts]);
});
Route::get('/welcome', function () {
    Auth::login();
    return redirect('/');
});
Route::get('/addpost', function () {
    if (!Auth::check() || Auth::user()->name !== 'admin') {
        abort(403);
    }
    $addpost=\App\Models\category::all();
    return view('addpost',['addpost'=>$addpost]);
})->middleware('auth');

Route::post('/ainsertpost', function (\Illuminate\Http\Request $request) {
    if (!Auth::check() || Auth::user()->name !== 'admin') {
        abort(403);
    }

    $imgPath = null;
    if ($request->hasFile('image') && $request->file('image')->isValid()) {
        $imgPath = $request->file('image')->store('posts', 'public');
    }

    \App\Models\Post::create([
        'p_title'   => $request->title,
        'p_content' => $request->content,
        'post_cat'  => $request->category,
        'post_user' => Auth::id(),
        'img'       => $imgPath,
    ]);

    return redirect('/posts');
})->middleware('auth');

// صفحة البوست المفرد
Route::get('/post/{id}', function ($id) {
    $post = \App\Models\Post::with(['comments.user', 'users', 'categorys'])->findOrFail($id);
    return view('post', ['post' => $post]);
})->middleware('auth');

// إضافة تعليق
Route::post('/post/{id}/comment', function (\Illuminate\Http\Request $request, $id) {
    \App\Models\Comment::create([
        'com_content' => $request->comment,
        'com_user'    => Auth::id(),
        'com_post'    => $id,
    ]);
    return redirect('/post/' . $id);
})->middleware('auth');