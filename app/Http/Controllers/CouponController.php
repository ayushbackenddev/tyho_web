<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;

use Illuminate\Support\Facades\DB;
use Validator;
use App\Helpers\Helper;
use Session;

class CouponController extends Controller
{
    public function __construct(Coupon $Coupon) {
		$this->Coupon = $Coupon;
	}

    public function couponView(){
        return view('Website/Doctor/Coupon/coupon');
    } 
    public function showCouponData(Request $request) {
        $therapist_id_fk = Session::get('loggedTherapist');

        $orderByIndex = $request->all()["order"][0]["column"];
		
		$orderByColumnName = $request->all()["columns"][$orderByIndex]["name"];
		
		$orderBy = $request->all()["order"][0]["dir"]; 

        $start = $_POST['start'];
        $length = $_POST['length'];
        $search = $_POST['search']["value"];

        $filterOrderBy = "";
		if($orderByColumnName !=""){
			$filterOrderBy = " order by ".$orderByColumnName." ".$orderBy;
		}
        date_default_timezone_set('Asia/kolkata');


        $CouponData = DB::select("SELECT id, per_user_limit, discount_code, cliend_name_id, discount_value, date_of_issue, expiry_date, description,status
		FROM tbl_coupon WHERE issued_by = ".$therapist_id_fk."  ".$filterOrderBy." limit " . $start . "," . $length."");

        $arrayOfCoupontData = array();

        foreach ($CouponData as $key => $value) {

            if ($value->date_of_issue == "") {
                $value->date_of_issue = "";
            } else {
                $value->date_of_issue = Helper::getFormatedDateTimeForMyClients($value->date_of_issue);
            }

            if ($value->expiry_date == "") {
                $value->expiry_date = "";
            } else {
                $value->expiry_date = Helper::getFormatedDateTimeForMyClients($value->expiry_date);
            }

            date_default_timezone_set('Asia/kolkata');
            $Currentdate = date("m/d/Y");
             $today =  strtotime($Currentdate);
             $expirydate = strtotime($value->expiry_date);
             $issuedate = strtotime($value->date_of_issue);
            
             if($expirydate >= $today && $issuedate <= $today ){
                 $value->datestutas = 1;
             }elseif($issuedate >= $today){
                $value->datestutas = 2;
             }elseif($issuedate <= $today && $expirydate <= $today ){
                $value->datestutas = 3;
             }else{
                $value->datestutas = " ";
             }
                
    

            $client_id_name = $value->cliend_name_id;
			
            $getcliend = array();
			
            if($client_id_name !="")
			{
				$clientIDName = explode("," , $client_id_name);
				foreach($clientIDName as $row){
					$clientDetails = DB::table('users')->select('first_name', 'last_name', 'user_id',)->where('id', $row)->get();
					if (count($clientDetails) > 0)
					{
						$getcliend[] = $clientDetails[0]->first_name. " ". $clientDetails[0]->last_name."(". $clientDetails[0]->user_id.")";
					}else
					{
						$getcliend[] = "";
					}
				}
					
				 $value->cliend_name_id = implode("<br> " , $getcliend);
			}
            

            $arrayOfCoupontData[] = $value;
        }

        $tableData['data'] = $arrayOfCoupontData;
        $tableData['recordsTotal'] = count($arrayOfCoupontData);

        $myCouponAllData = DB::select("SELECT 	id, per_user_limit, discount_code, cliend_name_id, discount_value, date_of_issue, 
		expiry_date, description,status
		FROM tbl_coupon WHERE issued_by = ".$therapist_id_fk."  ".$filterOrderBy."");

        $tableData['recordsFiltered'] = count($myCouponAllData);

        return response()->json($tableData);
    }

    public function AddCoupon(Request $request){
       
        $validator = Validator::make($request->all(),
        [
            'discount_code' => 'required|unique:tbl_coupon',
            'discount_value' => 'required',
            'per_user_limit' => 'required',
            'expiry_date' => 'required',
            
        ]);

         $id = $request->input('id');

        $therapist_id_fk = Session::get('loggedTherapist');

        if ($request->input('cliend_name_id') == "") {
            $cliend_name_id = null;
        } else {
            $cliend_name_id = implode(",", $request->input('cliend_name_id'));
        }
        $date_of_issue = date("m/d/Y");
        
        if ($id == "") {
            if ($validator->fails()) {
                return response()->json(['status' => false, 'message' => $validator->errors()->first()], 200);
            }
            
            $coupon = new coupon();
            $coupon->cliend_name_id = $cliend_name_id;
            $coupon->issued_by = $therapist_id_fk;
            $coupon->discount_code = $request->input('discount_code');
            $coupon->per_user_limit = $request->input('per_user_limit');
            $coupon->discount_value = $request->input('discount_value');
            $coupon->date_of_issue = $date_of_issue;
            $coupon->description = $request->input('description');
            $coupon->expiry_date = $request->input('expiry_date');
        
            $coupon->save();

            return response()->json([
                'status' => true,
                'message' => "Coupon Added Successfully",
            ], );
        }
		
    }

    public function applycoupondisable(Request $request){
        $cartId = $request->input('cart_id');
        
        if($cartId != " "){
            $getcliend = DB::select("UPDATE tbl_cart SET discount_coupon=' ' WHERE id =".$cartId);
            return response()->json([
                'status' => true,
                'message' => 'Coupon code Deactive',
            ], );
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Coupon Code Active',
            ], );
        }
        
        
    }

