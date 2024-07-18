<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Intake;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use Validator;

class IntakeController extends Controller {
	public function __construct(Intake $intake) {
		$this->intake = $intake;
	}

	public function IntakeForm1(Request $request) {
		$validator = Validator::make($request->all(),
			[
				'age' => 'required',
				'gender' => 'required',
				'name' => 'required',
				'relationship' => 'required',
				'intake1_mobile_no' => 'required|min:6|max:15',
				// 'mood_regulation' => 'required',
				// 'family_and_relationships' => 'required',
				// 'academic_or_work_related' => 'required',
				// 'personal' => 'required',

			]);

		$moodRegulation = $request->input('mood_regulation');
		$family_and_relationships = $request->input('family_and_relationships');
		$academic_or_work_related = $request->input('academic_or_work_related');
		$personal = $request->input('personal');
		$other = $request->input('other');

		if ($moodRegulation == "") {
			$moodRegulation = "";
		} else {
			$moodRegulation = implode(",", $request->input('mood_regulation'));
		}

		if ($family_and_relationships == "") {
			$family_and_relationships = "";
		} else {
			$family_and_relationships = implode(",", $request->input('family_and_relationships'));
		}

		if ($academic_or_work_related == "") {
			$academic_or_work_related = "";
		} else {
			$academic_or_work_related = implode(",", $request->input('academic_or_work_related'));
		}

		if ($personal == "") {
			$personal = "";
		} else {
			$personal = implode(",", $request->input('personal'));
		}

		if ($other == "") {
			$other = "";
		} else {
			$other = implode(",", $request->input('other'));
		}

		$id = $request->input('id');

		$selectUserId = DB::select("SELECT `id` FROM `intakes` WHERE user_id =" . $id);

		if (count($selectUserId) == 0) {

			if ($validator->fails()) {
				return response()->json(['status' => false, 'message' => $validator->errors()->first()], 200);
			}

			$intake = new Intake();
			$intake->user_id = $id;
			$intake->age = $request->input('age');
			$intake->gender = $request->input('gender');
			$intake->country_of_residence = $request->input('country_of_residence');
			$intake->city_of_residence = $request->input('city_of_residence');
			$intake->name = $request->input('name');
			$intake->relationship = $request->input('relationship');
			$intake->dial_code = "+" . $request->input('dial_code');
			$intake->mobile = $request->input('intake1_mobile_no');
			$intake->mood_regulation = $moodRegulation;
			$intake->family_and_relationships = $family_and_relationships;
			$intake->academic_or_work_related = $academic_or_work_related;
			$intake->personal = $personal;
			$intake->other = $other;
			$intake->anything_else = $request->input('anything_else');
			$intake->your_relationship_status = $request->input('your_relationship_status');
			$intake->your_occupation = $request->input('your_occupation');
			$intake->highest_qualifications = $request->input('highest_qualifications');
			$intake->save();

			$userId = $intake->user_id;

			return response()->json([
				'status' => true,
				'message' => "Thank you for submitting page 1 of the intake form.",
				'user_id' => $userId,
			], );
		} else {

			if ($validator->fails()) {
				return response()->json(['status' => false, 'message' => $validator->errors()->first()], 200);
			}

			$intake = Intake::findOrFail($selectUserId[0]->id);
			$intake->user_id = $id;
			$intake->age = $request->input('age');
			$intake->gender = $request->input('gender');
			$intake->country_of_residence = $request->input('country_of_residence');
			$intake->city_of_residence = $request->input('city_of_residence');
			$intake->name = $request->input('name');
			$intake->relationship = $request->input('relationship');
			$intake->dial_code = "+" . $request->input('dial_code');
			$intake->mobile = $request->input('intake1_mobile_no');
			$intake->mood_regulation = $moodRegulation;
			$intake->family_and_relationships = $family_and_relationships;
			$intake->academic_or_work_related = $academic_or_work_related;
			$intake->personal = $personal;
			$intake->other = $other;
			$intake->anything_else = $request->input('anything_else');
			$intake->your_relationship_status = $request->input('your_relationship_status');
			$intake->your_occupation = $request->input('your_occupation');
			$intake->highest_qualifications = $request->input('highest_qualifications');
			$intake->save();

			$userId = $intake->user_id;

			return response()->json([
				'status' => true,
				'message' => "Thank you for updating page 1 of the intake form.",
				'user_id' => $userId,
			], );
		}
	}

	public function IntakeForm2(Request $request) {
		$validator = Validator::make($request->all(),
			[
				/*'previously_had_any_sessions_with_anyone' => 'required',
                'are_you_currently_consulting_with_anyone' => 'required',*/
				'share_personal_and_professional_goals' => 'required|max:100',
			]);

		if ($validator->fails()) {
			return response()->json(['status' => false, 'message' => $validator->errors()->first()], 200);
		}
		
		$previously_had_any_sessions_with_anyone = $request->input('previously_had_any_sessions_with_anyone') == null ? 0 : 1;

		if ($request->input('previously_had_any_sessions_with_anyone') == null) {
			$if_yes_last_consulted = "";
		} else {
			$if_yes_last_consulted = $request->input('previously_had_any_sessions_with_anyone');
		}

		$are_you_currently_consulting_with_anyone = $request->input('are_you_currently_consulting_with_anyone') == null ? 0 : 1;

		if ($request->input('are_you_currently_consulting_with_anyone') == null) {
			$if_yes_they_are_helping_you = "";
		} else {
			$if_yes_they_are_helping_you = $request->input('are_you_currently_consulting_with_anyone');
		}
		
		

		$share_personal_and_professional_goals = $request->input('share_personal_and_professional_goals');

		$userID = $request->input('id');

		$update = DB::update('update `intakes` set previously_had_any_sessions_with_anyone=?, are_you_currently_consulting_with_anyone=?, share_personal_and_professional_goals=?, if_yes_last_consulted=?, if_yes_they_are_helping_you=? where user_id=?', [$previously_had_any_sessions_with_anyone, $are_you_currently_consulting_with_anyone, $share_personal_and_professional_goals, $if_yes_they_are_helping_you , $if_yes_last_consulted  , $userID]);

		if ($update == true) {
			return response()->json([
				'status' => true,
				'message' => "Thank you for submitting the intake form.",
			], );
		} else {
			return response()->json([
				'status' => false,
				'message' => "Please complete all mandatory fields.",
			], );
		}
	}

	public function getAllIssues(Request $request) {

		$issuesMoodRegulation = $this->intake->GetMoodRegulations();

		if ($issuesMoodRegulation == false) {
			return response()->json([
				'status' => false,
				'message' => "Data Empty",
			], );
		} else {
			$data = view('Website/User/Issues/issues', ['issuesMoodRegulation' => $issuesMoodRegulation])->render();

			return response()->json([
				'status' => true,
				'getissues' => $issuesMoodRegulation,
				'issuesMoodRegulation' => $data,
			], );
		}
	}
}