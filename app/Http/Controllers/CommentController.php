<?php

namespace App\Http\Controllers;

use App\Mail\NewComment;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function create(Post $post)
    {
        return view('comments.create', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Post  $post
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => ['required', 'max:2000'],
        ]);

        $comment = new Comment;
        $comment->content = $request->content;
        $comment->date_time_posted = date('Y-m-d H:i:s');
        $currentProfile = Auth::user()->userProfile;
        $comment->userProfile()->associate($currentProfile);
        $post->comments()->save($comment);

        // Send email to post creator (if it is not the current user)
        $postCreatorProfile = $post->userProfile;
        if ($postCreatorProfile != Auth::user()->userProfile) {
            Mail::to($postCreatorProfile->user)->send(new NewComment($post, $comment));
        }

        return redirect()->route('posts.show', compact('post'))
            ->with('comment_message', 'Comment added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post  $post
     * @param  Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post, Comment $comment)
    {
        if (Auth::user()->userProfile != $comment->userProfile) {
            return abort(401);
        }

        return view('comments.edit', compact('post', 'comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post  $post
     * @param  Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post, Comment $comment)
    {
        if (Auth::user()->userProfile != $comment->userProfile) {
            return abort(401);
        }

        $request->validate([
            'content' => ['required', 'max:2000'],
        ]);

        $comment->content = $request->content;
        $comment->save();

        return redirect()->route('posts.show', compact('post'))
            ->with('comment_message', 'Comment updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post  $post
     * @param  Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post, Comment $comment)
    {
        $comment->delete();
        return redirect()->route('posts.show', compact('post'))->with('comment_message', 'Comment deleted.');
    }
}
