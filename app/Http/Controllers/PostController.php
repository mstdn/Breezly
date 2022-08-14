<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;
use App\Jobs\ConvertVideoForDownloading;

class PostController extends Controller
{
    public function index(Post $post)
    {
        return Inertia::render('Posts/Index', [
            'posts' => Post::query()       
            ->latest()
            ->paginate(20)
            ->withQueryString()
            ->through(fn($post) => [
                'name'    =>  $post->user->name,
                'username'    =>  $post->user->username,
                'text'  =>  $post->content,
                'time'      =>  $post->created_at->diffForHumans(),
                'avatar'    =>  $post->user->getProfilePhotoUrlAttribute(),
                'userlink'  =>  '@' . $post->user->username,
                'media'     =>  'storage/' . $post->media,
                'hasVideo'  =>  $post->converted_for_downloading_at,
                'video'         =>  Storage::disk('public')->url('uploads/' . $post->user->id . '/' . 'videos/' . $post->id . '.mp4'),
            ])
        ]);
    }

    public function home(Post $post, Request $request, User $user)
    {
        $tweets = $user->posts()->with('user')->paginate();

        if ($request->wantsJson()) {
            return $tweets;
        }
        return Inertia::render('Posts/Home', [
            'posts' => Post::where(function ($query)
            {
                $query->where('user_id', auth()->id())
                ->orWhereIn('user_id', auth()->user()->followings->pluck('followable_id'));
            })
            ->latest()
            ->when($request->input('search'), function ($query, $search) {
                $query->where('description', 'like', "%{$search}%");
            })
            ->paginate(5)
            ->withQueryString()
            ->through(fn($post) => [
                'id'            =>  $post->id,
                'name'          =>  $post->user->name,
                'username'      =>  $post->user->username,
                'text'          =>  $post->content,
                'time'          =>  $post->created_at->diffForHumans(),
                'avatar'        =>  $post->user->getProfilePhotoUrlAttribute(),
                'userlink'      =>  '@' . $post->user->username,
                'media'         =>  'storage/' . $post->media,
                'hasVideo'      =>  $post->converted_for_downloading_at,
                'video'         =>  Storage::disk('public')->url('uploads/' . $post->user->id . '/' . 'videos/' . $post->id . '.mp4'),
                'delete'        =>  Auth::user()->id === $post->user_id,
                'status'        =>  $post->status,
                'isliked'       =>  $post->isLikedBy(auth()->user()),
                'likes'         =>  $post->likers()->count(),
            ]),
            'filters'           =>  $request->only(['search']),
            'postcount'         =>  Post::latest()->count()
        ]);
    }


    public function public(Post $post)
    {
        return Inertia::render('Posts/Index', [
            'posts' => Post::query()       
            ->latest()
            ->paginate(20)
            ->withQueryString()
            ->through(fn($post) => [
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
                'delete'        =>  Auth::user()->id === $post->user_id,
                'status'        =>  $post->status,
                'isliked'       =>  $post->isLikedBy(auth()->user()),
                'likes'         =>  $post->likers()->count(),
            ])
        ]);
    }
    
    public function store(Request $request)
    {
         // Validate form fields
         $post = $request->validate([
            'content'          => 'required|min:1|max:500',
            'image'            => ['nullable','mimes:jpg,jpeg,png,gif','max:500048'],
            'video'            => 'nullable|file|mimetypes:video/x-ms-asf,video/x-flv,video/mp4,video/mpeg,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi|max:50240',
            'tags'             => 'nullable',
            'disk'             => 'public',
        ]);
        // Get user_id from auth
        $post['user_id'] = auth()->id();

        if($request->hasFile('media')) 
        {
            $post['media'] = $request->file('media')->store('uploads/images/', 'public');
        }

        if($request->hasFile('video')) 
        {
            $post['video'] = $request->file('video')->store('uploads/videos/', 'public');

            $post = Post::create([
                'disk'          => 'public',
                'original_name' => $request->video->getClientOriginalName(),
                'path'          => $request->video->store('videos', 'public'),
                'user_id'       => auth()->id(),
                'content'       => $request->content,
            ]);

            $this->dispatch(new ConvertVideoForDownloading($post));
        } 
        else 
        {
            $post = Post::create($post);
        }
        return redirect(('/home'));
    }

    public function like(Post $post)
    {
        if(auth()->user()->hasLiked($post) ) {
            auth()->user()->unlike($post);
        } else {
       auth()->user()->toggleLike($post);
        }
        return back();
    }


    // Delete item
    public function destroy(Post $post) 
    {
        if (! Gate::allows('delete-post', $post)) {
            abort(403);
        }

        File::delete(public_path('uploads/videos/') . $post->id . '.mp4');

        // Delete the file
        File::delete($post->path);

        $post->delete();
        return redirect('/home')->with('message', 'Post deleted successfully.');
    }

}
