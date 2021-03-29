<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomepageSectionItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homepage_section_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('section_id');
            $table->string('item_title')->nullable();
            $table->string('item_sub_title')->nullable();
            $table->integer('item_id')->nullable();
            $table->string('category_id')->nullable();
            $table->string('subcategory_id')->nullable();
            $table->string('background_color')->default('#fff');
            $table->string('text_color')->default('#000');
            $table->integer('position')->default(0);
            $table->tinyInteger('is_feature')->default(0);
            $table->tinyInteger('approved')->default(1);
            $table->string('status', 10)->default('active');
            $table->foreign('section_id')->references('id')->on('homepage_sections')->onDelete('cascade');
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
        Schema::dropIfExists('homepage_section_items');
    }
}
