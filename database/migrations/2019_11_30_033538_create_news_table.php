<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('news_title');
            $table->text('news_slug');
            $table->longText('news_dsc')->nullable();
            $table->integer('category');
            $table->integer('subcategory')->nullable();
            $table->integer('user_id');
            $table->dateTime('publish_date')->nullable();
            $table->char('thumb_image', 25)->default('thumb_image.jpg');
            $table->tinyInteger('lang');
            $table->tinyInteger('type');
            $table->text('attach_files')->nullable();
            $table->text('keywords')->nullable();
            $table->tinyInteger('update_user')->nullable();
            $table->tinyInteger('breaking_news')->nullable();
            $table->tinyInteger('district_news')->nullable();
            $table->tinyInteger('schedule_news')->nullable();
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
        Schema::dropIfExists('news');
    }
}
