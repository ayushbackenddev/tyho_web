<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Response;
use Session;
use Validator;

class ApiController extends Controller {
	public function __construct(User $user) {
		$this->user = $user;
	}

	protected function redirectTo() {
		if (Auth::user()->usertype == '3') {
			return 'intake1';
		} else {
			return '/';
		}
	}

	// For User Sign Up
	public function Registration(Request $request) {
		$validator = Validator::make($request->all(),
			[
				'first_name' => 'required|string|max:20',
				'last_name' => 'required|string|max:20',
				'email' => 'required|email|unique:users',
				'signUp_mobile_no' => 'required|min:6|max:15',
				'signUp_otp' => 'required',
				'signUp_password' => 'required_with:cnf_password|same:cnf_password|min:8|max:20',
				'cnf_password' => 'min:8|max:20',
				'how_did_you_find_us' => 'required',
			]);

		if ($validator->fails()) {
			return response()->json(['status' => false, 'message' => $validator->errors()->first()], 200);
		}

		$password = Hash::make($request->input('signUp_password'));

		$email = $request->input('email');
		$first_name = $request->input('first_name');
		$last_name = $request->input('last_name');

		$user = new User();
		$user->usertype = '3';
		$user->first_name = $first_name;
		$user->last_name = $last_name;
		$user->email = $email;
		$user->password = $password;
		$user->mobile_no = $request->input('signUp_mobile_no');
		$user->dial_code = "+" . $request->input('dial_code');
		$user->how_did_you_find_us = $request->input('how_did_you_find_us');
		$user->find_us_other = $request->input('find_us_other');
		$user->EAP_client = $request->input('EAP_client') == null ? 0 : 1;

		if ($request->input('EAP_client') == null) {
			$user->company_name = "";
		} else {
			$user->company_name = $request->input('company_name');
		}
		$user->save();

		$userIdFK = $user->id;

		$data = ['name' => $first_name . " " . $last_name, 'data' => "Welcome to TYHO"];

		Mail::send('Website/User/Mails/SendEmail', $data, function ($message) use ($email) {
			$message->to($email);
			$message->subject('Sign Up Successful');
			$message->from('tech@talkyourheartout.com', 'TYHO');
		});

		return response()->json([
			'status' => true,
			'message' => "Your account has been successfully registered.",
			'user_id' => $userIdFK,

		], );
	}

	//For User Login
	public function Login(Request $request) {
		$validator = Validator::make($request->all(),
			[
				'client_singIn_mobile_no' => 'required|min:6|max:15',
				'client_password' => 'required|min:8|max:20',
			]);

		if ($validator->fails()) {
			return response()->json(['status' => false, 'message' => $validator->errors()->first()], 200);
		}

		$mobile_no = $request->input('client_singIn_mobile_no');
		$dial_code = "+" . $request->input('dial_code');
		$password = $request->input('client_password');

		$userData = $this->user->clientLoginAuth($mobile_no, $password, $dial_code);

		if ($userData == false) {
			// Session::put('id', Auth::id());
			// Session::put('usertype', Auth::user()->usertype);
			// Session::save();
			return response()->json([
				'status' => false,
				'message' => "Mobile number and password do not match.",
			], );
		} else {
			if (Hash::check($password, $userData[0]->password)) {

				$request->session()->put('loggedUser', $userData[0]->id);

				return response()->json([
					'status' => true,
					'message' => "You have successfully signed in.",
					'sessionId' => session('loggedUser'),
				], );
			} else {

				return response()->json([
					'status' => false,
					'message' => "Mobile number and password do not match.",
				], );
			}
		}
		// elseif (Auth::attempt(['mobile_no' => $mobile_no, 'dial_code' => $dial_code, 'password' => $password, 'usertype' => "3", 'isBlock' => "0", 'isDelete' => "1"])) {

		// 	return response()->json([
		// 		'status' => false,
		// 		'message' => "Your profile is deleted by admin.",
		// 	], );
		// } elseif (Auth::attempt(['mobile_no' => $mobile_no, 'dial_code' => $dial_code, 'password' => $password, 'usertype' => "3", 'isBlock' => "1", 'isDelete' => "0"])) {

		// 	return response()->json([
		// 		'status' => false,
		// 		'message' => "Your profile is blocked by admin.",
		// 	], );
		// } elseif (Auth::attempt(['mobile_no' => $mobile_no, 'dial_code' => $dial_code, 'password' => $password, 'usertype' => "3", 'isBlock' => "1", 'isDelete' => "1"])) {

		// 	return response()->json([
		// 		'status' => false,
		// 		'message' => "Your profile is blocked or deleted by admin.",
		// 	], );
		// }
	}

