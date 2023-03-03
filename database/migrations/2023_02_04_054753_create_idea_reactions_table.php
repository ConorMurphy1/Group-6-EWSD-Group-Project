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
        Schema::create('idea_reactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('idea_id');
            $table->string('reaction');
            $table->timestamps();

            /** constraints */
            $table->unique(['user_id', 'idea_id']);       // user can't react to more than 1 reaction to each idea
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('idea_id')->references('id')->on('ideas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('idea_reactions');
    }
};
