<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable {
	use HasFactory, Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */

	protected $table = "users";

	protected $fillable = [
		'id',
		'first_name',
		'last_name',
		'email',
		'password',
		'dial_code',
		'mobile_no',
		'otp',
		'how_did_you_find_us',
		'find_us_other',
		'EAP_client',
		'company_name',
		'wrong_credential',
		'isDelete',
		'isBlock',
	];

	protected $primaryKey = "id";

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	/*public function loginAuth($mobile_no,$password)
		    {
		        $user = DB::table('users')->select('mobile_no','password')->where('mobile_no',$mobile_no)->get();

		        if (count($user) == 0)
		        {
		            return false;
		        }
		        else
		        {
		            return $user;
		        }
	*/

	public function DocloginAuth($mobile_no, $password, $dial_code) {
		$verify = DB::table('users')->select('id', 'mobile_no', 'password', 'dial_code')->where('mobile_no', $mobile_no)->where('usertype', '=', '2')->get();

		if (count($verify) == 0) {
			return false;
		} else {
			return $verify;
		}
	}

	public function clientLoginAuth($mobile_no, $password, $dial_code) {
		$verify = DB::table('users')->select('id', 'mobile_no', 'password', 'dial_code')->where('mobile_no', $mobile_no)->where('usertype', '=', '3')->where('isBlock', '=', '0')->where('isDelete', '=', '0')->get();

		if (count($verify) == 0) {
			return false;
		} else {
			return $verify;
		}
	}

	public function OTPverify($mobile_no, $otp) {
		$user = DB::table('users')->select('mobile_no', 'otp')->where('mobile_no', $mobile_no)->where('otp', $otp)->get();

		if (count($user) == 0) {
			return false;
		} else {
			return $user;
		}
	}

	public function DocResetPasswordAuth($mobile_no) {
		$get = DB::table('users')->select('mobile_no')->where('mobile_no', $mobile_no)->where('usertype', '=', '2')->get();

		if (count($get) == 0) {
			return false;
		} else {
			return $get;
		}
	}

	public function UserResetPasswordAuth($mobile_no) {
		$get = DB::table('users')->select('mobile_no')->where('mobile_no', $mobile_no)->get();

		if (count($get) == 0) {
			return false;
		} else {
			return $get;
		}
	}
}
