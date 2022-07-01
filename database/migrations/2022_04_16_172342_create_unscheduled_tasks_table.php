<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnscheduledTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unscheduled_tasks', function (Blueprint $table) {
            $table->id();

            $table->string('plate');
            $table->decimal('price');
            $table->longText('stocktaking')->nullable();
            $table->dateTime('finished');
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->unsignedBigInteger('yardManager_id')->nullable();
            $table->unsignedBigInteger('servicio_id')->nullable(); 
            $table->unsignedBigInteger('type_id')->nullable(); 

            $table->foreign('employee_id')
                    ->references('id')->on('users')
                    ->onDelete('set null');

            $table->foreign('yardManager_id')
                    ->references('id')->on('users')
                    ->onDelete('set null');

            $table->foreign('servicio_id')
                    ->references('id')->on('services')
                    ->onDelete('set null');

            $table->foreign('type_id')
                    ->references('id')->on('types')
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
        Schema::dropIfExists('unscheduled_tasks');
    }
}
