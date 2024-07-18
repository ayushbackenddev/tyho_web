<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntakesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intakes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('age')->nullable();
            $table->string('gender')->nullable();
            $table->string('country_of_residence')->nullable();
            $table->string('city_of_residence')->nullable();
            $table->string('name')->nullable();
            $table->string('relationship')->nullable();
            $table->string('dial_code')->nullable();
            $table->string('mobile')->nullable();
            $table->string('mood_regulation')->nullable();
            $table->string('family_and_relationships')->nullable();
            $table->string('academic_or_work_related')->nullable();
            $table->string('personal')->nullable();
            $table->string('other')->nullable();
            $table->string('anything_else')->nullable();
            $table->string('your_relationship_status')->nullable();
            $table->string('your_occupation')->nullable();
            $table->string('highest_qualifications')->nullable();
            $table->string('previously_had_any_sessions_with_anyone')->nullable();
            $table->string('are_you_currently_consulting_with_anyone')->nullable();
            $table->string('share_personal_and_professional_goals')->nullable();
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
        Schema::dropIfExists('intakes');
    }
}
