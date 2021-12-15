<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained()
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('user_profile_id')->constrained()
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->text("content");
            $table->dateTime("date_time_posted"); // YYYY-MM-DD HH:MM:SS
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
