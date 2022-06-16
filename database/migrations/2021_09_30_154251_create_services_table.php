<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price');
            $table->unsignedBigInteger('duration_id')->nullable();
            $table->unsignedBigInteger('type_id');
            $table->timestamps();

            $table->foreign('duration_id')
                    ->references('id')->on('durations')
                    ->onDelete('set null');

            $table->foreign('type_id')
                    ->references('id')->on('types')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
