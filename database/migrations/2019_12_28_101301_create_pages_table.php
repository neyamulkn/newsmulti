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
            $table->id();
            $table->char('page_name_bd', 25);
            $table->char('page_name_en', 25);
            $table->char('page_slug', 25);
            $table->longText('page_dsc')->nullable();
            $table->tinyInteger('template')->nullable();
            $table->tinyInteger('menu')->nullable();
            $table->string('images')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('keywords')->nullable();
            $table->text('meta_tags')->nullable();
            $table->text('meta_description')->nullable();
            $table->tinyInteger('created_by')->nullable();
            $table->tinyInteger('is_default')->nullable();
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
