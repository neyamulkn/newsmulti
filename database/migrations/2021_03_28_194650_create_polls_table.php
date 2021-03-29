<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polls', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('question_title');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('bg_color')->nullable();
            $table->string('text_color')->nullable();
            $table->tinyInteger('login_status')->default(0);
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
        Schema::dropIfExists('polls');
    }
}
