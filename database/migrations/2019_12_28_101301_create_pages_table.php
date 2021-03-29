<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('page_name_bd', 25);
            $table->char('page_name_en', 25);
            $table->char('page_slug', 25);
            $table->longText('page_dsc');
            $table->tinyInteger('template');
            $table->tinyInteger('menu');
            $table->tinyInteger('creator_id');
            $table->char('images')->nullable();
            $table->tinyInteger('status');
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
        Schema::dropIfExists('pages');
    }
}
