<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\OrderSession;
use Illuminate\Http\Request;
use Response;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\Wallet;
use App\Helpers\Helper;

class TherapistSessionController extends Controller {
	public function __construct(OrderSession $ordersession) {
		$this->ordersession = $ordersession;
	}

	public function showTherapistSessions(Request $request) {

		$therapist_id_fk = $request->input('therapist_id_fk');

		$therapist_sessions = $this->ordersession->TherapistAllSessions($therapist_id_fk);
		date_default_timezone_set('Asia/kolkata');

		if ($therapist_sessions == false) {
			return response()->json([
				'status' => false,
				'message' => "Data Empty",
			], );
		} else {
			$sessionTherapist = array();

			$hour = "";
			
			foreach($therapist_sessions as $key => $value){
				
				if( $value->is_cancel != 0 ){

					$date = $value->cancel_time;
					$Currentdate = date("H:m");
					$timestamp = strtotime($date);

					//$child1 = date('d/m/Y', $timestamp); // d.m.YYYY
					$getTime = date('H:m', $timestamp); // HH:ss
					$hourDiff = strtotime($Currentdate) - strtotime($getTime);
					$hoursCount = $hourDiff /60 /60 ;
					$strtotimes = strtotime($hoursCount);
					$hour = date("g",$strtotimes);
					$value->hourCount = $hour;
				}
				else{
					$hour = "";
					$value->hourCount = $hour;
				}
				$sessionTherapist[]=$value;
			}

			$getView = view('Website/Doctor/Dashboard/therapist_session_dashboard', ['therapist_sessions' => $sessionTherapist])->render();

			return response()->json([
				'status' => true,
				'therapist_sessions' => $getView,
				'therapist_session_count' => count($therapist_sessions),
			], );
		}
	}

	public function paymentsNotes(Request $request) {

		$start = $_POST['start'];
		$length = $_POST['length'];
		$search = $_POST['search']["value"];

		$therapist_id_fk = Session::get('loggedTherapist');

		$showOrder = DB::select("SELECT tbl_order_session.id, tbl_order.amount FROM `tbl_order_session`
			LEFT JOIN tbl_order ON tbl_order.id = tbl_order_session.order_id_fk
			WHERE tbl_order.therapist_id_fk =" . $therapist_id_fk . " limit " . $start . "," . $length);

		$arrayOfSession = array();

        foreach ($showOrder as $key => $value) {

        	$BookedDateget = DB::select("SELECT tbl_order_session.booking_date FROM `tbl_order_session` 
        		LEFT JOIN tbl_order ON tbl_order.id = tbl_order_session.order_id_fk
				WHERE tbl_order.therapist_id_fk =" . $therapist_id_fk);

        	$booking_dates = $BookedDateget[0]->booking_date;

			if ($booking_dates == "") {
	            $booking_dates = "";
	        } else {
	            $booking_dates = Helper::getFormatedDateForClientsDatatable($booking_dates);
	        }

	        $value->booking_date = $booking_dates;

	        $arrayOfSession[] = $value;
	    }

		$tableData['data'] = $arrayOfSession;
		$tableData['recordsTotal'] = count($arrayOfSession);

		$AllOrderData = DB::select("SELECT tbl_order_session.id, tbl_order.amount FROM `tbl_order_session`
			LEFT JOIN tbl_order ON tbl_order.id = tbl_order_session.order_id_fk
			WHERE tbl_order.therapist_id_fk =" . $therapist_id_fk);

		$tableData['recordsFiltered'] = count($AllOrderData);

		return response()->json($tableData);
	}

	public function Accept(Request $request)
	{
		$slot_id_fk = $request->input('slot_id_fk');
		$client_id_fk = $request->input('client_id_fk');
		$order_id = $request->input('oreder_id');
		$slot_id = $request->input('slot_id');
	
		$selectFromOrder = DB::select("SELECT `id`, `service_amount`, `medium_amount` FROM `tbl_order` WHERE id =" . $order_id);

		if (count($selectFromOrder) > 0) {
			
			DB::select("UPDATE `tbl_order_session` SET request_reschedule_status= 1 WHERE slot_id_fk=" . $slot_id_fk);

			DB::select("UPDATE `tbl_avalability_time_slots` SET is_booked= 0 WHERE id=" . $slot_id_fk);

			$serviceAmount = $selectFromOrder[0]->service_amount;
			$mediumAmount = $selectFromOrder[0]->medium_amount;
			$totalAmount = $serviceAmount + $mediumAmount;
			
			$wallet = new Wallet();
	        $wallet->client_id_fk = $client_id_fk;
	        $wallet->amount = $totalAmount;
			$wallet->type = "Credit";
	        $wallet->details = "Order Reschedule " . $slot_id;
	        $wallet->save();

			return response()->json([
				'status' => true,
				'message' => "Request Accepted Successfully.",
			], );
		}	
	}

	public function Reject(Request $request)
	{
		$slot_id_fk = $request->input('slot_id_fk');

		DB::select("UPDATE `tbl_order_session` SET request_reschedule_status= 2 WHERE slot_id_fk=" . $slot_id_fk);

		return response()->json([
			'status' => true,
			'message' => "Request Rejected Successfully.",
		], );
	}

	public function showCancelFormInTherapist(Request $request) {

		$therapist_id_fk = $request->input('therapist_id_fk');
		$slot_id_fk = $request->input('slot_id_fk');

		$cancelAppointmentTherapist = $this->ordersession->dataForCancelFormInTherapist($therapist_id_fk, $slot_id_fk);

		if ($cancelAppointmentTherapist == false) {
			return response()->json([
				'status' => false,
				'message' => "Data Empty",
			], );
		} else {
			$getDataForCancel = view('Website/Doctor/Dashboard/cancelAppointment', ['cancelAppointmentTherapist' => $cancelAppointmentTherapist[0]])->render();

			return response()->json([
				'status' => true,
				'cancelAppointmentTherapist' => $getDataForCancel,
				'getDataForCancel' => $cancelAppointmentTherapist,
			], );
		}
	}
}
