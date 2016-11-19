<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invites', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('from_user_id')->unsigned()->nullable();
            $table->integer('to_user_id')->unsigned()->nullable();
            $table->string('key');
            $table->boolean('used')->default(false);
            $table->timestamps();


            $table->foreign('from_user_id')
                  ->references('id')
                  ->on('users');

            $table->foreign('to_user_id')
                  ->references('id')
                  ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('invites');
    }
}
