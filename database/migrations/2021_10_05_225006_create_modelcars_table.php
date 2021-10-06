<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelcarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modelcars', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('mark_id');
            $table->unsignedBigInteger('type_id')->nullable();
            $table->timestamps();

            $table->foreign('mark_id')
                ->references('id')->on('marks')
                ->onDelete('cascade');

            $table->foreign('type_id')
                ->references('id')->on('types')
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
        Schema::dropIfExists('modelcars');
    }
}
