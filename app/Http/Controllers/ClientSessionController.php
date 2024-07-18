<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\OrderSession;
use Illuminate\Http\Request;
use Response;
use Session, Validator;
use Illuminate\Support\Facades\DB;

class ClientSessionController extends Controller {
	public function __construct(OrderSession $ordersession) {
		$this->ordersession = $ordersession;
	}

	public function showBookedSessionsByClient(Request $request) {

		$client_id_fk = $request->input('client_id_fk');

		$client_session = $this->ordersession->ClientAllSessions($client_id_fk);

		if ($client_session == false) {
			return response()->json([
				'status' => false,
				'message' => "Data Empty",
			], );
		} else {
			$getView = view('Website/User/Dashboard/client_session_dashboard', ['client_session' => $client_session])->render();

			return response()->json([
				'status' => true,
				'client_session' => $getView,
				'client_session_count' => count($client_session),
			], );
		}
	}

	public function showRequestReschedule(Request $request) {

		$client_id_fk = $request->input("client_id_fk");
		$slot_id_fk = $request->input("slot_id_fk");

		$ReqRescheduleData = $this->ordersession->dataForReqRescheduleForm($client_id_fk, $slot_id_fk);

		if ($ReqRescheduleData == false) {
			return response()->json([
				'status' => false,
				'message' => "Data Empty",
			], );
		} else {
			$getData = view('Website/User/Dashboard/request_reschedule', ['ReqRescheduleData' => $ReqRescheduleData[0]])->render();

			return response()->json([
				'status' => true,
				'ReqRescheduleData' => $getData,
				'getData' => $ReqRescheduleData,
			], );
		}
	}

	public function RequestRescheduleForm(Request $request)
	{
		$validator = Validator::make($request->all(),
		[
			'reason' => 'required',
		]);

		if ($validator->fails()) {
			return response()->json(['status' => false, 'message' => $validator->errors()->first()], 200);
		}

		$slot_id = $request->input("slot_id");

		$orderSession = OrderSession::findOrFail($slot_id);
		$orderSession->request_reschedule_status = 0;
		$orderSession->request_reschedule_reason = $request->input("reason");
		$orderSession->save();

		return response()->json([
			'status' => true,
			'message' => "Your request sent succesfully",
		], );
	}

	public function showCancelForm(Request $request) {

		$client_id_fk = $request->input('client_id_fk');
		$slot_id_fk = $request->input("slot_id_fk");

		$cancelAppointment = $this->ordersession->dataForCancelFormInClient($client_id_fk, $slot_id_fk);

		if ($cancelAppointment == false) {
			return response()->json([
				'status' => false,
				'message' => "Data Empty",
			], );
		} else {
			$getDataForCancel = view('Website/User/Dashboard/cancel_appointment', ['cancelAppointment' => $cancelAppointment[0]])->render();

			return response()->json([
				'status' => true,
				'cancelAppointment' => $getDataForCancel,
				'getDataForCancel' => $cancelAppointment,
			], );
		}
	}
}