<?php

namespace App\Mail;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewComment extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The post for which there is a new comment.
     * 
     * @var \App\Model\Post
     */
    protected $post;

    /**
     * The comment which has been added to the post.
     * 
     * @var \App\Models\Comment
     */
    protected $comment;

    /**
     * Create a new message instance.
     *
     * @param Post  $post
     * @param Comment  $comment
     * @return void
     */
    public function __construct(Post $post, Comment $comment)
    {
        $this->post = $post;
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('notifications@project-forum.com', 'Project Forum Notifications')
            ->view('emails.newcomment')
            ->with(['post' => $this->post, 'comment' => $this->comment]);
    }
}
