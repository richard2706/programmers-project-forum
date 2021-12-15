<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
        $user1->password = Hash::make("pass1");
        $user1->save();

        $user2 = new User();
        $user2->name = "John";
        $user2->email = "john123@example.com";
        $user2->password = Hash::make("letmein321");
        $user2->save();

        User::factory()->count(10)->create();
    }
}
