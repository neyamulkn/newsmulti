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
            $table->id();
            $table->integer('user_id');
            $table->text('news_title');
            $table->text('news_slug');
            $table->longText('news_dsc')->nullable();
            $table->integer('category');
            $table->integer('subcategory')->nullable();
            $table->integer('child_cat')->nullable();
            $table->integer('subchild_cat')->nullable();
            $table->timestamp('publish_date');
            $table->string('thumb_image', 255)->nullable();
            $table->string('lang', 6);
            $table->tinyInteger('type');
            $table->text('attach_files')->nullable();
            $table->tinyInteger('breaking_news')->nullable();
            $table->tinyInteger('feature_news')->nullable();
            $table->tinyInteger('district_news')->nullable();
            $table->tinyInteger('schedule_news')->nullable();
            $table->integer('impressions')->default(0);
            $table->integer('view_counts')->default(0);
            $table->text('meta_title')->nullable();
            $table->text('keywords')->nullable();
            $table->text('meta_tags')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('status', 10)->default('pending');
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
