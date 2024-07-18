<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Application_Form;
use App\Models\Logs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use Validator;

class ApplicationController extends Controller {
	public function __construct(Application_Form $application) {
		$this->application = $application;
	}

	public function successApplicationForm() {
		return view('Website/Doctor/Application/applicationSuccess');
	}

	public function getApplicationForm($id) {

		$selectId = DB::select("SELECT `expression_id_fk` FROM `applications` WHERE expression_id_fk=" . $id);

		if ($selectId) {
			return view('Website/Doctor/Application/restrictApplication');
		} else {
			return view('Website/Doctor/application_form', ['id' => $id]);
		}
	}

	public function ApplicationForm(Request $request) {
		$validator = Validator::make($request->all(),
			[
				'first_name' => 'required|min:2|max:20',
				'email' => 'required|email',
				'country_of_residence' => 'required',
				'city_of_residence' => 'required',
				'gender' => 'required',
				'occupation' => 'required',
				'languages_spoken' => 'required',
				'services_provide' => 'required',
				'for_counselling' => 'required',
				// 'mood_regulation' => 'required',
				//'family_and_relationships' => 'required',
				//'academic_or_work_related' => 'required',
				//'personal' => 'required',

			]);

		if ($validator->fails()) {
			return response()->json(['status' => false, 'message' => $validator->errors()->first()], 200);
		}

		$expressionIdFK = $request->input('expression_id_fk');

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

		$application = new Application_Form();
		$application->expression_id_fk = $expressionIdFK;
		$application->language_id_fk = $languageIdFK;
		$application->first_name = $request->input('first_name');
		$application->middle_name = $request->input('middle_name');
		$application->last_name = $request->input('last_name');
		$application->email = $request->input('email');
		$application->country_of_residence = $request->input('country_of_residence');
		$application->city_of_residence = $request->input('city_of_residence');
		$application->gender = $request->input('gender');
		$application->occupation = $request->input('occupation');
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

		$userIdFK = $application->expression_id_fk;
		$userDate = $application->created_at;

		$logData = new Logs();
		$logData->user_id_fk = $userIdFK;
		$logData->type = 'Application Form Completed';
		$logData->date = $userDate;
		$logData->save();

		return response()->json([
			'status' => true,
			'message' => "Your application form has been submitted.",
		], );
	}

	public function ExpressionViewbyId(Request $request) {
		$id = $request->input('id');

		$Expressiondata = $this->application->showExpressionById($id);

		if ($Expressiondata == false) {
			return response()->json([
				'status' => false,
				'message' => "Data Empty",
			], );
		} else {
			return response()->json([
				'status' => true,
				'Expressiondata' => $Expressiondata,
			], );
		}
	}

	public function AllIssues(Request $request) {

		$issues = $this->application->getIssues();

		if ($issues == false) {
			return response()->json([
				'status' => false,
				'message' => "Data Empty",
			], );
		} else {
			$data = view('Website/Doctor/ApplicationIssues/application_issues', ['issues' => $issues])->render();

			return response()->json([
				'status' => true,
				'getissues' => $issues,
				'issues' => $data,
			], );
		}
	}
}
