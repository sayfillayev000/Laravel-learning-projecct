<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{

    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('category_id')->constrained();
            $table->text('title');
            $table->text('short_content');
            $table->text('phone_number');
            $table->text('content');
            $table->string('photo')->nullable();
            $table->timestamps();
            // $table->softDeletes();
        });
    }
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
