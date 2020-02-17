<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->bigInteger('creator_id')->unsigned();
            $table->bigInteger('category_id')->unsigned();
            $table->string('slug')->unique();
            $table->string('title');
            $table->text('excerpt')->nullable();
            $table->text('content');
            $table->string('coordinates')->nullable();
            $table->integer('users_count');
            $table->integer('users_limit');
            $table->string('auth_users_ids');
            $table->dateTime('event_date')->nullable();
            $table->string('status')->nullable();
            $table->string('messages_ids');

            $table->foreign('category_id')->references('id')->on('event_categories');
            $table->foreign('creator_id')->references('id')->on('users');
            $table->index('title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_posts');
    }
}
