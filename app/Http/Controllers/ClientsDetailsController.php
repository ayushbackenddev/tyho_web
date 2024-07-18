<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;
use App\Models\ClientDetails;
use Validator;

class ClientsDetailsController extends Controller
{
    public function __construct(ClientDetails $clientdetails) {
        $this->clientdetails = $clientdetails;
    }

    public function showMyClient(Request $request) {

        $therapist_id_fk = Session::get('loggedTherapist');

        $orderByIndex = $request->all()["order"][0]["column"];
		
		$orderByColumnName = $request->all()["columns"][$orderByIndex]["name"];
		
		$orderBy = $request->all()["order"][0]["dir"]; 

        $start = $_POST['start'];
        $length = $_POST['length'];
        $search = $_POST['search']["value"];

        $therapist_id_fk = Session::get('loggedTherapist');

        $filterOrderBy = "";
		if($orderByColumnName !=""){
			$filterOrderBy = " order by ".$orderByColumnName." ".$orderBy;
		}

        $myClientsData = DB::select("SELECT  tbl_order.client_id_fk,tbl_order.id AS id, tbl_order_session.booking_date, CONCAT(users.first_name, ' ', users.last_name) AS full_name, users.user_id, intakes.gender, intakes.country_of_residence AS country, intakes.city_of_residence AS city, tbl_avalability_time_slots.time_slot AS start_time, tbl_avalability_time_slots.end_time_slot AS end_time, tbl_avalability.slot_date, tbl_order_session.quick_notes FROM `tbl_order`
            LEFT JOIN tbl_order_session ON tbl_order_session.order_id_fk = tbl_order.id
            LEFT JOIN users ON users.id = tbl_order.client_id_fk
            LEFT JOIN intakes ON intakes.user_id = users.id
            LEFT JOIN tbl_avalability_time_slots ON tbl_avalability_time_slots.id = tbl_order_session.slot_id_fk
            LEFT JOIN tbl_avalability ON tbl_avalability.id = tbl_avalability_time_slots.avalability_id_fk
            WHERE tbl_order.therapist_id_fk =" . $therapist_id_fk. "  Group by tbl_order.client_id_fk  ".$filterOrderBy." limit " . $start . "," . $length);

        $arrayOfSession = array();

        foreach ($myClientsData as $key => $value) {

            $order_id = $value->id;
            
            date_default_timezone_set('Asia/kolkata');
            $currentdate= date("Y-n-j"); 
            $date = date('g:i A' );
            
           
            
            $getBookedDate = DB::select("SELECT tbl_order_session.booking_date, tbl_avalability_time_slots.time_slot AS start_time, tbl_avalability_time_slots.end_time_slot AS end_time, tbl_avalability.slot_date FROM tbl_order_session 
            LEFT JOIN tbl_avalability_time_slots ON tbl_avalability_time_slots.id = tbl_order_session.slot_id_fk
            LEFT JOIN tbl_avalability ON tbl_avalability.id = tbl_avalability_time_slots.avalability_id_fk
            WHERE order_id_fk =".$order_id." AND tbl_order_session.booking_date >= '".$currentdate."' AND tbl_avalability_time_slots.time_slot >= '".$date."'");
           
           if(count($getBookedDate) > 0){
               
                $start_time = $getBookedDate[0]->start_time;
                $end_time = $getBookedDate[0]->end_time;
                $slot_date = $getBookedDate[0]->slot_date;
           }else{
              
                $start_time = "";
                $end_time = "";
                $slot_date = "";
           }
          
            if ($slot_date == "") {
                $slot_date = "";
            } else {
                $slot_date = Helper::getFormatedDateTimeForMyClients($slot_date);
            }
            
            $start_times = $start_time != " " ? $start_time : " ";
            $end_times  = $end_time != " " ? $end_time : " ";
            $BookedDateget = DB::select("SELECT  slot_id_fk, booking_date FROM tbl_order_session WHERE order_id_fk =".$order_id."");
           
            $booking_dates = $BookedDateget[0]->booking_date;

            if ($booking_dates == "") {
                $booking_dates = "";
            } else {
                $booking_dates = Helper::getFormatedDateForClientsDatatable($booking_dates);
            }

            $value->booking_date = $booking_dates;
            $value->start_time = $start_times;
            $value->end_time = $end_times;
            $value->slot_date = $slot_date;
            
            $sessionCount = DB::select("SELECT * FROM tbl_order_session WHERE order_id_fk = " . $order_id);
         
            $count = count($sessionCount);
           
            $value->booked_session = $count;

            $arrayOfSession[] = $value;
        }

        $tableData['data'] = $arrayOfSession;
        $tableData['recordsTotal'] = count($arrayOfSession);

        $myClients = DB::select("SELECT  tbl_order.client_id_fk,tbl_order.id AS id, tbl_order_session.booking_date, CONCAT(users.first_name, ' ', users.last_name) AS full_name, users.user_id, intakes.gender, intakes.country_of_residence AS country, intakes.city_of_residence AS city, tbl_avalability_time_slots.time_slot AS start_time, tbl_avalability_time_slots.end_time_slot AS end_time, tbl_avalability.slot_date, tbl_order_session.quick_notes FROM `tbl_order`
            LEFT JOIN tbl_order_session ON tbl_order_session.order_id_fk = tbl_order.id
            LEFT JOIN users ON users.id = tbl_order.client_id_fk
            LEFT JOIN intakes ON intakes.user_id = users.id
            LEFT JOIN tbl_avalability_time_slots ON tbl_avalability_time_slots.id = tbl_order_session.slot_id_fk
            LEFT JOIN tbl_avalability ON tbl_avalability.id = tbl_avalability_time_slots.avalability_id_fk
            WHERE tbl_order.therapist_id_fk =" . $therapist_id_fk." ".$filterOrderBy."");

        $tableData['recordsFiltered'] = count($myClients);

        return response()->json($tableData);
    }

    public function showMyClientData(Request $request) {

        $start = $_POST['start'];
        $length = $_POST['length'];
        $search = $_POST['search']["value"];

        $therapist_id_fk = Session::get('loggedTherapist');
        $clien_id_fk = $request->input('id');
       

        $ClientsData = DB::select("SELECT tbl_order_session.id, services.service, mediums.medium, tbl_avalability_time_slots.time_slot AS start_time, tbl_avalability_time_slots.end_time_slot AS end_time, tbl_avalability.slot_date, tbl_order_session.quick_notes FROM `tbl_order_session` 
            LEFT JOIN tbl_order ON tbl_order.id = tbl_order_session.order_id_fk
            LEFT JOIN services ON services.id = tbl_order.service_id_fk
            LEFT JOIN mediums ON mediums.id = tbl_order.medium_id_fk
            LEFT JOIN tbl_avalability_time_slots ON tbl_avalability_time_slots.id = tbl_order_session.slot_id_fk
            LEFT JOIN tbl_avalability ON tbl_avalability.id = tbl_avalability_time_slots.avalability_id_fk
            WHERE tbl_order.therapist_id_fk =" . $therapist_id_fk . " AND tbl_order.client_id_fk =" .$clien_id_fk. " limit " . $start . "," . $length);

        $arrayOfClientData = array();

        foreach ($ClientsData as $key => $value) {

            if ($value->slot_date == "") {
                $value->slot_date = "";
            } else {
                $value->slot_date = Helper::getFormatedDateTimeForMyClients($value->slot_date);
            }

            // if ($value->booking_date == "") {
            //     $value->booking_date = "";
            // } else {
            //     $value->booking_date = Helper::getFormatedDateForClientsDatatable($value->booking_date);
            // }

            $arrayOfClientData[] = $value;
        }

        $tableData['data'] = $arrayOfClientData;
        $tableData['recordsTotal'] = count($arrayOfClientData);

        $myClientsAllData = DB::select("SELECT tbl_order.id, services.service, mediums.medium, tbl_avalability_time_slots.time_slot AS start_time, tbl_avalability_time_slots.end_time_slot AS end_time, tbl_avalability.slot_date, tbl_order_session.quick_notes FROM `tbl_order` 
            LEFT JOIN services ON services.id = tbl_order.service_id_fk
            LEFT JOIN mediums ON mediums.id = tbl_order.medium_id_fk
            LEFT JOIN tbl_order_session ON tbl_order_session.order_id_fk = tbl_order.id
            LEFT JOIN tbl_avalability_time_slots ON tbl_avalability_time_slots.id = tbl_order_session.slot_id_fk
            LEFT JOIN tbl_avalability ON tbl_avalability.id = tbl_avalability_time_slots.avalability_id_fk
            WHERE tbl_order.therapist_id_fk =" . $therapist_id_fk." AND tbl_order.client_id_fk =" .$clien_id_fk. " ");

        $tableData['recordsFiltered'] = count($myClientsAllData);

        return response()->json($tableData);
    }

    public function ClientDetail(Request $request){

        $client_id_fk = $request->input('client_id_fk');

        $clientsDetails = $this->clientdetails->getClientData($client_id_fk);

        if ($clientsDetails == false) {
            return response()->json([
                'status' => false,
                'message' => "Data Empty",
            ], );
        } else {
            $getDetails = view('Website/Doctor/ClientsDetails/client_info', ['clientsDetails' => $clientsDetails[0]])->render();

            return response()->json([
                'status' => true,
                'clientsDetails' => $getDetails,
                'getDetails' => $clientsDetails,
            ], );
        }
    }

    public function showclientintakForm(Request $request){
        $user_id = $request->input('client_id_fk');

        $intekform = $this->clientdetails->getclientIntekformData($user_id);
        if ($intekform == false) {
            return response()->json([
                'status' => false,
                'message' => "Data Empty",
            ], );
        }else{
            
            $getclientintakform = view('Website/Doctor/ViewIntake/Client_intake_form',['clientintekform' => $intekform[0]])->render();
            return response()->json([
                'status' => true,
                'data' => $getclientintakform,
                'clientintekform' =>$intekform,
            ], );
        }
    }

    public function AddQuickNotes(Request $request){
        $validator = Validator::make($request->all(),
            [
                'quick_notes' => 'required',
            ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()], 200);
        }

        if ($request->input('quick_notes') == null) {
            $quick_notes = "";
        } else {
            $quick_notes = $request->input('quick_notes');
        }

        $order_session_id = $request->input('order_session_id');

        $update = DB::update('update `tbl_order_session` set quick_notes=? where id=?', [$quick_notes, $order_session_id]);

        return response()->json([
            'status' => true,
            'message' => "Quick notes added successfully."
        ], );
    }
}
