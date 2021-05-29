<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media_galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->char('source_path', 125)->nullable();
            $table->char('video_link', 255)->nullable();
            $table->char('site_name', 255)->nullable()->comment('youtube, vimeo');
            $table->tinyInteger('type')->comment('imgage = 1, video');
            $table->integer('user_id');
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
        Schema::dropIfExists('media_galleries');
    }
}
