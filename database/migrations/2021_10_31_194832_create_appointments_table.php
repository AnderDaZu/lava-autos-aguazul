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
            $table->time('hour');
            $table->unsignedBigInteger('agenda_id')->nullable();
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('vehicle_id');
        //     $table->unsignedBigInteger('employee_id')->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('state_id')->nullable();

            $table->foreign('agenda_id')
                    ->references('id')->on('agendas')
                    ->onDelete('set null');
            $table->foreign('service_id')
                    ->references('id')->on('services')
                    ->onDelete('cascade');
            $table->foreign('vehicle_id')
                    ->references('id')->on('vehicles')
                    ->onDelete('cascade');
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
