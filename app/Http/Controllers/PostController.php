<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a paginated listing of all posts, most recent first.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderByDesc('date_time_posted')->paginate(10);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new post.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::get();
        return view('posts.create', compact('tags'));
    }

    /**
     * Store a newly created post in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:255'],
            'project_link' => ['nullable', 'url'],
            'image' => ['nullable', 'image'],
            'content' => ['required'],
        ]);

        $post = new Post;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->date_time_posted = date('Y-m-d H:i:s');
        $post->project_link = $request->project_link;

        if ($request->has('image')) {
            $folder = 'public';
            $imagePath = $request->file('image')->store($folder . '/post-images');
            $post->image_path = substr($imagePath, strlen($folder) + 1);
        }

        $currentProfile = Auth::user()->userProfile;
        $currentProfile->posts()->save($post);
        $post->tags()->attach($request->tag);

        return redirect()->route('home')->with('message', 'Post added successfully.');
    }

    /**
     * Display the post and its comments (paginated, newest first).
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $comments = Comment::where('post_id', $post->id)->orderByDesc('date_time_posted')->paginate(5);
        return view('posts.show', compact('post', 'comments'));
    }

    /**
     * Show the form for editing the post.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if (Auth::user()->userProfile != $post->userProfile) {
            return abort(401);
        }

        $tags = Tag::get();
        return view('posts.edit', compact('post', 'tags'));
    }

    /**
     * Update the post in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        if (Auth::user()->userProfile != $post->userProfile) {
            return abort(401);
        }
        
        $request->validate([
            'title' => ['required', 'max:255'],
            'project_link' => ['nullable', 'url'],
            'image' => ['nullable', 'image'],
            'content' => ['required'],
        ]);

        $post->title = $request->title;
        $post->project_link = $request->project_link;
        $post->content = $request->content;

        if ($request->has('image')) {
            $folder = 'public';
            $imagePath = $request->file('image')->store($folder . '/post-images');
            $post->image_path = substr($imagePath, strlen($folder) + 1);
        }
        
        $post->save();

        // Remove all old tags then add updated tags
        $post->tags()->detach(Tag::get()->modelKeys());
        $post->tags()->attach($request->tag);

        return redirect()->route('posts.show', compact('post'))
            ->with('post_message', 'Post updated.');
    }
}
