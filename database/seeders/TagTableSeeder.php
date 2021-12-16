<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tag1 = new Tag;
        $tag1->name = "Web App";
        $tag1->save();

        $tag2 = new Tag;
        $tag2->name = "Medical";
        $tag2->save();

        $tag3 = new Tag;
        $tag3->name = "Engineering";
        $tag3->save();
    }
}
