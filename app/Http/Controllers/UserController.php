<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(Request $request, User $user)
    {

        return Inertia::render('Users/Index', [
            'users' => User::query()
                ->with('followings')
                ->when($request->input('search'), function ($query, $search) {
                    $query->where('username', 'like', "%{$search}%");
                })
                ->paginate(10)
                ->withQueryString()
                ->through(fn ($user) => [
                    'id'    =>  $user->id,
                    'name'  =>  $user->name,
                    'username' => $user->username,
                    'pic'    => $user->getProfilePhotoUrlAttribute(),
                    'time'      =>  $user->created_at->diffForHumans(),
                    'isFollowing'    =>  Auth::user()->isFollowing($user),
                    'isFollowedBy'   =>  Auth::user()->isFollowedBy($user),
                    'followbutton'   =>  Auth::user()->id === $user->id,
                ]),
            'filters'           =>  $request->only(['search']),
            'usercount'         =>  User::latest()->count()
        ]);
    }

    public function show(User $user, Post $post)
    {
        if (Auth::user()) {
            $isFollowing = Auth::user()->isFollowing($user);
            $followedBy = Auth::user()->isFollowedBy($user);
            $followButton = Auth::user()->id === $user->id;
            $liked = $post->isLikedBy(auth()->user());
        } else {
            $isFollowing = null;
            $followedBy = null;
            $followButton = null;
            $liked = null;
        }

        return Inertia::render('Users/Show', [
            'profile' => [
                'id'             =>  $user->id,
                'name'           =>  $user->name,
                'about'          =>  $user->about,
                'pic'            =>  $user->getProfilePhotoUrlAttribute(),
                'time'           =>  $user->created_at->diffForHumans(),
                'username'       =>  $user->username,
                'website'        =>  $user->website,
                'postamount'     =>  $user->posts->count(),
                'followerscount' =>  $user->followers()->count(),
                'followcount'    =>  $user->followings()->count(),
                'isFollowing'    =>  $isFollowing,
                'isFollowedBy'   =>  $followedBy,
                'followbutton'   =>  $followButton,
                'posts' => Post::query()
                    ->where('user_id', $user->id)
                    ->latest()
                    ->paginate(10)
                    ->through(fn ($post) => [
                        'id'                =>  $post->id,
                        'text'  =>  $post->content,
                        'avatar'            =>  $post->user->getProfilePhotoUrlAttribute(),
                        'time'              =>  $post->created_at->diffForHumans(),
                        'username'          =>  $post->user->username,
                        'video'             =>  Storage::disk('public')->url('uploads/' . $post->user->id . '/' . 'videos/' . $post->id . '.mp4'),
                        'status'        =>  $post->status,
                        'isliked'       =>  $liked,
                        'likes'         =>  $post->likers()->count(),
                        'hasVideo'  =>  $post->converted_for_downloading_at,
                        'media'     =>  'storage/' . $post->media,
                    ]),
            ],
        ]);
    }

    public function follow(User $user)
    {
        if (auth()->user()->isFollowing($user)) {
            auth()->user()->unfollow($user);
        } else {
            auth()->user()->toggleFollow($user);
        }

        return back();
    }
}
