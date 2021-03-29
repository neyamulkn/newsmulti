<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('subcategory_bd', 25);
            $table->string('subcat_slug_bd', 25);
            $table->string('subcategory_en', 25);
            $table->string('subcat_slug_en', 25);
            $table->integer('category_id');
            $table->integer('creator_id');
            $table->integer('editor_id')->nullable();
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
        Schema::dropIfExists('sub_categories');
    }
}