	// For Doctor Login
	public function DocLogin(Request $request) {
		$validator = Validator::make($request->all(),
			[
				'doc_signIn_mobile_no' => 'required|min:6|max:15',
				'therapistLogin_password' => 'required|min:8|max:20',
			]);

		if ($validator->fails()) {
			return response()->json(['status' => false, 'message' => $validator->errors()->first()], 200);
		}

		$mobile_no = $request->input('doc_signIn_mobile_no');
		$dial_code = "+" . $request->input('dial_code');
		$password = $request->input('therapistLogin_password');

		$data = $this->user->DocloginAuth($mobile_no, $password, $dial_code);

		if ($data == false) {
			return response()->json([
				'status' => false,
				'message' => "Mobile number and password do not match.",
			], );
		} else {
			if (Hash::check($password, $data[0]->password)) {

				$request->session()->put('loggedTherapist', $data[0]->id);

				return response()->json([
					'status' => true,
					'message' => "You have successfully signed in.",
					'sessionId' => session('loggedTherapist'),
				], );
			} else {
				return response()->json([
					'status' => false,
					'message' => "Mobile_No and Password are not matching",
				], );
			}
		}
	}

	// For Doctor Login Send OTP
	public function SendOTP(Request $request) {
		$validator = Validator::make($request->all(),
			[
				'doc_signIn_mobile_no' => 'required|min:6|max:15',
			]);

		if ($validator->fails()) {
			return response()->json(['status' => false, 'message' => $validator->errors()->first()], 200);
		}

		$dial_code = "+" . $request->input('dial_code');
		$mobile_no = $request->input('doc_signIn_mobile_no');
		$usertype = 2;

		$check = User::where('mobile_no', $mobile_no)->where('dial_code', $dial_code)->where('usertype', '=', $usertype)->exists();

		$checkForPassword = DB::select("SELECT password FROM `users` where mobile_no=" . $mobile_no);
		$checkForMobile_no = DB::select("SELECT mobile_no FROM `users` where mobile_no=" . $mobile_no);

		$checkMobileNumber = "";
		$checkPassword = "";

		foreach ($checkForMobile_no as $key => $value) {

			$checkMobileNumber = $value->mobile_no;
		}

		foreach ($checkForPassword as $key => $value) {

			$checkPassword = $value->password;
		}

		if ($checkMobileNumber != "" && $checkPassword == "") {
			return response()->json([
				'status' => false,
				'message' => "Please set password first.",
			], );
		}

		if ($check) {
			$otp = rand(1000, 9999);

			$mobile_no = $request->input('doc_signIn_mobile_no');

			$store = DB::update('update users set otp=? where mobile_no=?', [$otp, $mobile_no]);

			return response()->json([
				'status' => true,
				'message' => "OTP has been successfully generated.",
				'otp' => $otp,
			], );
		} else {
			return response()->json([
				'status' => false,
				'message' => "Please register first",
			], );
		}
	}

	// For Doctor Login Verify OTP
	public function VerifyOTP(Request $request) {
		$validator = Validator::make($request->all(),
			[
				'doc_signIn_mobile_no' => 'required|min:6|max:15',
				'doc_signIn_otp' => 'required',
			]);

		if ($validator->fails()) {
			return response()->json(['status' => false, 'message' => $validator->errors()->first()], 200);
		}

		$mobile_no = $request->input('doc_signIn_mobile_no');
		$otp = $request->input('doc_signIn_otp');

		$data = $this->user->OTPverify($mobile_no, $otp);

		if ($data == false) {
			return response()->json([
				'status' => false,
				'message' => "OTP not matched",
			], );
		} else {
			return response()->json([
				'status' => true,
				'message' => "OTP has been verified.",
			], );
		}
	}

