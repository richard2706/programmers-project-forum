<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;

class UserProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profile1 = new UserProfile;
        $profile1->username = "coolKiwi";
        $profile1->user_type = "standard";
        $profile1->registration_date = "2021-11-01";
        $profile1->birthday = "1999-02-10";
        $profile1->description = "I love kiwis!";
        User::find(1)->userProfile()->save($profile1);
        
        $profile2 = new UserProfile;
        $profile2->username = "Strong Apple";
        $profile2->user_type = "admin";
        $profile2->registration_date = "2021-10-20";
        User::find(2)->userProfile()->save($profile2);

        $existingUserIds = [1, 2];
        $users = User::get()->except($existingUserIds);
        foreach ($users as $user) {
            UserProfile::factory()->for($user)->create();
        }

        // // Create a random number of posts for each user
        // $numUsers = 15;
        // for ($i=0; $i < $numUsers; $i++) { 
        //     $numPosts = rand(0, 3);
        //     UserProfile::factory()->count(1)->hasPosts($numPosts)->create();
        // }
    }
}
