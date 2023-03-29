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
        Schema::create('ideas', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('image')->nullable();
            $table->text('description');
            $table->foreignId('user_id');
            $table->foreignId('department_id');
            $table->foreignId('event_id');
            $table->boolean('is_anonymous')->nullable();
            $table->boolean('is_edited')->default(0);
            $table->text('document')->nullable();
            $table->integer('views')->nullable();
            $table->softDeletes();
            $table->timestamps();

            /** constraints */
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ideas');
    }
};
