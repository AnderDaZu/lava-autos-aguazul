<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();

            $table->date('date');
            $table->time('hour_start');
            $table->time('hour_end');

            $table->unsignedBigInteger('horario_id')->nullable();
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('vehicle_id');
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('state_id')->nullable();

            $table->foreign('horario_id')
                    ->references('id')->on('horarios')
                    ->onDelete('set null');
            $table->foreign('service_id')
                    ->references('id')->on('services')
                    ->onDelete('cascade');
            $table->foreign('vehicle_id')
                    ->references('id')->on('vehicles')
                    ->onDelete('cascade');
            $table->foreign('employee_id')
                    ->references('id')->on('users')
                    ->onDelete('set null');
            $table->foreign('client_id')
                    ->references('id')->on('users')
                    ->onDelete('set null');
            $table->foreign('state_id')
                    ->references('id')->on('states')
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
        Schema::dropIfExists('appointments');
    }
}
