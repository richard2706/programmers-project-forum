<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("content", 500);
            $table->unsignedBigInteger("user_profile_id");
            $table->unsignedInteger("upvotes");
            $table->dateTime("date_time_posted"); // YYYY-MM-DD HH:MM:SS
            $table->string("project_link")->nullable();
            $table->string("image_link")->nullable();
            $table->timestamps();

            $table->foreign("user_profile_id")->references("id")->on("user_profiles")
                ->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
