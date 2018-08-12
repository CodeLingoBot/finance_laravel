<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserOauthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_oauths', function (Blueprint $table) {
            $table->increments('id');
            $table->string('provider', 20)->nullable(false);
            $table->string('uuid', 50)->nullable(false);
            $table->string('name', 255)->nullable(false);
            $table->string('email', 255)->nullable(false);
            $table->string('avatar', 255);
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('user_oauths');
    }
}
