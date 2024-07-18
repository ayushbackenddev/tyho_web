<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expression_Of_Interest extends Model {
	use HasFactory;

	protected $table = "expression_of_interest";

	protected $fillable = [
		'id',
		'first_name',
		'last_name',
		'email',
		'dial_code',
		'mobile',
		'current_occupation',
		'other_occupation',
		'highest_qualifications',
		'relevant_experience',
		'upload_cv',
		'linkedin_profile',
		'tell_us_more_about_yourself_and_why_you_would_like_to_join_TYHO',
	];

	protected $primaryKey = "id";

	protected $hidden = [
		'password',
		'remember_token',
	];

	protected $casts = [
		'email_verified_at' => 'datetime',
	];
}
