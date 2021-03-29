<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_attachments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('news_id');
            $table->text('source_path');
            $table->foreign('news_id')->references('id')->on('news')->onDelete('cascade');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news_attachments');
    }
}
