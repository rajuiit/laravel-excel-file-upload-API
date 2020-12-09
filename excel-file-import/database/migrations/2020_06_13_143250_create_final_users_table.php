<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinalUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finalusers', function (Blueprint $table) {
            $table->bigInteger('id');
            $table->string('name', 200);
            $table->string('post_code');
            $table->string('phone_number')->unique();
            $table->timestamps(0);
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('finalusers');
    }
}
