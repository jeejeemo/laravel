<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use function foo\func;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/blog', function(Request $request){
    return [
        "article" => "Article 1",
    ];
});

Route::prefix('/blog')->name('blog.')->group(function () {

    Route::get('/', function(Request $request){

        $post =  \App\Models\Post::find(1);
        $post -> slug = 'Mon-premier-article';
        $post -> save();

        return $post = \App\Models\Post::all();
    })->name('index');

    Route::get('/{slug}-{id}', function(string $slug, string $id, Request $resquest){

        return [
            "slug"  => $slug,
            "id"    => $id,
            "name"  => $resquest->input('name')    

        ];
    })->where([
        "id"    => '[0-9]+',
        "slug"  => '[a-zM-Z8-9\-]+'

    ])->name('show');
});



