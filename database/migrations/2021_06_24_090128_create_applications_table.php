<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email');
            $table->string('country_of_residence')->nullable();
            $table->string('city_of_residence')->nullable();
            $table->string('gender')->nullable();
            $table->string('occupation')->nullable();
            $table->string('occupation_other')->nullable();
            $table->string('languages_spoken')->nullable();
            $table->string('length_of_experience')->nullable();
            $table->string('areas_of_expertise_specialisation')->nullable();
            $table->string('therapeutic_approaches')->nullable();
            $table->string('current_last_place_of_work')->nullable();
            $table->string('educational_qualifications')->nullable();
            $table->string('professional_certifications')->nullable();
            $table->string('professional_memberships')->nullable();
            $table->string('work_with_any_specific_groups_of_people?')->nullable();
            $table->string('any_clients_that_you_prefer_not_to_work_with_for_personal_reasons?')->nullable();
            $table->string('currently_under_supervision?')->nullable();
            $table->string('supervision_please_provide_details')->nullable();
            $table->string('currently_have_any_professional_indemnity_insurance?')->nullable();
            $table->string('insurance_please_provide_details')->nullable();
            $table->string('services_are_you_able_to_provide?')->nullable();
            $table->string('medium_are_you_able_to_use_for_counselling?')->nullable();
            $table->string('approximate_availability')->nullable();
            $table->string('days')->nullable();
            $table->string('timeslots')->nullable();
            $table->string('mood_regulation')->nullable();
            $table->string('family_and_relationships')->nullable();
            $table->string('academic_or_work_related')->nullable();
            $table->string('personal')->nullable();
            $table->string('other')->nullable();
            $table->string('anything_else')->nullable();
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
        Schema::dropIfExists('applications');
    }
}
