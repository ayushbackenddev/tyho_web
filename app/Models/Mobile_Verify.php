<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Mobile_Verify extends Model {
	use HasFactory;

	protected $table = "mobile_verification";

	protected $fillable = [
		'id',
		'dial_code',
		'mobile_no',
		'otp',
		'otp_verify_time',
	];

	protected $primaryKey = "id";

	protected $hidden = [
		'password',
		'remember_token',
	];

	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	public function verifyOTP($mobile_no, $otp) {
		$data = DB::table('mobile_verification')->select('mobile_no', 'otp')->where('mobile_no', $mobile_no)->where('otp', $otp)->get();

		if (count($data) == 0) {
			return false;
		} else {
			return $data;
		}
	}

	public function OnboardingOTPverify($mobile_no, $otp) {
		$verify = DB::table('mobile_verification')->select('mobile_no', 'otp')->where('mobile_no', $mobile_no)->where('otp', $otp)->get();

		if (count($verify) == 0) {
			return false;
		} else {
			return $verify;
		}
	}

	public function GetMoodRegulations() {
		$allIssues = DB::select("SELECT id, category_name, name FROM `category` WHERE status = 1");

		if ($allIssues == false) {
			return false;
		} else {
			return $allIssues;
		}

	}

	public function getLanguages() {
		$languages = DB::select("SELECT id, language_name FROM `languages` WHERE status = 1");

		if ($languages == false) {
			return false;
		} else {
			return $languages;
		}

	}

	public function getServices() {
		$services = DB::select("SELECT id, service FROM `services` WHERE status = 1");

		if ($services == false) {
			return false;
		} else {
			return $services;
		}

	}

	public function getMediums() {
		$mediums = DB::select("SELECT id, medium FROM `mediums` WHERE status = 1");

		if ($mediums == false) {
			return false;
		} else {
			return $mediums;
		}

	}

	public function getCountries() {
		$countries = DB::select("SELECT id, country FROM `countries` WHERE status = 1");

		if ($countries == false) {
			return false;
		} else {
			return $countries;
		}

	}
}
