<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post1 = new Post;
        $post1->title = "Cool Fruits Project";
        $post1->content = "Look at this brilliant project I made!";
        $post1->upvotes = 3;
        $post1->date_time_posted = "04-11-02 15:02:12";
        $coolKiwiUser = UserProfile::find(1);
        $coolKiwiUser->posts()->save($post1);

        $post2 = new Post;
        $post2->title = "Best Veggies Project";
        $post2->content = "All the best vegetables!";
        $post2->upvotes = 1;
        $post2->date_time_posted = "04-10-27 08:32:14";
        $strongAppleUser = UserProfile::find(2);
        $strongAppleUser->posts()->save($post2);
    }
}
