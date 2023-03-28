<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('role_entry', function (Blueprint $table) {
            $table->id();
            $table->string('role');
            $table->timestamps();
            $table->softDeletes();
        });

        // Insert some initial data
        DB::table('role_entry')->insert([
            [
                'role' => 'QA Manager',
               
            ],
            [
                'role' => 'QA Coordinator',
               
            ],
            [
                'role' => 'Admin',
                
            ],
            [
                'role' => 'Staff',
                
            ],
        ]);
    

    }

    
    public function down()
    {
        Schema::dropIfExists('role_entry');
    }
};
