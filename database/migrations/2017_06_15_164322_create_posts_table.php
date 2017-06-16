<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string("image");

            $table->integer('user_id')->unsigned();

            $table->foreign("user_id")
                ->on("users")
                ->references("id")
                ->onDelete("cascade");

            $table->integer('category_id')->unsigned();

            $table->foreign("category_id")
                ->on("categories")
                ->references("id")
                ->onDelete("cascade");

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
        Schema::dropIfExists('posts');
    }
}
