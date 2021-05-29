<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('role_id');
            $table->string('name');
            $table->string('lname')->nullable();
            $table->string('username')->unique();
            $table->text('user_dsc')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('email_verification_token')->nullable();
            $table->string('mobile')->unique();
            $table->timestamp('mobile_verified_at')->nullable();
            $table->string('mobile_verification_token')->nullable();
            $table->string('password');
            $table->string('provider', 15)->nullable();
            $table->string('provider_id', 255)->nullable();
            $table->decimal('wallet_balance')->default(0.00);
            $table->integer('gender')->nullable();
            $table->string('blood', 15)->nullable();
            $table->date('birthday')->nullable();
            $table->string('photo', 225)->nullable();
            $table->timestamp('last_login')->nullable();
            $table->tinyInteger('created_by')->nullable();
            $table->tinyInteger('status');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
