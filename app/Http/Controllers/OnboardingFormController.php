<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Dropzone;
use App\Models\Logs;
use App\Models\Onboarding_Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Response;
use Validator;

class OnboardingFormController extends Controller {
	public function __construct(Onboarding_Form $onBoarding) {
		$this->onBoarding = $onBoarding;
	}

	public function successOnboardingForm() {
		return view('Website/Doctor/Onboarding/onboardingSuccess');
	}

	public function getOnboarding($id) {

		$selectId = DB::select("SELECT `expression_id_fk` FROM `onboardings` WHERE expression_id_fk=" . $id);

		if ($selectId) {
			return view('Website/Doctor/Onboarding/restrictOnboarding');
		} else {
			return view('Website/Doctor/onboarding', ['id' => $id]);
		}
	}

	public function OnBoardingForm(Request $request) {
		$validator = Validator::make($request->all(),
			[
				'mobile' => 'required|min:6|max:15',
				'otp' => 'required',
				'image' => 'required',
				'videos' => 'required',
				'profile_description' => 'required',
				'select_preferred_notice_period_for_new_booking' => 'required',
				'email_notifications' => 'required',
			]);

		$DzImages = "";
		$DzVideo = "";

		if ($validator->fails()) {
			return response()->json(['status' => false, 'message' => $validator->errors()->first()], 200);
		}

		$email_notification = $request->input('email_notifications');

		if ($email_notification == "") {
			$email_notification = "";
		} else {
			$email_notification = implode(",", $request->input('email_notifications'));
		}

		$expressionIdFK = $request->input('expression_id_fk');

		$onBoarding = new Onboarding_Form();
		$onBoarding->expression_id_fk = $expressionIdFK;
		$onBoarding->dial_code = "+" . $request->input('dial_code');
		$onBoarding->mobile = $request->input('mobile');
		$onBoarding->otp = $request->input('otp');

		$onBoarding->profile_description = $request->input('profile_description');
		$onBoarding->select_preferred_notice_period_for_new_booking = $request->input('select_preferred_notice_period_for_new_booking');
		$onBoarding->email_notifications = $email_notification;
		$onBoarding->save();

		$broadcastID = $onBoarding->expression_id_fk;
		$onBoardingID = $onBoarding->id;
		$userDate = $onBoarding->created_at;

		$logData = new Logs();
		$logData->user_id_fk = $broadcastID;
		$logData->type = 'Onboarding Form Completed';
		$logData->date = $userDate;
		$logData->save();

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
				$address->onboarding_id = $broadcastID;
				$address->save();
			}
		}

		$images = $request->file('image');

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

		$videos = $request->file('videos');

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

		return response()->json([
			'status' => true,
			'message' => "Your onboarding form has been submitted.",
		], );

	}

	public function ApplicationViewbyId(Request $request) {
		$id = $request->input('id');

		$applicationData = $this->onBoarding->showApplicationById($id);

		if ($applicationData == false) {
			return response()->json([
				'status' => false,
				'message' => "Data Empty",
			], );
		} else {
			$data = view('Website/Doctor/Onboarding/application_view', ['applicationData' => $applicationData])->render();

			return response()->json([
				'status' => true,
				'applicationData' => $data,
				'data' => $applicationData,
			], );
		}
	}
}
