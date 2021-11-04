<?php

namespace Database\Seeders;

use App\Models\UserProfile;
use Illuminate\Database\Seeder;

class UserProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = new UserProfile;
        $user1->username = "coolKiwi";
        $user1->user_type = "standard";
        $user1->registration_date = "2021-11-01";
        $user1->birthday = "1999-02-10";
        $user1->description = "I love kiwis!";
        $user1->save();

        $user2 = new UserProfile;
        $user2->username = "Strong Apple";
        $user2->user_type = "admin";
        $user2->registration_date = "2021-10-20";
        $user2->save();
    }
}
