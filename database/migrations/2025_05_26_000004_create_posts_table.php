<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('sub_title');
            $table->text('description')->nullable();
            $table->text('cover_image')->nullable();
            $table->text('content')->nullable();
            $table->integer('order')->nullable()->default(-1);
            $table->boolean('is_featured')->default(false);
            $table->foreignId('category_id')->constrained('post_categories')->onDelete('cascade');
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
};
