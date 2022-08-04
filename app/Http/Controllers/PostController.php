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
            ->latest()
            ->paginate(50)
            ->withQueryString()
            ->through(fn($post) => [
                'name'    =>  $post->user->name,
                'username'    =>  $post->user->username,
                'text'  =>  $post->content,
                'time'      =>  $post->created_at->diffForHumans(),
                'avatar'    =>  $post->user->getProfilePhotoUrlAttribute(),
                'userlink'  =>  '@' . $post->user->username
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
