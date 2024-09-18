<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller implements HasMiddleware
{

    public static function middleware(): array
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
        $request->validate([
            'title' => 'required',
            'max:255',
            'body' => 'required',
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048']
        ]);


        //UPLOAD IMAGE
        $path = null;
        if ($request->hasFile('image')) {
            $path = Storage::disk('public')->put('posts_images', $request->image);

        }



        //CREATE POST
        $post = Auth::user()->posts()->create(
            [
                'title' => $request->title,
                'body' => $request->body,
                'image' => $path
            ]
        );

        //SEND EMAIL
        Mail::to(Auth::user())->send(new WelcomeMail(Auth::user(), $post));


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
            'title' => [
                'required',
                'max:255'
            ],
            'body' => 'required',
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048']

        ]);

        //UPLOAD IMAGE
        $path = $post->image ?? null;
        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $path = Storage::disk('public')->put('posts_images', $request->image);

        }

        //UPDATE POST
        $post->update(
            [
                'title' => $fields['title'],
                'body' => $fields['body'],
                'image' => $path
            ]
        );

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

        //DELETE POST IMAGE
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return back()->with("delete", "Your post was deleted!");
    }
}
