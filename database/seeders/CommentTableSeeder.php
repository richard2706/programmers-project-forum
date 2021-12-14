<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comment1 = new Comment;
        $comment1->content = "Nice looking project :D";
        $comment1->date_time_posted = "2021-12-10 13:33:12";
        $coolKiwiId = UserProfile::find(1)->id;
        $comment1->user_profile_id = $coolKiwiId;
        Post::find(2)->comments()->save($comment1);

        $comment2 = new Comment;
        $comment2->content = "Looks great!";
        $comment2->date_time_posted = "2021-12-11 18:20:01";
        $strongAppleId = UserProfile::find(2)->id;
        $comment2->user_profile_id = $strongAppleId;
        Post::find(1)->comments()->save($comment2);

        // Create random numbers of comments by random users for each post
        $posts = Post::get();
        $profiles = UserProfile::get();
        foreach ($posts as $post) {
            $numCommenters = rand(0, 5);
            $commenters = $profiles->random($numCommenters);

            foreach ($commenters as $commenter) {
                $commenterId = $commenter->id;
                $numComments = rand(1, 3);
                Comment::factory()->count($numComments)->for($post)
                    ->create(['user_profile_id' => $commenterId,]);
            }
        }
    }
}
