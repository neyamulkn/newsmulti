<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reporters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('user_id');
            $table->char('designation', 25)->nullable();
            $table->char('father_name', 35)->nullable();
            $table->char('mother_name', 35)->nullable();
            $table->char('present_address', 255)->nullable();
            $table->char('permanent_address', 255)->nullable();
            $table->date('appointed_date')->nullable();
            $table->bigInteger('national_id')->nullable();
            $table->char('profession', 125)->nullable();
            $table->char('resume', 125)->nullable();
            $table->char('status', 125)->nullable();
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
        Schema::dropIfExists('reporters');
    }
}
