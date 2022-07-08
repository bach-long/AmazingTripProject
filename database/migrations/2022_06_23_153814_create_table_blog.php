<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBlog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog', function (Blueprint $table) {
            $table->id('blog_id');
            $table->bigInteger('id_user')->unsigned();
            $table->bigInteger('group_id')->unsigned();
            $table->string('blog_title')->nullable();
            $table->string('blog_image')->nullable();
            $table->longText('blog_content')->notnull();
            $table->timestamps();

            $table->foreign('id_user')
                  ->references('id')->on('user_travel')
                  ->onDelete('CASCADE')
                  ->onUpdate('CASCADE');

            $table->foreign('group_id')
                  ->references('group_id')->on('group')
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
        Schema::dropIfExists('blog');
    }
}