    public function getclientDetails(){
       
        $getcliend = DB::select('SELECT users.id,users.first_name,users.last_name, users.user_id FROM tbl_order LEFT JOIN users ON tbl_order.client_id_fk=users.id WHERE isDelete != 1 GROUP BY users.id');

        if ($getcliend == true) {
            return response()->json([
                'status' => true,
                'data' => $getcliend,
            ], );
        } else {
            return response()->json([
                'status' => false,
                'message' => 'coupon type not found',
            ], );
        }
        
    }

    public function therapiscoupuntatus(Request $request){
        $id = $request->input('id');
        $status = $request->input('status');
        
        $updatcouponstutas = DB::select("UPDATE `tbl_coupon` SET `status`= ".$status." WHERE id = " . $id);
        
        if ($updatcouponstutas) {
            return response()->json([
                'status' => true,
                'message' => 'coupon  stutas',
            ], );
        } else {
            return response()->json([
                'status' => false,
                'message' => 'stutas coupon false',
            ], );
        }

    }

    public function createcouponForm(){

        $data = view('Website/Doctor/Coupon/create_coupon')->render();
       
        return response()->json([
            'status' => true,
            'createcoupon' => $data,
        ], );

    }

    public function apllycoupncode(Request $request){
        $couponcode = $request->input('couponcode');
        $userID = $request->input('userID');
        $therapist_id_fk = $request->input('therapist_id_fk');
        $totalPrice = $request->input('totalPrice');
        date_default_timezone_set('Asia/kolkata');
        $applycouponcode = $this->Coupon->applycouponcode($userID,$couponcode);
       
        if(!empty($applycouponcode)){
          
            foreach($applycouponcode as $key => $value){
                
                $perUserLimit = $value->per_user_limit;
                $minimum_spend =$value->minimum_spend;
                $maximum_spend =$value->maximum_spend;
                $Currentdate = date("m/d/Y");
                $today =  strtotime($Currentdate);
                $expirydate = strtotime($value->expiry_date);
                $issuedate = strtotime($value->date_of_issue);
               
                if($perUserLimit != " " && $expirydate >= $today && $issuedate <= $today  ){
                    
                    if($minimum_spend != null && $maximum_spend != null){
                        if($minimum_spend <= $totalPrice && $maximum_spend >= $totalPrice){
                            $cardcouponcount = DB::select("SELECT therapist_id_fk, client_id_fk, discount_coupon FROM tbl_cart WHERE discount_coupon = '".$couponcode."' AND client_id_fk = ".$userID." ");
                            $count = count($cardcouponcount);
                            if($perUserLimit >= $count){
                                $cardupdate = DB::select("UPDATE `tbl_cart` SET `discount_coupon`= '" .$couponcode. "' WHERE client_id_fk = " . $userID. " AND therapist_id_fk =".$therapist_id_fk."");
                                return response()->json([
                                    'status' => true,
                                    'message' => 'Apply successfully',
                                ], );
    
                            }else{
                                return response()->json([
                                    'status' => false,
                                    'message' => 'Not Apply CouponCouponcode',
                                ], );
                            }  
                        }else{
                            return response()->json([
                                'status' => false,
                                'message' => 'Not Apply Amout CouponCouponcode',
                            ], );
                        }
                    }else{

                        $cardcouponcount = DB::select("SELECT therapist_id_fk, client_id_fk, discount_coupon FROM tbl_cart WHERE discount_coupon = '".$couponcode."' AND client_id_fk = ".$userID." ");
                       
                        $count = count($cardcouponcount);
                        if($perUserLimit >= $count ){
                            $cardupdate = DB::select("UPDATE `tbl_cart` SET `discount_coupon`= '" .$couponcode. "' WHERE client_id_fk = " . $userID. " AND therapist_id_fk =".$therapist_id_fk."");
                            return response()->json([
                                'status' => true,
                                'message' => 'Apply successfully',
                            ], );

                        }else{
                            return response()->json([
                                'status' => false,
                                'message' => 'Not Use CouponCouponcode',
                            ], );
                        }
                    }

                }else{
                    return response()->json([
                        'status' => false,
                        'message' => 'Expiry Coupon Code',
                    ], );
                }    
            } 
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Is Not CouponCode',
            ], );
            
        }
       
    }
    
}
