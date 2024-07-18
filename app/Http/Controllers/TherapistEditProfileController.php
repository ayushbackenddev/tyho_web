<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application_Form;
use App\Models\Onboarding_Form;
use App\Models\Address;
use App\Models\User;
use App\Models\TherapistProfile;
use App\Models\Dropzone;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use File;
use Validator;
use App\Models\Mobile_Verify;

class TherapistEditProfileController extends Controller
{
	public function __construct(Mobile_Verify $mobile_verify) {
		$this->mobile_verify = $mobile_verify;
	}

    public function UpdateTherapistProfile(Request $request) {

    	/*----------Application Update----------*/

    	$therapistId = $request->session()->get('loggedTherapist');

    	$therapistApplicationId = DB::select("SELECT `id` FROM `applications` WHERE therapist_id_FK =" .$therapistId);

		if ($request->input('services_provide') == "") {
			$services_provide = null;
		} else {
			$services_provide = implode(",", $request->input('services_provide'));
		}

		if ($request->input('for_counselling') == "") {
			$for_counselling = null;
		} else {
			$for_counselling = implode(",", $request->input('for_counselling'));
		}

		if ($request->input('days') == "") {
			$days = null;
		} else {
			$days = implode(", ", $request->input('days'));
		}

		if ($request->input('timeslots') == "") {
			$timeslots = null;
		} else {
			$timeslots = implode(", ", $request->input('timeslots'));
		}

		if ($request->input('mood_regulation') == "") {
			$mood_regulation = null;
		} else {
			$mood_regulation = implode(",", $request->input('mood_regulation'));
		}

		if ($request->input('family_and_relationships') == "") {
			$family_and_relationships = null;
		} else {
			$family_and_relationships = implode(",", $request->input('family_and_relationships'));
		}

		if ($request->input('academic_or_work_related') == "") {
			$academic_or_work_related = null;
		} else {
			$academic_or_work_related = implode(",", $request->input('academic_or_work_related'));
		}

		if ($request->input('personal') == "") {
			$personal = null;
		} else {
			$personal = implode(",", $request->input('personal'));
		}

		if ($request->input('other') == "") {
			$other = null;
		} else {
			$other = implode(",", $request->input('other'));
		}

		if ($request->input('languages_spoken') == "") {
			$languageIdFK = null;
		} else {
			$languageIdFK = implode(",", $request->input('languages_spoken'));
		}

		$application = Application_Form::findOrFail($therapistApplicationId[0]->id);
		$application->language_id_fk = $languageIdFK;
		$application->first_name = $request->input('first_name');
		$application->middle_name = $request->input('middle_name');
		$application->last_name = $request->input('last_name');
		$application->country_of_residence = $request->input('country_of_residence');
		$application->city_of_residence = $request->input('city_of_residence');
		$application->gender = $request->input('gender');
		$application->occupation_other = $request->input('occupation_other');
		$application->length_of_experience = $request->input('length_of_experience');
		$application->areas_of_expertise_specialisation = $request->input('areas_of_expertise_specialisation');
		$application->therapeutic_approaches = $request->input('therapeutic_approaches');
		$application->current_last_place_of_work = $request->input('current_last_place_of_work');
		$application->educational_qualifications = $request->input('educational_qualifications');
		$application->professional_certifications = $request->input('professional_certifications');
		$application->professional_memberships = $request->input('professional_memberships');
		$application->work_with_any_specific_groups_of_people = $request->input('work_with_any_specific_groups_of_people');
		$application->any_clients_that_you_prefer_not_to_work_with_for_personal_reason = $request->input('any_clients_that_you_prefer_not_to_work_with_for_personal_reason');
		$application->currently_under_supervision = $request->input('currently_under_supervision');
		$application->supervision_please_provide_details = $request->input('supervision_please_provide_details');
		$application->currently_have_any_professional_indemnity_insurance = $request->input('currently_have_any_professional_indemnity_insurance');
		$application->insurance_please_provide_details = $request->input('insurance_please_provide_details');
		$application->services_are_you_able_to_provide = $services_provide;
		$application->medium_are_you_able_to_use_for_counselling = $for_counselling;
		$application->approximate_availability = $request->input('approximate_availability');
		$application->days = $days;
		$application->timeslots = $timeslots;
		$application->mood_regulation = $mood_regulation;
		$application->family_and_relationships = $family_and_relationships;
		$application->academic_or_work_related = $academic_or_work_related;
		$application->personal = $personal;
		$application->other = $other;
		$application->anything_else = $request->input('anything_else');
		$application->save();

		/*-----------Onboarding Update-----------*/

		$therapistOnboardingId = DB::select("SELECT `id` FROM `onboardings` WHERE therapist_id_FK =" .$therapistId);

		$onBoarding = Onboarding_Form::findOrFail($therapistOnboardingId[0]->id);
		$onBoarding->profile_description = $request->input('profile_description');
		$onBoarding->save();

		$onBoardingID = $onBoarding->id;
		
		DB::delete("DELETE FROM `therapist_address` WHERE onboarding_id =" . $onBoardingID);

		$addres = $request->input('address_title');
		$address1 = $request->input('address_line1');
		$address2 = $request->input('address_line2');
		$landmarks = $request->input('landmark');
		$cities = $request->input('city');
		$postal_codes = $request->input('postal_code');
		$countries = $request->input('country_id_fk');

		if ($addres != null) {
			for ($i = 0; $i < count($addres); $i++) {

				$address_title = $addres[$i];
				$address_line1 = $address1[$i];
				$address_line2 = $address2[$i];
				$landmark = $landmarks[$i];
				$city = $cities[$i];
				$postal_code = $postal_codes[$i];
				$country = $countries[$i];

				$address = new Address();
				$address->address_title = $address_title;
				$address->address_line1 = $address_line1;
				$address->address_line2 = $address_line2;
				$address->landmark = $landmark;
				$address->city = $city;
				$address->postal_code = $postal_code;
				$address->country_id_fk = $country;
				$address->onboarding_id = $onBoardingID;
				$address->save();
			}
		}

		$DzImages = "";
		$DzVideo = "";

		$images = $request->file('image');
		$videos = $request->file('videos');

		if ($images == "" || $videos == "") {

			$user = User::findOrFail($therapistId);
			$user->first_name = $request->input('first_name');
			$user->middle_name = $request->input('middle_name');
			$user->last_name = $request->input('last_name');
			$user->save();

			return response()->json([
				'status' => true,
				'message' => "Your profile form has been updated.",
			], );
		}
		else{

			for ($i = 0; $i < count($images); $i++) {

				$image = $images[$i];

				if (!$image) {

					$uploadImg = "";
				} else {
					$uploadImg = $image;
					$imagesUpload = time() . $uploadImg->getClientOriginalName();
					$DzImages = 'dropzoneMedia/' . $imagesUpload;
					Storage::disk('s3')->put($DzImages, file_get_contents($uploadImg), 'public');
				}

				$dropzone = new Dropzone();
				$dropzone->type = "image";
				$dropzone->media = $DzImages;
				$dropzone->onboarding_id_fk = $onBoardingID;
				$dropzone->save();
			}

			for ($i = 0; $i < count($videos); $i++) {

				$video = $videos[$i];

				if (!$video) {

					$uploadVideo = "";
				} else {
					$uploadVideo = $video;
					$videosUpload = time() . $uploadVideo->getClientOriginalName();
					$DzVideo = 'dropzoneMedia/' . $videosUpload;
					Storage::disk('s3')->put($DzVideo, file_get_contents($uploadVideo), 'public');
				}

				$dropzone = new Dropzone();
				$dropzone->type = "video";
				$dropzone->media = $DzVideo;
				$dropzone->onboarding_id_fk = $onBoardingID;
				$dropzone->save();
			}

			$user = User::findOrFail($therapistId);
			$user->first_name = $request->input('first_name');
			$user->middle_name = $request->input('middle_name');
			$user->last_name = $request->input('last_name');
			$user->save();

			return response()->json([
				'status' => true,
				'message' => "Your profile form has been updated.",
			], );
		}
	}

