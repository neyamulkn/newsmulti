<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomepageSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homepage_sections', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('sub_title')->nullable();
            $table->string('slug');
            $table->string('thumb_image')->nullable();
            $table->string('image_position', 10)->default('left');
            $table->string('section_type', 15)->comment('item,category,banner,adds');
            $table->string('display_type')->default('default')->comment('random,custom');
            $table->tinyInteger('section_box_desktop')->nullable();
            $table->tinyInteger('section_box_mobile')->nullable();
            $table->tinyInteger('section_number')->nullable();
            $table->string('layout', 25)->nullable();
            $table->string('layout_width', 8)->nullable();
            $table->string('background_color', 75)->default('#fff');
            $table->string('background_image', 255)->nullable();
            $table->string('text_color', 75)->default('#000');
            $table->integer('position')->nullable();
            $table->tinyInteger('is_default')->nullable();
            $table->tinyInteger('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('homepage_sections');
    }
}
