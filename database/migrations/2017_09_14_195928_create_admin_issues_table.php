<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_issues', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category');
            $table->dateTime('fixTime');
            $table->string('name');
            $table->string('title');
            $table->string('content')->nullable();
            $table->string('image')->nullable();
            $table->string('status');
            $table->string('memo')->nullable();
            $table->string('file')->nullable();
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
        Schema::dropIfExists('admin_issues');
    }
}
