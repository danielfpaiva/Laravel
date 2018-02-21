<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\Post;
use App\User;

/*Route::get('/', function () {
    return view('welcome');
});*/

/*Route::get('/about', function () {
    return "Hi about page";
});


Route::get('/contacts', function () {
    return "Hi contacts";
});

Route::get('/post/{id}/{name}/{p}', function ($id, $name, $p) {
    return "This is post number ".$id . " ". $name . "  - ".$p;
});

Route::get('admin/posts/example', array('as'=>'admin.home',function (){

    $url = route('admin.home');

    return "Funciono ".$url;

}));*/


//Route::get('/post/{id}','PostsController@index');


//Route::resource('posts','PostsController');

/*Route::get('/contact', 'PostsController@contact');

Route::get('post/{id}/{name}/{password}', 'PostsController@show_post');*/


/*
|-----------------------------------------------------------------------
| DATABASE CRUD
|-----------------------------------------------------------------------
*/

//insert a new row in databse
Route::get('/insert', function(){
  DB::insert('insert into posts (title,content) values (?, ?)',['PHP with Laravel1','PHP LARAVEL is the best thing that has happened to PHP2']);
});


// select with condition
Route::get('/read',function (){
    $results=DB::select('select * from posts where id= ?', [1]);

    foreach ($results as $result){
        return $result->title;
    }
});

// update a row in database
Route::get('/update', function(){
    $affected = DB::update('update posts set title="Updated Title" Where id=?',[1]);

    return $affected;
});

// delete with here
Route::get('/delete', function (){
    $deleted = DB::delete('DELETE posts where id=?',[1]);

    return $deleted;
});

/*
|-----------------------------------------------------------------------
| ELOQUENT
|-----------------------------------------------------------------------
*/

// Get all the data in database
Route::get('/readElo', function(){
    $posts = Post::all();

    foreach ($posts as $post){
        return $post->title;
    }

});


// Get the row that have a specific id
Route::get('/find', function(){
    $posts = Post::find(2);

    return $posts->title;
});


// get the row that have the condition order by desc from a collumn
Route::get('/findwhere', function(){
    $post = Post::where('id',2)->orderBy('id', 'desc')->take(1)->get();

    return $post;

});


Route::get('/findmore', function(){
/*    $post = Post::findOrFail(1);

    return $post;*/

    $post = Post::where('users_count', '<', 50)->firstOrFail();

    return $post;
});



// insert data in table
Route::get('/basicinsert', function(){
    $post = new Post;

    $post->title= "New Eloquent title insert";
    $post->content= "WOW loquent is really cool";

    $post->save();
});

// update a specific row in database
Route::get('/basicupdate', function (){
    $post = Post::find(3);

    $post->title = "Update";
    $post->content = "Updated";

    $post->save();
});

// creates a new roe in database
Route::get('/create', function (){
    Post::create(['title'=>'the create method','content'=>'WOW I\'am learning a lot with Edwin Diaz']);
});

//update a row with two conditions
Route::get('/updateElo', function (){
    Post::where('id',2)->where('is_admin',0)->update(['title'=>'New PHP title','content'=>'I love my instructor']);
});

//delete a row
Route::get('/deleteElo', function (){
   $post = Post::find(4);

   $post->delete();
});

//delete one or more rows
Route::get('/deleteElo1', function (){
    Post::destroy([2,5]);

    // Post::where('is_admin',0)->delete();
});

// update the deleted_at column instead delete the row
Route::get('/softdelete',function(){
    Post::find(16)->delete();
});


// select soft delete items
Route::get('readsoftdelete',function (){
    /*$post = Post::withTrashed()->where('id',6)->get();

    return $post;*/
    $post = Post::onlyTrashed()->where('is_admin',0)->get();

    return $post;
});


//restore a softdeleted item to a normal item
Route::get('/restore',function (){
    Post::withTrashed()->where('is_admin',0)->restore();
});

// remove soft deletes from database
Route::get('/removesoftdeleted',function (){
    Post::onlyTrashed()->where('is_admin',0)->forceDelete();
});

/*
|-----------------------------------------------------------------------
| ELOQUENT RELATIONSHIPS
|-----------------------------------------------------------------------
*/

// one to one relationship
Route::get('/user/{id}/post', function ($id){
    return User::find($id)->post->content;
});

// reverse relationship
Route::get('/post/{id}/user', function($id){
    return Post::find($id)->user->name;
});

// one to many relationship
Route::get('/posts', function(){
    $user = User::find(1);

    foreach ($user->posts as $post){
        echo $post->title."<br>";
    }
});

Route::get('/user/{id}/role',function ($id){

    $user =User::find($id)->roles()->orderBy('id', 'desc')->get();

    return $user;

/*    $user = User::find($id);

    foreach ($user->roles as $role) {
        return $role->name;
    }*/
});

Route::group(['middleware' => ['web']], function(){

});