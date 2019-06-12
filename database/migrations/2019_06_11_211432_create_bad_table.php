<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bad', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bad_user_id')->unsigned()->index();
            $table->integer('card_id')->unsigned()->index();
            $table->timestamps();
            
            $table->foreign('bad_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('card_id')->references('id')->on('cards')->onDelete('cascade');
            
            $table->unique(['bad_user_id', 'card_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bad');
    }
}
