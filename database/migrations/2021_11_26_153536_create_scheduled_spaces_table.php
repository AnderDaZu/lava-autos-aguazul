<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduledSpacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scheduled_spaces', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('num');
            $table->date('date');
            $table->unsignedBigInteger('range_id')->nullable();
            $table->unsignedBigInteger('appointment_id')->nullable();
            $table->timestamps();

            $table->foreign('range_id')
                ->references('id')->on('ranges')
                ->onDelete('set null');
            
            $table->foreign('appointment_id')
                ->references('id')->on('appointments')
                ->onDelete('set null');
        });
    } 

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scheduled_spaces');
    }
}
