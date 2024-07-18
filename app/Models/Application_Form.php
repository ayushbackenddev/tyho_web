<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Application_Form extends Model {
	use HasFactory;

	protected $table = "applications";

	protected $fillable = [
		'id',
		'expression_id_fk',
		'first_name',
		'middle_name',
		'last_name',
		'email',
		'country_of_residence',
		'city_of_residence',
		'gender',
		'occupation',
		'occupation_other',
		'languages_spoken',
		'length_of_experience',
		'areas_of_expertise_specialisation',
		'therapeutic_approaches',
		'current_last_place_of_work',
		'educational_qualifications',
		'professional_certifications',
		'professional_memberships',
		'work_with_any_specific_groups_of_people',
		'any_clients_that_you_prefer_not_to_work_with_for_personal_reason',
		'currently_under_supervision',
		'supervision_please_provide_details',
		'currently_have_any_professional_indemnity_insurance',
		'insurance_please_provide_details',
		'services_are_you_able_to_provide',
		'medium_are_you_able_to_use_for_counselling',
		'approximate_availability',
		'days',
		'timeslots',
		'mood_regulation',
		'family_and_relationships',
		'academic_or_work_related',
		'personal',
		'other',
		'anything_else',
	];

	protected $primaryKey = "id";

	protected $hidden = [
		'password',
		'remember_token',
	];

	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	public function showExpressionById($id) {
		$expression = DB::table('expression_of_interest')->select('id', 'first_name', 'last_name', 'expression_email', )->where('id', $id)->first();

		if (isset($expression) == false) {
			return false;
		} else {
			return $expression;
		}
	}

	public function getIssues() {
		$issues = DB::select("SELECT id, category_name, name FROM `category` WHERE status = 1");

		if ($issues == false) {
			return false;
		} else {
			return $issues;
		}

	}
}
