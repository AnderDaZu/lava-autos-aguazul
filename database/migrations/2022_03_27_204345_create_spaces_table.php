<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spaces', function (Blueprint $table) {
            $table->id();

            $table->time('start_hour');
            $table->time('end_hour');
            $table->integer('group');
            $table->unsignedBigInteger('horario_id')->nullable();
            $table->unsignedBigInteger('duration_id')->nullable();
            $table->smallInteger('times_taken');
            
            $table->foreign('duration_id')
                    ->references('id')->on('durations')
                    ->onDelete('set null');
            
            $table->foreign('horario_id')
                    ->references('id')->on('horarios')
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
        Schema::dropIfExists('spaces');
    }
}
