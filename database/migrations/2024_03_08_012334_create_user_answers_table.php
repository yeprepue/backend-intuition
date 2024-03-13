<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_answers', function (Blueprint $table) {
            $table->id();

            // Define foreign key columns
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_question');

            // Define foreign key constraints
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_question')->references('id')->on('questions');
            $table->text('question_name');
            $table->text('answer');
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
        Schema::dropIfExists('user_answers');
    }
};
