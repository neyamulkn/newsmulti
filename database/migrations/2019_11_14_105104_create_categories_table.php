<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('category_bd', 25);
            $table->string('cat_slug_bd', 25);
            $table->string('category_en', 25);
            $table->string('cat_slug_en', 25);
            $table->integer('serial')->nullable();
            $table->integer('creator_id');
            $table->integer('editor_id')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('keywords')->nullable();
            $table->text('meta_tags')->nullable();
            $table->text('meta_description')->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('categories');
    }
}
