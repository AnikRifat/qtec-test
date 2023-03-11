<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSearchHistoryTable extends Migration
{
    public function up()
    {
        Schema::create('user_search_history', function (Blueprint $table) {
            $table->id();
            $table->string('keyword');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->dateTime('search_time');
            $table->json('search_results')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_search_history');
    }
}
