<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller 
{
    public function index()
    {

        $posts = Auth::user()->posts()->latest()->paginate(6);

        return view('users.dashboard', ['posts' => $posts]);
    }

    public function userPosts(User $user)
    {


        $userPosts = $user->posts()->latest()->paginate(10);
        $user = $user->username;

        return view('users.posts', ['posts' => $userPosts, 'user' => $user]);
    }
}
