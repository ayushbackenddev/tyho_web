<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Intake extends Model {
	use HasFactory;

	protected $table = "intakes";

	protected $fillable = [
		'id',
		'user_id',
		'age',
		'gender',
		'country_of_residence',
		'city_of_residence',
		'name',
		'relationship',
		'dial_code',
		'mobile',
		'mood_regulation',
		'family_and_relationships',
		'academic_or_work_related',
		'personal',
		'other',
		'anything_else',
		'your_relationship_status',
		'if_yes_last_consulted',
		'if_yes_they_are_helping_you',
		'your_occupation',
		'highest_qualifications',
		'previously_had_any_sessions_with_anyone',
		'are_you_currently_consulting_with_anyone',
		'share_personal_and_professional_goals',
	];

	protected $primaryKey = "id";

	protected $hidden = [
		'password',
		'remember_token',
	];

	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	public function GetMoodRegulations() {
		$issuesMoodRegulation = DB::select("SELECT id, category_name, name FROM `category`");

		if ($issuesMoodRegulation == false) {
			return false;
		} else {
			return $issuesMoodRegulation;
		}

	}
}
