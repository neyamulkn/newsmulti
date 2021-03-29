<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('title', '255');
            $table->text('header_text')->nullable();
            $table->char('language', 6)->nullable();
            $table->char('logo', 50)->nullable();
            $table->text('footer')->nullable();
            $table->char('date_format', 25)->nullable();
            $table->tinyInteger('status');
            $table->tinyInteger('updated_by');
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
        Schema::dropIfExists('settings');
    }
}