	// For Reset Password User Send OTP
	public function ResetSendOTP(Request $request) {
		$validator = Validator::make($request->all(),
			[
				'client_reset_mobile_no' => 'required|min:6|max:15',
			]);

		if ($validator->fails()) {
			return response()->json(['status' => false, 'message' => $validator->errors()->first()], 200);
		}

		$dial_code = "+" . $request->input('dial_code');

		$check = User::where('mobile_no', $request->input('client_reset_mobile_no', ))->where('dial_code', $dial_code)->where('usertype', '=', '3')->exists();

		if ($check) {
			$otp = rand(1000, 9999);

			$mobile_no = $request->input('client_reset_mobile_no');

			$store = DB::update('update users set otp=? where mobile_no=?', [$otp, $mobile_no]);

			return response()->json([
				'status' => true,
				'message' => "OTP has been successfully generated.",
				'otp' => $otp,
			], );
		} else {
			return response()->json([
				'status' => false,
				'message' => "Mobile number not exist",
			], );
		}
	}

	// For Reset Password User Verify OTP
	public function ResetVerifyOTP(Request $request) {
		$validator = Validator::make($request->all(),
			[
				'client_reset_mobile_no' => 'required|min:6|max:15',
				'client_reset_otp' => 'required',
			]);

		if ($validator->fails()) {
			return response()->json(['status' => false, 'message' => $validator->errors()->first()], 200);
		}

		$mobile_no = $request->input('client_reset_mobile_no');
		$otp = $request->input('client_reset_otp');

		$data = $this->user->OTPverify($mobile_no, $otp);

		if ($data == false) {
			return response()->json([
				'status' => false,
				'message' => "OTP not matched",
			], );
		} else {
			return response()->json([
				'status' => true,
				'message' => "OTP has been verified.",
			], );
		}
	}

	// For Reset Password Doctor Send OTP
	public function DocResendOTP(Request $request) {
		$validator = Validator::make($request->all(),
			[
				'doc_reset_mobile_no' => 'required|min:6|max:15',
			]);

		if ($validator->fails()) {
			return response()->json(['status' => false, 'message' => $validator->errors()->first()], 200);
		}

		$dial_code = "+" . $request->input('dial_code');

		$check = User::where('mobile_no', $request->input('doc_reset_mobile_no', ))->where('dial_code', $dial_code)->where('usertype', '=', '2')->exists();

		if ($check) {
			$otp = rand(1000, 9999);

			$mobile_no = $request->input('doc_reset_mobile_no');

			$store = DB::update('update users set otp=? where mobile_no=?', [$otp, $mobile_no]);

			return response()->json([
				'status' => true,
				'message' => "OTP has been successfully generated.",
				'otp' => $otp,
			], );
		} else {
			return response()->json([
				'status' => false,
				'message' => "Please register first",
			], );
		}
	}

	// For Reset Password Doctor Verify OTP
	public function DocVerifyOTP(Request $request) {
		$validator = Validator::make($request->all(),
			[
				'doc_reset_mobile_no' => 'required|min:6|max:15',
				'doc_reset_otp' => 'required',
			]);

		if ($validator->fails()) {
			return response()->json(['status' => false, 'message' => $validator->errors()->first()], 200);
		}

		$mobile_no = $request->input('doc_reset_mobile_no');
		$otp = $request->input('doc_reset_otp');

		$data = $this->user->OTPverify($mobile_no, $otp);

		if ($data == false) {
			return response()->json([
				'status' => false,
				'message' => "OTP not matched",
			], );
		} else {
			return response()->json([
				'status' => true,
				'message' => "OTP has been verified.",
			], );
		}
	}

