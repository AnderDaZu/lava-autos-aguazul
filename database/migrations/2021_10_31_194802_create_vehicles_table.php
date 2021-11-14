<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();

            $table->string('plate');
            $table->unsignedBigInteger('color_id')->nullable();
            $table->unsignedBigInteger('modelcar_id')->nullable();
            $table->unsignedBigInteger('client_id')->nullable();

            $table->foreign('color_id')
                    ->references('id')->on('colors')
                    ->onDelete('set null');
            
            $table->foreign('modelcar_id')
                    ->references('id')->on('modelcars')
                    ->onDelete('set null');
                    
            $table->foreign('client_id')
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
        Schema::dropIfExists('vehicles');
    }
}
