<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientDetails;
use Session;
use Auth;
use App\Models\User;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ClientProfileController extends Controller
{
    public function __construct(ClientDetails $clientdetails) {
        $this->clientdetails = $clientdetails;
    }

    public function getClientEditProfileView(){
        return view('Website/User/EditProfile/client_edit_profile');
    }

    public function ClientDetailForEdit(Request $request){

        $client_id_fk = Session::get('loggedUser');

        $editProfile = $this->clientdetails->getClientDataForEdit($client_id_fk);

        if ($editProfile == false) {
            return response()->json([
                'status' => false,
                'message' => "Data Empty",
            ], );
        } else {
            $getClientDetails = view('Website/User/EditProfile/clientProfileDetail', ['editProfile' => $editProfile[0]])->render();

            return response()->json([
                'status' => true,
                'editProfile' => $getClientDetails,
                'getClientDetails' => $editProfile,
            ], );
        }
    }

    public function updateClientProfile(Request $request){

        $userID = session()->get('loggedUser');
        $userDetails = User::where('id', $userID)->first();


        $validator = Validator::make($request->all(),
            [
                'first_name' => 'required|string|max:20',
                'last_name' => 'required|string|max:20',
                'email' => 'required',
                'newpassword' => 'required_with:confirmpassword|same:confirmpassword',
                'current_password' => [ 'required_with:confirmpassword',function ($attribute, $value, $fail) use ($userDetails){
                    
                    if ($value != "")
                    {
                        if (!\Hash::check($value, $userDetails->password)) {
                            return $fail(__('The current password is incorrect.'));
                        }
                    }
                    
                }]
                
            ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()], 200);
        }

        

        $password = Hash::make($request->input('signUp_password'));

        $user = User::findOrFail($userID);
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');

        if ($request->input('newpassword') != "")
        {
            $password = Hash::make($request->input('newpassword'));
            $user->password = $password;
        }

        if($request->input("isMobileVerified") == 1)
        {
            $user->mobile_no = $request->input('mobile_no');
            $user->dial_code = "+" . $request->input('dial_code');
        }

        $user->save();

        return response()->json([
            'status' => true,
            'message' => "Your account has been updated successfully.",
        ], );
    }

    public function OTPsendClient(Request $request) {
        $validator = Validator::make($request->all(),
            [
                'mobile_no' => 'required|min:6|max:15',
            ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()], 200);
        }

        $dial_code = "+" . $request->input('dial_code');
        $mobile_no = $request->input('mobile_no');
        $usertype = 3;

        $check = User::where('mobile_no', $mobile_no)->where('dial_code', $dial_code)->where('usertype', '=', $usertype)->exists();


        if ($check) {
            return response()->json([
                'status' => false,
                'message' => "Profile already registered with this number",
            ], );
            
        } else {

            $otp = rand(1000, 9999);

            $mobile_no = $request->input('mobile_no');

            $userID = session()->get('loggedUser');

            $store = DB::update('update users set otp=? where id=?', [$otp, $userID]);

            return response()->json([
                'status' => true,
                'message' => "OTP has been successfully generated.",
                'otp' => $otp,
            ], );

        }
    }

    // For Doctor Login Verify OTP
    public function OTPverificationClient(Request $request) {
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

        $userID = session()->get('loggedUser');
        $data = $this->clientdetails->OTPverify($userID, $otp);

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
}