	// for therapist reset password
	public function DoctorResetPassword(Request $request) {
		$validator = Validator::make($request->all(),
			[
				'doc_reset_mobile_no' => 'required|min:6|max:15',
				'tharapistReset_password' => 'required|min:8|max:20',
			]);

		if ($validator->fails()) {
			return response()->json(['status' => false, 'message' => $validator->errors()->first()], 200);
		}

		$password = Hash::make($request->input('tharapistReset_password'));
		$mobile_no = $request->input('doc_reset_mobile_no');

		$data = $this->user->DocResetPasswordAuth($mobile_no);

		$update = DB::update('update users set password=? where mobile_no=?', [$password, $mobile_no]);

		$get = DB::table('users')->select('email', 'first_name', 'last_name', 'updated_at')->where('usertype', '2')->first();

		$email = $get->email;
		$firstName = $get->first_name;
		$lastName = $get->last_name;
		$updatePasswordDate = $get->updated_at;
		$dt = new DateTime($updatePasswordDate);
		$date = $dt->format('Y-m-d');

		$data = [
			'name' => $firstName . " " . $lastName,
			'dateTime' => $updatePasswordDate,
		];

		Mail::send('Website/Doctor/Mails/passwordResetMail', $data, function ($message) use ($email, $date) {
			$message->to($email);
			$message->subject('Your password was reset on' . $date);
			$message->from('tech@talkyourheartout.com', 'TYHO');
		});

		return response()->json([
			'status' => true,
			'message' => "Your password has been updated.",
		], );
	}

	// for user reset password
	public function UserResetPassword(Request $request) {
		$validator = Validator::make($request->all(),
			[
				'client_reset_mobile_no' => 'required|min:6|max:15',
				'clientReset_password' => 'required_with:cnf_clientReset_password|same:cnf_clientReset_password|min:8|max:20',
				'cnf_clientReset_password' => 'min:8|max:20',
			]);

		if ($validator->fails()) {
			return response()->json(['status' => false, 'message' => $validator->errors()->first()], 200);
		}

		$password = Hash::make($request->input('clientReset_password'));
		$mobile_no = $request->input('client_reset_mobile_no');

		$data = $this->user->UserResetPasswordAuth($mobile_no);

		$update = DB::update('update users set password=? where mobile_no=?', [$password, $mobile_no]);

		$get = DB::table('users')->select('email', 'first_name', 'last_name', 'updated_at')->where('usertype', '3')->first();

		$email = $get->email;
		$firstName = $get->first_name;
		$lastName = $get->last_name;
		$updatePasswordDate = $get->updated_at;

		$data = [
			'name' => $firstName . " " . $lastName,
			'dateTime' => $updatePasswordDate,
		];

		Mail::send('Website/User/Mails/resetPasswordMail', $data, function ($message) use ($email) {
			$message->to($email);
			$message->subject('Your Password Reset Time');
			$message->from('tech@talkyourheartout.com', 'TYHO');
		});

		return response()->json([
			'status' => true,
			'message' => "Your password has been updated.",
		], );
	}

	// for therapist set password
	public function therapistSetPassword(Request $request) {
		$validator = Validator::make($request->all(),
			[
				'tharapistSet_password' => 'required|min:8|max:20',
			]);

		if ($validator->fails()) {
			return response()->json(['status' => false, 'message' => $validator->errors()->first()], 200);
		}

		$id = $request->input('id');
		$therapistPassword = Hash::make($request->input('tharapistSet_password'));

		$updatePassword = DB::update('update users set password=? where id=?', [$therapistPassword, $id]);

		return response()->json([
			'status' => true,
			'message' => "Your new password has been set.",
		], );
	}

	public function therapistLogout(Request $request) {
		if (session()->has('loggedTherapist')) {
			session()->pull('loggedTherapist');

			return response()->json([
				'status' => true,
				'message' => "Therapist logout successfully.",
			], );
		} else {

		}
	}

	public function userLogout(Request $request) {
		if (session()->has('loggedUser')) {
			session()->pull('loggedUser');

			return response()->json([
				'status' => true,
				'message' => "User logout successfully.",
			], );
		} else {

		}
	}
}