	public function ProfileUpdate(Request $request)
	{
		$therapistId = $request->session()->get('loggedTherapist');

		$therapistProfileId = DB::select("SELECT `id` FROM `therapist_details` WHERE therapist_id_FK =" .$therapistId);
		
		$therapist_profile = TherapistProfile::findOrFail($therapistProfileId[0]->id);
		$therapist_profile->notice_period_for_new_bookings = $request->input('notice_period_for_new_bookings');
		$therapist_profile->my_timezone = $request->input('my_timezone');
		$therapist_profile->taking_new_clients = $request->input('taking_new_clients');
		$therapist_profile->save();

		$therapistOnboardingId = DB::select("SELECT `id` FROM `onboardings` WHERE therapist_id_FK =" .$therapistId);

		$email_notification = $request->input('email_notifications');

		if ($email_notification == "") {
			$email_notification = "";
		} else {
			$email_notification = implode(",", $request->input('email_notifications'));
		}

		$onBoarding = Onboarding_Form::findOrFail($therapistOnboardingId[0]->id);
		$onBoarding->email_notifications = $email_notification;
		$onBoarding->save();

		return response()->json([
			'status' => true,
			'message' => "Your profile form has been updated.",
		], );
	}

	public function OTPsend(Request $request) {
		$validator = Validator::make($request->all(),
			[
				'mobile_no' => 'required|min:6|max:15',
			]);

		if ($validator->fails()) {
			return response()->json(['status' => false, 'message' => $validator->errors()->first()], 200);
		}

		$dial_code = "+" . $request->input('dial_code');

		$check = User::where('mobile_no', $request->input('mobile_no', ))->where('dial_code', $dial_code)->exists();

		if ($check) {
			return response()->json([
				'status' => false,
				'message' => "mobile number already exists",
			], );
		} else {

			$mobile_no = $request->input('mobile_no');
			$dial_code = "+" . $request->input('dial_code');
			$store = rand(1000, 9999);
			
			$mobile_verify = new Mobile_Verify();
			$mobile_verify->mobile_no = $mobile_no;
			$mobile_verify->dial_code = $dial_code;
			$mobile_verify->otp = $store;
			$mobile_verify->usertype = '3';
			$mobile_verify->save();

			return response()->json([
				'status' => true,
				'message' => "OTP has been successfully generated.",
				'otp' => $store,
			], );
		}
	}

