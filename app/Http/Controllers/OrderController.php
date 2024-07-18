<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Session;
use Validator;
use App\Models\OrderSession;
use App\Models\Wallet;


class OrderController extends Controller {
	public function showOrders(Request $request) 
	{
		$orderByIndex = $request->all()["order"][0]["column"];
		$orderByColumnName = $request->all()["columns"][$orderByIndex]["name"];

		$orderBy = $request->all()["order"][0]["dir"];

		$start = $_POST['start'];
		$length = $_POST['length'];
		$search = $_POST['search']["value"];

		$client_id_fk = Session::get('loggedUser');

		$showOrder = DB::select("SELECT tbl_order.id AS id, tbl_order.therapist_id_fk, tbl_order.amount AS amount, services.service AS serviceName, mediums.medium AS mediumName, tbl_order.created_at AS purchaseDate FROM `tbl_order`
            LEFT JOIN services ON services.id = tbl_order.service_id_fk
            LEFT JOIN mediums ON mediums.id = tbl_order.medium_id_fk
            WHERE tbl_order.client_id_fk =" . $client_id_fk . " order by " . $orderByColumnName . " " . $orderBy . " limit " . $start . "," . $length);

		$arrayOfOrder = array();

		foreach ($showOrder as $key => $value) {

			if ($value->purchaseDate == "") {
				$value->purchaseDate = "";
			} else {
				$value->purchaseDate = Helper::getFormatedDateForSessionReciept($value->purchaseDate);
			}

			$therapist_id = $value->therapist_id_fk;

			$dataForSessionDatatable = DB::select("SELECT CONCAT(first_name, ' ', last_name) AS name FROM users WHERE id = '" . $therapist_id . "' ");

			$therapistName = $dataForSessionDatatable[0]->name;
			// $DateOfBooking = $value->bookingDate;
			$medium = $value->mediumName;
			$service = $value->serviceName;

			$title = "Session with " . $therapistName . " on - (" . $service . ", " . $medium . ") ";

			$value->title = $title;

			$arrayOfOrder[] = $value;
		}

		$tableData['data'] = $arrayOfOrder;
		$tableData['recordsTotal'] = count($arrayOfOrder);

		$AllOrderData = DB::select("SELECT tbl_order.id AS id, tbl_order.amount AS amount, services.service AS serviceName, mediums.medium AS mediumName, tbl_order.created_at AS purchaseDate FROM `tbl_order`
            LEFT JOIN services ON services.id = tbl_order.service_id_fk
            LEFT JOIN mediums ON mediums.id = tbl_order.medium_id_fk
            WHERE tbl_order.client_id_fk =" . $client_id_fk);

		$tableData['recordsFiltered'] = count($AllOrderData);

		return response()->json($tableData);
	}

	public function cancelOrderClient(Request $request)
	{
		$order_session_id = $request->input('order_session_id');
		$slot_id = $request->input('slot_id');
		$order_id = $request->input('order_id');
		$client_id_fk = $request->input('client_id_fk');
		date_default_timezone_set('Asia/kolkata');
        $currentDateTime = date("h:m A d/m/Y");

		$orderCancel = DB::select("UPDATE `tbl_order_session` SET `is_cancel`= 1, `cancel_by_both`= 2, `cancel_time`='" . $currentDateTime ."' WHERE id= " . $order_session_id);
		$updateSlot = DB::select("UPDATE `tbl_avalability_time_slots` SET `is_booked`= 0 WHERE id= " . $slot_id);

		$selectFromOrder = DB::select("SELECT `id`, `service_amount`, `medium_amount` FROM `tbl_order` WHERE id =" . $order_id);

		if (count($selectFromOrder) > 0) {
			
			$serviceAmount = $selectFromOrder[0]->service_amount;
			$mediumAmount = $selectFromOrder[0]->medium_amount;
			$totalAmount = $serviceAmount + $mediumAmount;
			
			$wallet = new Wallet();
	        $wallet->client_id_fk = $client_id_fk;
	        $wallet->amount = $totalAmount;
			$wallet->type = "Credit";
	        $wallet->details = "Order Cancel " . $slot_id;
	        $wallet->save();

			return response()->json([
				'status' => true,
				'message' => "Session successfully cancelled.",
			], );
		}
	}

	public function cancelOrder(Request $request)
	{
		$validator = Validator::make($request->all(),
		[
			'reason_for_cancellation' => 'required',
		]);

		if ($validator->fails()) {
			return response()->json(['status' => false, 'message' => $validator->errors()->first()], 200);
		}

		$order_session_id = $request->input('order_session_id');
		$slot_id = $request->input('slot_id');
		$order_id = $request->input('order_id');
		$client_id_fk = $request->input('client_id_fk');

		$orderSession = OrderSession::findOrFail($order_session_id);
		$orderSession->reason_for_cancellation = $request->input('reason_for_cancellation');
		$orderSession->cancel_by = $request->input('therapist_id_fk');
		$orderSession->cancel_by_both = 1 ;
		$orderSession->save();

		$selectFromOrder = DB::select("SELECT `id`,  `service_amount`, `medium_amount` FROM `tbl_order` WHERE id =" . $order_id);
		if (count($selectFromOrder) > 0) {
			$orderCancel = DB::select("UPDATE `tbl_order_session` SET `is_cancel`= 1 WHERE id= " . $order_session_id);
			$updateSlot = DB::select("UPDATE `tbl_avalability_time_slots` SET `is_booked`= 0 WHERE id= " . $slot_id);

			$serviceAmount = $selectFromOrder[0]->service_amount;
			$mediumAmount = $selectFromOrder[0]->medium_amount;
			$totalAmount = $serviceAmount + $mediumAmount;
			
			$wallet = new Wallet();
	        $wallet->client_id_fk = $client_id_fk;
	        $wallet->amount = $totalAmount;
	        $wallet->details = "Order Cancel " . $slot_id;
			$wallet->type ="Credit";
	        $wallet->save();

			return response()->json([
				'status' => true,
				'message' => "Session successfully cancelled.",
			], );
		}
	}

	public function cancelOrderAndKeep(Request $request)
	{
		$order_session_id = $request->input('order_session_id');
		$slot_id = $request->input('slot_id');
		$order_id = $request->input('order_id');
		$client_id_fk = $request->input('client_id_fk');
		
		$selectFromOrder = DB::select("SELECT `id`,  `service_amount`, `medium_amount` FROM `tbl_order` WHERE id =" . $order_id);

		if (count($selectFromOrder) > 0) {
			$orderCancel = DB::select("UPDATE `tbl_order_session` SET `is_cancel`= 1 WHERE id= " . $order_session_id);
			$updateSlot = DB::select("UPDATE `tbl_avalability_time_slots` SET `is_booked`= 1 WHERE id= " . $slot_id);
			
			$orderSession = OrderSession::findOrFail($order_session_id);
			$orderSession->cancel_by_both = 1 ;
			$orderSession->save();

			$serviceAmount = $selectFromOrder[0]->service_amount;
			$mediumAmount = $selectFromOrder[0]->medium_amount;
			$totalAmount = $serviceAmount + $mediumAmount;
			
			$wallet = new Wallet();
	        $wallet->client_id_fk = $client_id_fk;
	        $wallet->amount = $totalAmount;
	        $wallet->details = "Order Cancel " . $slot_id;
			$wallet->type ="Credit";
	        $wallet->save();

			return response()->json([
				'status' => true,
				'message' => "Session successfully cancelled.",
			], );
		}
	}

	public function rescheduleBookingAPI(Request $request)
	{
		$validator = Validator::make($request->all(),
		[
			'slot_id_fk' => 'required',
			'old_slot_id' => 'required',
			'booking_date' => 'required',
		]);

	// 	therapist_id_pop_up: 4
	// client_id_fk: 34
	// old_slot_id: 7
	// slot_id_fk[]: 4
	// booking_date[]: 2021-12-02
	// service_id_fk: 1
	// medium_id_fk: 4

		if ($validator->fails()) {
			return response()->json(['status' => false, 'message' => $validator->errors()->first()], 200);
		}

		$order_session_id = $request->input('old_slot_id');
		$slot_id = $request->input('slot_id_fk');
		$order_date = $request->input('booking_date');
		$old_avalability_slot_id = $request->input('old_avalability_slot_id');


		foreach ($slot_id as $key => $value) {
			$orderSession = OrderSession::findOrFail($order_session_id);
			$orderSession->slot_id_fk = $value;
			$orderSession->booking_date = $order_date[0];
			$orderSession->save();
			DB::select("UPDATE `tbl_avalability_time_slots` SET `is_booked`='1' WHERE id=" . $value);
		}

		DB::select("UPDATE `tbl_avalability_time_slots` SET `is_booked`='0' WHERE id=" . $old_avalability_slot_id);

		return response()->json([
			'status' => true,
			'message' => "Session reschedule successfully.",
		], );
	}

	public function delaySessionClient(Request $request)
	{
		$validator = Validator::make($request->all(),
		[
			'slot_id' => 'required',
			'delay_session_time' => 'required',
			'reason' => 'required',
		]);

		if ($validator->fails()) {
			return response()->json(['status' => false, 'message' => $validator->errors()->first()], 200);
		}

		$orderSession = OrderSession::findOrFail($request->input("id"));
		$orderSession->delay_time = $request->input("delay_session_time");
		$orderSession->delay_reason = $request->input("reason");
		$orderSession->save();

		return response()->json([
			'status' => true,
			'message' => "Your request sent succesfull",
		], );
	}
	
	public function RequestRescheduleClient(Request $request)
	{
		$validator = Validator::make($request->all(),
		[
			'slot_id' => 'required',
			'reason' => 'required',
		]);

		if ($validator->fails()) {
			return response()->json(['status' => false, 'message' => $validator->errors()->first()], 200);
		}

		$orderSession = OrderSession::findOrFail($request->input("slot_id"));
		$orderSession->request_reschedule_status = 0;
		$orderSession->request_reschedule_reason = $request->input("reason");
		$orderSession->save();

		return response()->json([
			'status' => true,
			'message' => "Your request sent succesfull",
		], );
	}
}