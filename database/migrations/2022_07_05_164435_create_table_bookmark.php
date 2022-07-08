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
            $table->id('bookmark_id');
            $table->bigInteger('id_user')->unsigned();
            $table->bigInteger('address_id')->unsigned();
            $table->timestamps();

            $table->foreign('address_id')
                  ->references('address_id')->on('address' );
            $table->foreign('id_user')
                  ->references('id')->on('user_travel' );
            
        });
    }

    /**jj
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookmark');
    }
}
