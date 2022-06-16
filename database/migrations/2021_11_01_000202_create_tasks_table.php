<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() 
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();

            $table->decimal('price');
            $table->longText('stocktaking');
            $table->dateTime('started');
            $table->dateTime('finished')->nullable();
            $table->unsignedBigInteger('appointment_id');
            $table->unsignedBigInteger('yardManager_id')->nullable();

            $table->foreign('appointment_id')
                    ->references('id')->on('appointments')
                    ->onDelete('cascade');
            $table->foreign('yardManager_id')
                    ->references('id')->on('users')
                    ->onDelete('set null');

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
        Schema::dropIfExists('tasks');
    }
}
