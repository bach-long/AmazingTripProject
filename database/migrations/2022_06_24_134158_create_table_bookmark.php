<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBookmark extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookmark', function (Blueprint $table) {
//            $table->id('bookmark_id');
//            $table->bigInteger('address_id')->unsigned();
//            $table->bigInteger('id_user')->unsigned();
//            $table->timestamps();
//
//            $table->foreign('address_id','id_user')
//                  ->references('address_id','id')->on('address','user_travel' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookmark');
    }
}
