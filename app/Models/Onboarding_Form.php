<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Onboarding_Form extends Model {
	use HasFactory;

	protected $table = "onboardings";

	protected $fillable = [
		'id',
		'expression_id_fk',
		'dial_code',
		'mobile',
		'otp',
		'photos',
		'video',
		'profile_description',
		'select_preferred_notice_period_for_new_booking',
		'email_notifications',
	];

	protected $primaryKey = "id";

	protected $hidden = [
		'password',
		'remember_token',
	];

	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	public function showApplicationById($expression_id_fk) {
		$application = DB::table('applications')->select('applications.id', 'expression_id_fk', 'first_name', 'middle_name', 'last_name', 'email', 'tbl_countries.name AS country_of_residence', 'city_of_residence', 'gender', 'occupation', 'occupation_other', 'language_id_fk', 'length_of_experience', 'areas_of_expertise_specialisation', 'therapeutic_approaches', 'current_last_place_of_work', 'educational_qualifications', 'professional_certifications', 'professional_memberships', 'work_with_any_specific_groups_of_people', 'any_clients_that_you_prefer_not_to_work_with_for_personal_reason', 'currently_under_supervision', 'supervision_please_provide_details', 'currently_have_any_professional_indemnity_insurance', 'insurance_please_provide_details', 'services_are_you_able_to_provide', 'medium_are_you_able_to_use_for_counselling', 'approximate_availability', 'days', 'timeslots', 'mood_regulation', 'family_and_relationships', 'academic_or_work_related', 'personal', 'other', 'anything_else')
			->leftjoin('tbl_countries', 'applications.country_of_residence', '=', 'tbl_countries.id')
			->where('expression_id_fk', $expression_id_fk)->first();

		if (isset($application) == false) {
			return false;
		} else {
			return $application;
		}
	}
}
