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
            $table->id();
            $table->integer('user_id');
            $table->string('designation', 25)->nullable();
            $table->string('profession', 125)->nullable();
            $table->string('father_name', 35)->nullable();
            $table->string('mother_name', 35)->nullable();
            $table->string('present_address', 255)->nullable();
            $table->integer('present_zilla')->nullable();
            $table->integer('present_upzilla')->nullable();
            $table->string('permanent_address', 255)->nullable();
            $table->integer('permanent_zilla')->nullable();
            $table->integer('permanent_upzilla')->nullable();
            $table->integer('working_zilla')->nullable();
            $table->integer('working_upzilla')->nullable();
            $table->date('appointed_date')->nullable();
            $table->string('emg_contact_name', 125)->nullable();
            $table->string('emg_contact_phone', 25)->nullable();
            $table->string('emg_contact_rel', 25)->nullable();
            $table->string('emg_contact_address', 255)->nullable();
            $table->bigInteger('national_id')->nullable();
            $table->string('national_attach')->nullable();
            $table->string('resume', 255)->nullable();
            $table->string('status', 15)->default('pending');
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
