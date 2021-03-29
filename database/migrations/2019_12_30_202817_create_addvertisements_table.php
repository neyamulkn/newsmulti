<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addvertisements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('ads_name', 255)->nullable();
            $table->char('adsType', 25);
            $table->char('page', 25);
            $table->tinyInteger('position');
            $table->text('redirect_url')->nullable();
            $table->text('clickBtn')->nullable();
            $table->text('image')->nullable();
            $table->text('add_code')->nullable();
            $table->text('status');
            $table->tinyInteger('created_by')->nullable();
            $table->tinyInteger('updated_by')->nullable();
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
        Schema::dropIfExists('addvertisements');
    }
}
