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
        Schema::create('idea_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idea_id');
            $table->foreignId('user_id');
            $table->text('description');
            $table->timestamps();

            /** constraints */
            $table->unique(['idea_id', 'user_id']);     // qac can only report once per idea
            $table->foreign('idea_id')->references('id')->on('ideas')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('idea_reports');
    }
};