	public function OTPverification(Request $request) {
		$validator = Validator::make($request->all(),
			[
				'mobile_no' => 'required|min:6|max:15',
				'otp' => 'required',
			]);

		if ($validator->fails()) {
			return response()->json(['status' => false, 'message' => $validator->errors()->first()], 200);
		}

		$mobile_no = $request->input('mobile_no');
		$otp = $request->input('otp');

		$data = $this->mobile_verify->verifyOTP($mobile_no, $otp);

		if ($data == false) {
			return response()->json([
				'status' => false,
				'message' => "OTP not verified",
			], );
		} else {
			return response()->json([
				'status' => true,
				'message' => "OTP has been verified.",
			], );
		}
	}

	public function UpdateTherapistProfileThird(Request $request)
	{
		$validator = Validator::make($request->all(),
			[
				'email' => 'required',
			]);

		if ($validator->fails()) {
			return response()->json(['status' => false, 'message' => $validator->errors()->first()], 200);
		}

		$therapistId = $request->session()->get('loggedTherapist');

		$user = User::findOrFail($therapistId);
		$user->mobile_no = $request->input('mobile_no');
		$user->otp = $request->input('otp');
		$user->email = $request->input('email');
		$user->save();

		return response()->json([
			'status' => true,
			'message' => "Your profile form has been updated.",
		], );
	}
}
