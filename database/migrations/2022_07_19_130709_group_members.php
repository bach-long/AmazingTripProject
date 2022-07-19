<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GroupMembers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_members', function (Blueprint $table) {
            $table->id('group_members_id');
            $table->bigInteger('id_user')->unsigned();
            $table->bigInteger('group_id')->unsigned();
            $table->timestamps();
            $table->foreign('id_user')->references('id')->on('user_travel')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('group_id')->references('group_id')->on('group')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('group_members');
    }
}
