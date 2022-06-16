<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->text('extract');
            $table->longText('body');
            $table->string('url_image');
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->unsignedBigInteger('service_id')->nullable();

            $table->foreign('admin_id')
                    ->references('id')->on('users')
                    ->onDelete('set null');

            $table->foreign('service_id')
                    ->references('id')->on('services')
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
        Schema::dropIfExists('posts');
    }
}
