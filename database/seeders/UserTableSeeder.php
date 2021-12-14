<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = new User();
        $user1->name = 'Amanda';
        $user1->email = "amanda@mail.com";
        $user1->password = "pass1";
        $user1->save();

        $user2 = new User();
        $user2->name = "John";
        $user2->email = "john123@example.com";
        $user2->password = "letmein321";
        $user2->save();
    }
}
