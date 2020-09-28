<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


## -- Laravel Default Authentication --

#### Step 1: Create Auth Scaffolding 
- You have to follow few steps to make auth in your laravel 8 application.
First, you need to install the laravel/UI package as like bellow:

```
composer require laravel/ui
php artisan ui bootstrap --auth
npm install && npm run dev
```

#### Step 3: Create Database at phpMyAdmin named `laravel-8-realtime-notification-with-pusher-and-laravel-echo` and setup .env file in your root directory 

- Database
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel-8-realtime-notification-with-pusher-and-laravel-echo
DB_USERNAME=root
DB_PASSWORD=
```

#### Step 4: Migrate Database
- Now you need to run default migration of laravel by the following command:
```
php artisan migrate
```

#### Step 5: Run Server
```
php artisan serve
```

## --Nested Comment System in Laravel from Scratch--

#### Step 1: Create Post and Comment Table
- We are going to create comment system from scratch. so we have to create migration for "posts" and "comments" table using Laravel 8 php artisan command, so first fire bellow command:

`php artisan make:migration create_posts_table`
- After this command you will find one file in following path "database/migrations" and you have to put bellow code in your migration file for create tables.
```
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('body');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
```

`php artisan make:migration create_comments_table`
- After this command you will find one file in following path "database/migrations" and you have to put bellow code in your migration file for create tables.
```
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->integer('post_id')->unsigned();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->text('body');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
```

#### Step 2: Create Model
- In this step, we need to create model Post and Comment for each table. we also need to make code for laravel relationship for comments, replies, user. So create both model as bellow.
- Run bellow command to create Post model:

`php artisan make:model Post`
- app/Post.php

```
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = ['title', 'body'];  

    public function comments()
    {
        return $this->hasMany('App\Comment')->whereNull('parent_id');
    }
}

```
- Run bellow command to create Comment model:

`php artisan make:model Comment`
- app/Comment.php
```
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = ['user_id', 'post_id', 'parent_id', 'body'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function replies()
    {
        return $this->hasMany('App\Comment', 'parent_id');
    } 
}

```

#### Step 3: Create Controller
- In this step, now we should create new controller as PostController and CommentController. So run bellow command and create new controller.
- Create Post Controller using bellow command:

`php artisan make:controller PostController`
- app/Http/Controllers

```
<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Post;  

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();  
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
    	$request->validate([
            'title'=>'required',
            'body'=>'required',
        ]);   

        Post::create($request->all());
        return redirect()->route('posts.index');
    }

    public function show($id)
    {
    	$post = Post::find($id);
        return view('posts.show', compact('post'));
    }
}
```
- Create Comment Controller using bellow command:

`php artisan make:controller CommentController`
- app/Http/CommentController
```
<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Comment;  

class CommentController extends Controller
{

    public function store(Request $request)
    {
    	$request->validate([
            'body'=>'required',
        ]);
        $input = $request->all();
        $input['user_id'] = auth()->user()->id;  
        Comment::create($input);  
        return back();
    }
}
```

#### Step 4: Create Blade Files
- In last step. In this step we have to create just blade files. So mainly we have to create layout file and then create new folder "posts" then create blade files for comment system. So finally you have to create following bellow blade file:
```
1) index.blade.php
2) show.blade.php
3) create.blade.php
4) commentsDisplay.blade.php
```
- resources/views/posts/index.blade.php

```
@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1>Manage Posts</h1>
            <a href="{{ route('posts.create') }}" class="btn btn-success" style="float: right">Create Post</a>
            <table class="table table-bordered">
                <thead>
                    <th width="80px">Id</th>
                    <th>Title</th>
                    <th width="150px">Action</th>
                </thead>
                <tbody>
                @foreach($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>
                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">View Post</a>
                    </td>
                </tr>
                @endforeach
                </tbody>  
            </table>
        </div>
    </div>
</div>
@endsection
```

- resources/views/posts/show.blade.php
```
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center text-success">ItSolutionStuff.com</h3>
                    <br/>
                    <h2>{{ $post->title }}</h2>
                    <p>
                        {{ $post->body }}
                    </p>
                    <hr />
                    <h4>Display Comments - {{ $post->comments->count() }}</h4> 
                    @include('posts.commentsDisplay', ['comments' => $post->comments, 'post_id' => $post->id])
                    <hr />
                    <h4>Add comment</h4>
                    @guest
                    <p>To add favorite list. You need to login first</p>
                    @else
                    <form method="post" action="{{ route('comments.store') }}">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" name="body"></textarea>
                            <input type="hidden" name="post_id" value="{{ $post->id }}" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Add Comment" />
                        </div>
                    </form>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
```

- resources/views/posts/create.blade.php
```
@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Post</div>
                <div class="card-body">
                    <form method="post" action="{{ route('posts.store') }}">
                        <div class="form-group">
                            @csrf
                            <label class="label">Post Title: </label>
                            <input type="text" name="title" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label class="label">Post Body: </label>
                            <textarea name="body" rows="10" cols="30" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
```

- resources/views/posts/commentsDisplay.blade.php
```
@foreach($comments as $comment)
    <div class="display-comment" @if($comment->parent_id != null) style="margin-left:40px;" @endif>
        <strong>{{ $comment->user->name }}</strong>
        <p>{{ $comment->body }}</p>
        <a href="" id="reply"></a>
        <form method="post" action="{{ route('comments.store') }}">
            @csrf
            <div class="form-group">
                <input type="text" name="body" class="form-control" />
                <input type="hidden" name="post_id" value="{{ $post_id }}" />
                <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-warning" value="Reply" />
            </div>
        </form>
        @include('posts.commentsDisplay', ['comments' => $comment->replies])
    </div>
@endforeach
```
- Now we are ready to run our comment system application example with laravel 8 so run bellow command for quick run:

#### Step 5: route/web.php Files is:
```
<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/', [App\Http\Controllers\PostController::class, 'index'])->name('posts.index');
Route::get('post', [App\Http\Controllers\PostController::class, 'create'])->name('post.create');
Route::post('post', [App\Http\Controllers\PostController::class, 'store'])->name('post.store');
Route::get('/post-show/{id}', [App\Http\Controllers\PostController::class, 'show'])->name('post.show');
Route::post('/comment/store', [App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');
```
#### Step 6: Fainally Run Below Command
`php artisan migrate`
`php artisan serve`
- Now you can open bellow URL on your browser:
`http://localhost:8000/posts`