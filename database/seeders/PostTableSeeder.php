<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
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
        $post1->date_time_posted = "2021-11-02 15:02:12";
        $coolKiwiUser = UserProfile::find(1);
        $coolKiwiUser->posts()->save($post1);
        Post::find(1)->tags()->attach(1);
        $post1->tags()->attach(2);

        $post2 = new Post;
        $post2->title = "Best Veggies Project";
        $post2->content = "All the best vegetables!";
        $post2->date_time_posted = "2021-10-27 08:32:14";
        $strongAppleUser = UserProfile::find(2);
        $strongAppleUser->posts()->save($post2);
        $post2->tags()->attach(2);
        $post2->tags()->attach(3);

        $post3 = new Post;
        $post3->title = "Xmas Veggies Project";
        $post3->content = "Some cool Christmas veggies!";
        $post3->date_time_posted = "2021-12-09 12:02:10";
        $strongAppleUser->posts()->save($post3);
        $post3->tags()->attach(1);

        // Create a random number of posts for each user profile
        $existingUserIds = [1, 2];
        $profiles = UserProfile::get()->except($existingUserIds);
        foreach ($profiles as $profile) {
            $numPosts = rand(0, 3);
            $newPosts = Post::factory()->count($numPosts)->for($profile)->create();
            
            // Attach some random tags
            foreach ($newPosts as $newPost) {
                $numTags = rand(0, 3);
                $randomTags = Tag::get()->random($numTags)->modelKeys();
                $newPost->tags()->attach($randomTags);
            }
        }
    }
}
