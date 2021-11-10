<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendas', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->date('start_date');
            $table->date('end_date');
            // $table->time('start_hour');
            // $table->time('end_hour');
            $table->unsignedBigInteger('horario_id')->nullable( );
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('admin_id')->nullable();

            $table->foreign('horario_id')
                    ->references('id')->on('horarios')
                    ->onDelete('set null');

            $table->foreign('employee_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade');

            $table->foreign('admin_id')
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
        Schema::dropIfExists('agendas');
    }
}
