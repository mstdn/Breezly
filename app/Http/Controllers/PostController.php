<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class PostController extends Controller
{
    public function index(Post $post)
    {
        return Inertia::render('Posts/Index', [
            'posts' => Post::query()            
            ->paginate(10)
            ->withQueryString()
            ->through(fn($post) => [
                'user'    =>  $post->user->username,
                'content'  =>  $post->content
            ])
        ]);
    }
    
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'content'  => 'required|min:1',
        ]);

        $attributes['user_id'] = auth()->user()->id;

        Post::create($attributes);

        return redirect(('/home'));
    }
}
