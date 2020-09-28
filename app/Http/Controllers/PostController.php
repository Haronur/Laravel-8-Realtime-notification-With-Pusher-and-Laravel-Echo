<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
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

        $input = $request->all();
        $input['userId'] = auth()->user()->id;  
        Post::create($input);   
        return redirect()->route('posts.index');
    }

    public function show($id)
    {
    	$post = Post::find($id);
        return view('posts.show', compact('post'));
    }
}
