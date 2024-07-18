<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Mobile_Verify;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use Session;
use Validator;

class UserController extends Controller {
	public function __construct(Mobile_Verify $mobile_verify) {
		$this->mobile_verify = $mobile_verify;
	}

	public function showUserlist() {
		$start = $_POST['start'];
		$length = $_POST['length'];
		$search = $_POST['search']["value"];

		if ($search != "") {
			$show = DB::select("SELECT users.id as id, CONCAT(users.first_name, ' ' ,users.last_name) AS name, intakes.gender as gender, intakes.country_of_residence as country, intakes.city_of_residence as city FROM users
				LEFT JOIN intakes on users.id = intakes.user_id
				WHERE usertype = 3 AND isDelete = 0 AND ( first_name LIKE '%" . $search . "%' OR last_name LIKE '%" . $search . "%') limit " . $start . "," . $length);

		} else {
			$show = DB::select("SELECT users.id as id, CONCAT(users.first_name, ' ' ,users.last_name) AS name, intakes.gender as gender, intakes.country_of_residence as country, intakes.city_of_residence as city FROM users
				LEFT JOIN intakes on users.id = intakes.user_id
				WHERE usertype = 3 AND isDelete = 0 limit " . $start . "," . $length);

		}

		// $arrayOfUserProfile = array();

		// foreach ($show as $key => $value) {
		// 	if ($value->signUpDate == "") {
		// 		$value->signUpDate = " ";
		// 	} else {
		// 		$value->signUpDate = Helper::getFormatedDateTimeForDatatable($value->signUpDate);
		// 	}

		// 	$arrayOfUserProfile[] = $value;
		// }

		$tableData['data'] = $show;
		$tableData['recordsTotal'] = count($show);

		$AllData = DB::select("SELECT users.id as id, CONCAT(users.first_name, ' ' ,users.last_name) AS name, intakes.gender as gender, intakes.country_of_residence as country, intakes.city_of_residence as city FROM users
				LEFT JOIN intakes on users.id = intakes.user_id
				WHERE usertype = 3 AND isDelete = 0");

		$tableData['recordsFiltered'] = count($AllData);

		return response()->json($tableData);
	}

/*For Calender slots*/
	public function getCalenderShowSlotPage(Request $request) {

		$date = $request->input('date');
		$therapist_id_fk = Session::get('loggedTherapist');

		$data = view('Website/Doctor/calender_slots', ['date' => $date, 'therapist_id_fk' => $therapist_id_fk])->render();

		return response()->json([
			'status' => true,
			'data' => $data,
		], );
	}

	public function getCalenderAddSlotPage(Request $request) {

		$date = $request->input('date');
		$therapist_id_fk = Session::get('loggedTherapist');

		$data = view('Website/Doctor/calender_add_slots', ['date' => $date, 'therapist_id_fk' => $therapist_id_fk])->render();

		return response()->json([
			'status' => true,
			'data' => $data,
		], );
	}

/*End of Calender slots*/

	public function ShowReg() {
		return view('Website/User/clientSignUp');
	}

	public function getSignUpForm(Request $request) {
		$data = view('Website/User/clientSignUp')->render();

		return response()->json([
			'status' => true,
			'data' => $data,
		], );
	}

	public function ShowLogin() {
		return view('Website/User/clientSignIn');
	}

	public function getSignInForm(Request $request) {
		$data = view('Website/User/clientSignIn')->render();

		return response()->json([
			'status' => true,
			'data' => $data,
		], );
	}

	public function ShowReset() {
		return view('Website/User/clientResetPassword');
	}

	public function getResetForm(Request $request) {
		$data = view('Website/User/clientResetPassword')->render();

		return response()->json([
			'status' => true,
			'data' => $data,
		], );
	}

	public function getDoctorsLogin() {
		if(session()->has('loggedUser'))
		{
			return redirect('/');
		}
		else{
			return view('Website/Doctor/therapistLogin');
		}
	}

	public function getDoctorsResetPassword() {
		return view('Website/Doctor/therapistResetPassword');
	}

	public function DoctorSetPassword($id) {
		return view('Website/Doctor/newPassword', ['id' => $id]);
	}

	public function getEmail() {
		return view('Website/User/emailVerify');
	}

	public function getExpression() {
		return view('Website/Doctor/expression-of-interest');
	}

	public function getIntake1($id) {

		return view('Website/User/intake-form1', ['id' => $id]);
	}

	public function getIntake2($id) {

		return view('Website/User/intake-form2', ['id' => $id]);
	}

	// For Registration Through Mobile No
	public function OTPsend(Request $request) {
		$validator = Validator::make($request->all(),
			[
				'signUp_mobile_no' => 'required|min:6|max:15',
			]);

		if ($validator->fails()) {
			return response()->json(['status' => false, 'message' => $validator->errors()->first()], 200);
		}

		$dial_code = "+" . $request->input('dial_code');

		$check = User::where('mobile_no', $request->input('signUp_mobile_no', ))->where('dial_code', $dial_code)->exists();

		if ($check) {
			return response()->json([
				'status' => false,
				'message' => "mobile number already exists",
			], );
		} else {

			$mobile_no = $request->input('signUp_mobile_no');
			$dial_code = "+" . $request->input('dial_code');
			$store = rand(1000, 9999);
			/*Cache::put([$store], now()->addSeconds(300));

				            $otp_expires_time = Mobile_Verify::now()->addSeconds(300);
			*/

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

	// For Verify OTP on registration
	public function OTPverification(Request $request) {
		$validator = Validator::make($request->all(),
			[
				'signUp_mobile_no' => 'required|min:6|max:15',
				'signUp_otp' => 'required',
			]);

		if ($validator->fails()) {
			return response()->json(['status' => false, 'message' => $validator->errors()->first()], 200);
		}

		$mobile_no = $request->input('signUp_mobile_no');
		$otp = $request->input('signUp_otp');

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

	// For Onboarding Send OTP
	public function OnboardingSendOTP(Request $request) {
		$validator = Validator::make($request->all(),
			[
				'mobile' => 'required|min:6|max:15',
			]);

		if ($validator->fails()) {
			return response()->json(['status' => false, 'message' => $validator->errors()->first()], 200);
		}

		$dial_code = "+" . $request->input('dial_code');

		$check = User::where('mobile_no', $request->input('mobile', ))->where('dial_code', $dial_code)->exists();

		if ($check) {
			return response()->json([
				'status' => false,
				'message' => "mobile number already exists",
			], );
		} else {
			$mobile = $request->input('mobile');
			$dial_code = "+" . $request->input('dial_code');
			$store = rand(1000, 9999);

			$mobile_verify = new Mobile_Verify();
			$mobile_verify->mobile_no = $mobile;
			$mobile_verify->dial_code = $dial_code;
			$mobile_verify->otp = $store;
			$mobile_verify->usertype = '2';
			$mobile_verify->save();

			return response()->json([
				'status' => true,
				'message' => "OTP has been successfully generated.",
				'otp' => $store,
			], );
		}
	}

	// For Onboarding Verify OTP
	public function OnboardingVerifyOTP(Request $request) {
		$validator = Validator::make($request->all(),
			[
				'mobile' => 'required|min:6|max:15',
				'otp' => 'required',
			]);

		if ($validator->fails()) {
			return response()->json(['status' => false, 'message' => $validator->errors()->first()], 200);
		}

		$mobile_no = $request->input('mobile');
		$otp = $request->input('otp');

		$data = $this->mobile_verify->OnboardingOTPverify($mobile_no, $otp);

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

	public function getClientDashboard() {
		return view('Website/User/client_dashboard');
	}

	public function getLandingPage() {
		return view('Website/User/Landing_Page/landing_page');
	}

	public function getAllIssues(Request $request) {

		$allIssues = $this->mobile_verify->GetMoodRegulations();

		if ($allIssues == false) {
			return response()->json([
				'status' => false,
				'message' => "Data Empty",
			], );
		} else {
			$data = view('Website/User/Landing_Page/issues', ['allIssues' => $allIssues])->render();

			return response()->json([
				'status' => true,
				'getissues' => $allIssues,
				'allIssues' => $data,
			], );
		}
	}

	public function getAllLanguages(Request $request) {

		$languages = $this->mobile_verify->getLanguages();

		if ($languages == false) {
			return response()->json([
				'status' => false,
				'message' => "Data Empty",
			], );
		} else {
			$data = view('Website/User/Landing_Page/languages', ['languages' => $languages])->render();

			return response()->json([
				'status' => true,
				'getlanguage' => $languages,
				'languages' => $data,
			], );
		}
	}

	public function getAllServices(Request $request) {

		$services = $this->mobile_verify->getServices();

		if ($services == false) {
			return response()->json([
				'status' => false,
				'message' => "Data Empty",
			], );
		} else {
			$data = view('Website/User/Landing_Page/services', ['services' => $services])->render();

			return response()->json([
				'status' => true,
				'getservice' => $services,
				'services' => $data,
			], );
		}
	}

	public function getAllMediums(Request $request) {

		$mediums = $this->mobile_verify->getMediums();

		if ($mediums == false) {
			return response()->json([
				'status' => false,
				'message' => "Data Empty",
			], );
		} else {
			$data = view('Website/User/Landing_Page/mediums', ['mediums' => $mediums])->render();

			return response()->json([
				'status' => true,
				'getmedium' => $mediums,
				'mediums' => $data,
			], );
		}
	}

	public function getAllCountries(Request $request) {

		$countries = $this->mobile_verify->getCountries();

		if ($countries == false) {
			return response()->json([
				'status' => false,
				'message' => "Data Empty",
			], );
		} else {
			$data = view('Website/User/Landing_Page/countries', ['countries' => $countries])->render();

			return response()->json([
				'status' => true,
				'getcountries' => $countries,
				'countries' => $data,
			], );
		}
	}

	public function calender() {
		return view('Website/Doctor/calender');
	}

	public function getConfirmBookingPage() {
		return view('Website/User/Confirm_booking/confirm_booking');
	}

	public function sessionReceipts() {
		return view('Website/User/session_receipt');
	}

	public function showMyClients() {
		return view('Website/Doctor/my_clients');
	}

	public function showClientDetails($id) {
		return view('Website/Doctor/client_details', ['id' => $id]);
	}

	public function clientsDetail() {
		return view('Website/Doctor/clients_details');
	}

	public function getBulkAddSlotForm() {
		$bulkSlot = view('Website/Doctor/calender_slot_bulk_add')->render();

		return response()->json([
			'status' => true,
			'bulkSlot' => $bulkSlot,
		], );
	}

	public function showPaymentNotes() {
		return view('Website/Doctor/payment_notes');
	}
}