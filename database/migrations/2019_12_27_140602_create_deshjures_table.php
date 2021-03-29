<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeshjuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deshjures', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('name_bd', 25);
            $table->char('name_en', 25);
            $table->char('slug_bd', 25);
            $table->char('slug_en', 25);
            $table->integer('parent_id');
            $table->integer('cat_type');
            $table->integer('serial')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('deshjures');
    }
}
