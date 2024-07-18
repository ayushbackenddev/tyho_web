<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnboardingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('onboardings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('dial_code')->nullable();
            $table->string('mobile')->nullable();
            $table->string('otp')->nullable();
            $table->string('photos')->nullable();
            $table->string('video')->nullable();
            $table->string('profile_description')->nullable();
            $table->string('select_preferred_notice_period_for_new_booking')->nullable();
            $table->string('email_notifications')->nullable();

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
        Schema::dropIfExists('onboardings');
    }
}
