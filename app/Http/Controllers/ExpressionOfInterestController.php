<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Expression_Of_Interest;
use App\Models\Logs;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Response;
use Validator;

class ExpressionOfInterestController extends Controller {
	public function __construct(Expression_Of_Interest $expression) {
		$this->expression = $expression;
	}

	public function ExpressionOfInterest(Request $request) {
		$validator = Validator::make($request->all(),
			[
				'expression_first_name' => 'required|min:2|max:20',
				'expression_last_name' => 'required|min:2|max:20',
				'expression_email' => 'required|email|unique:expression_of_interest',
				'expression_phone' => 'required|min:6|max:15',
				'current_occupation' => 'required',
				'highest_qualifications' => 'required',
				'relevant_experience' => 'required',
				'languages' => 'required',
				'tell_us_more_about_yourself_and_why_you_would_like_to_join_TYHO' => 'required',
			]);

		$cv = "";

		if ($validator->fails()) {
			return response()->json(['status' => false, 'message' => $validator->errors()->first()], 200);
		}

		if (!$request->hasfile('upload_cv')) {

			$uploadCV = "";
		} else {
			$uploadCV = $request->file('upload_cv');
			$cvUpload = time() . $uploadCV->getClientOriginalName();
			$cv = 'cv/' . $cvUpload;
			Storage::disk('s3')->put($cv, file_get_contents($uploadCV), 'public');
		}

		if ($request->input('languages') == "") {
			$languageIdFK = null;
		} else {
			$languageIdFK = implode(",", $request->input('languages'));
		}

		$first_name = $request->input('expression_first_name');
		$last_name = $request->input('expression_last_name');
		$email = $request->input('expression_email');

		$expression = new Expression_Of_Interest();
		$expression->language_id_fk = $languageIdFK;
		$expression->first_name = $first_name;
		$expression->last_name = $last_name;
		$expression->expression_email = $email;
		$expression->dial_code = "+" . $request->input('dial_code');
		$expression->expression_phone = $request->input('expression_phone');
		$expression->current_occupation = $request->input('current_occupation');
		$expression->other_occupation = $request->input('other_occupation');
		$expression->highest_qualifications = $request->input('highest_qualifications');
		$expression->relevant_experience = $request->input('relevant_experience');
		$expression->upload_cv = $cv;
		$expression->linkedin_profile = $request->input('linkedin_profile');
		$expression->tell_us_more_about_yourself_and_why_you_would_like_to_join_TYHO = $request->input('tell_us_more_about_yourself_and_why_you_would_like_to_join_TYHO');
		$expression->save();

		$userIdFK = $expression->id;
		$userDate = $expression->created_at;

		$logData = new Logs();
		$logData->user_id_fk = $userIdFK;
		$logData->type = 'EOI Submitted';
		$logData->date = $userDate;
		$logData->save();

		$data = ['name' => $first_name . " " . $last_name, 'data' => "Thankyou for joining TYHO"];

		Mail::send('Website/Doctor/Mails/SendThankuMail', $data, function ($message) use ($email) {
			$message->to($email);
			$message->subject('EOI Submission');
			$message->from('tech@talkyourheartout.com', 'TYHO');
		});

		return response()->json([
			'status' => true,
			'message' => "Your expression of interest has been submitted.",
		], );
	}

	public function selectLanguages() {
		$getAllLanguages = DB::table('languages')->select('id', 'language_name')->where('status', '=', 1)->get();

		if ($getAllLanguages == "") {
			return response()->json([
				'status' => false,
				'message' => "Language is Empty",
			], );
		} else {
			return response()->json([
				'status' => true,
				'data' => $getAllLanguages,
			], );
		}
	}
}
