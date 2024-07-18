<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpressionOfInterestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expression_of_interest', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email');
            $table->string('dial_code')->nullable();
            $table->string('mobile')->nullable();
            $table->string('current_occupation')->nullable();
            $table->string('highest_qualifications')->nullable();
            $table->string('relevant_experience')->nullable();
            $table->string('languages')->nullable();
            $table->string('upload_cv')->nullable();
            $table->string('linkedin_profile')->nullable();
            $table->string('tell_us_more_about_yourself_and_why_you_would_like_to_join_TYHO')->nullable();
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
        Schema::dropIfExists('expression_of_interest');
    }
}
