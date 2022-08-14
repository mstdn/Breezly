<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PublicController extends Controller
{
    public function public(Post $post)
    {
        return Inertia::render('Public/Index', [
            'posts' => Post::query()
                ->latest()
                ->paginate(20)
                ->withQueryString()
                ->through(fn ($post) => [
                    'id'            =>  $post->id,
                    'name'    =>  $post->user->name,
                    'username'    =>  $post->user->username,
                    'text'  =>  $post->content,
                    'time'      =>  $post->created_at->diffForHumans(),
                    'avatar'    =>  $post->user->getProfilePhotoUrlAttribute(),
                    'userlink'  =>  '@' . $post->user->username,
                    'media'     =>  'storage/' . $post->media,
                    'hasVideo'  =>  $post->converted_for_downloading_at,
                    'video'         =>  Storage::disk('public')->url('uploads/' . $post->user->id . '/' . 'videos/' . $post->id . '.mp4'),
                    'status'        =>  $post->status,
                    'likes'         =>  $post->likers()->count(),
                ])
        ]);
    }
}
