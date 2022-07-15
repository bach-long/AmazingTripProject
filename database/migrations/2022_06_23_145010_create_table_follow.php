<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableFollow extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follow', function (Blueprint $table) {
            $table->id('follow_id');
            $table->bigInteger('follower')->unsigned();
            $table->bigInteger('being_folower')->unsigned();
            $table->unsignedInteger('follow_status')->default(0);  //0:unfollow 1: follow
            $table->timestamps();
            
            $table->foreign('follower')
                ->references('id')->on('user_travel')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
            $table->foreign('being_follower')
                ->references('id')->on('user_travel')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('follow');
    }
}
