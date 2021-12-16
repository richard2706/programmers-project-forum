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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderByDesc('date_time_posted')->paginate(10);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::get();
        return view('posts.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
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
            $imagePath = $request->file('image')->store('public/post-images');
            $post->image_path = $imagePath;
        }

        $currentProfile = Auth::user()->userProfile;
        $currentProfile->posts()->save($post);
        $post->tags()->attach($request->tag);

        return redirect()->route('home')->with('message', 'Post added successfully.');
    }

    /**
     * Display the specified resource.
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
     * Show the form for editing the specified resource.
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
     * Update the specified resource in storage.
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
            'image_path' => ['nullable', 'url'],
            'content' => ['required'],
        ]);

        $post->title = $request->title;
        $post->project_link = $request->project_link;
        $post->image_path = $request->image_path;
        $post->content = $request->content;
        $post->save();

        // Remove all old tags then add updated tags
        $post->tags()->detach(Tag::get()->modelKeys());
        $post->tags()->attach($request->tag);

        return redirect()->route('posts.show', compact('post'))
            ->with('post_message', 'Post updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
