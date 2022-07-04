<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBlogAddress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_address', function (Blueprint $table) {
            $table->id('blog_address_id');
            $table->bigInteger('id_user')->unsigned();
            $table->bigInteger('address_id')->unsigned();
            $table->unsignedInteger('blog_address_vote');
            $table->string('blog_address_image');
            $table->longText('blog_address_content');
            $table->foreign('id_user')->references('id')->on('user_travel');
            $table->foreign('address_id')->references('address_id')->on('address');
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
        Schema::dropIfExists('blog_address');
    }
}
