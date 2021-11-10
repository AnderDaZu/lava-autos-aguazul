<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('user_name');
            $table->string('name');
            $table->string('last_name');
            $table->date('birthdate')->nullable();
            $table->string('identification')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            // $table->unsignedBigInteger('horario_id')->nullable(); 
            $table->unsignedBigInteger('state_id')->nullable();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('set null');

            // $table->foreign('horario_id')
            //     ->references('id')->on('horarios')
            //     ->onDelete('set null');

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
        Schema::dropIfExists('users');
    }
}
