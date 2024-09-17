<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PostController extends Controller implements HasMiddleware
{

    public static function middleware() : array
    {
        return [
            new Middleware('auth', except: ['index', 'show'])
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $post = Post::latest()->paginate(10);

        return view('posts.index', ['posts' => $post]); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //VALIDATION
        $fields = $request->validate([
            'title' => 'required', 'max:255',
            'body' => 'required',
        ]);

        //CREATE POST
        Auth::user()->posts()->create($fields);

        //REDIRECT
        return back()->with('success', 'Post Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        // AUTHORIZE --> [Polices] 
        Gate::authorize('modify', $post);


        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {

           // AUTHORIZE --> [Polices] 
           Gate::authorize('modify', $post);

         //VALIDATION
         $fields = $request->validate([
            'title' => 'required', 'max:255',
            'body' => 'required',
        ]);

        //UPDATE POST
        $post->update($fields);

        //REDIRECT
        return redirect()->route('posts.show', $post)->with('success', 'Post updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
       // AUTHORIZE --> [Polices] 
        Gate::authorize('modify', $post);

       
        $post->delete();

        return back()->with("delete", "Your post was deleted!");
    }
}
