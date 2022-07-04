<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableGroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group', function (Blueprint $table) {
            $table->id('group_id');
            $table->string('group_name')->unique();
            $table->string('group_image')->nullable();
            $table->bigInteger('address_id')->unsigned();
            $table->bigInteger('group_admin')->unsigned();
            $table->string('group_member');
            $table->timestamps();

            $table->foreign('address_id','group_admin')
                ->references('address_id','id')->on('address','user_travel')
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
        Schema::dropIfExists('group');
    }
}
