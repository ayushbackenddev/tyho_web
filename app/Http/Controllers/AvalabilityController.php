<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Avalability;
use App\Models\AvalabilityOfSlot;
use Illuminate\Http\Request;
use Response;
use Session;
use Validator;

class AvalabilityController extends Controller {
	public function __construct(Avalability $avalability) {
		$this->avalability = $avalability;
	}

	public function slotsAddForBooking(Request $request) {
		$validator = Validator::make($request->all(),
			[
				// 'time_slot' => 'required',
			]);

		$avalability_id_fk = $request->input('avalability_id_fk');

		if ($avalability_id_fk == "") {

			if ($validator->fails()) {
				return response()->json(['status' => false, 'message' => $validator->errors()->first()], 200);
			}

			$avalability = new Avalability();
			$avalability->therapist_id_fk = Session::get('loggedTherapist');
			$date = $request->input('date');

			$getDate = date_create($date);

			$avalability->slot_date = date_format($getDate, "Y-m-d");
			$avalability->save();

			$avalability_Id_FK = $avalability->id;

			$slotAdd = $request->input('time_slot');
			$addVideo = $request->input('video');
			$addAudio = $request->input('audio');
			$addTextBasedChat = $request->input('textbasedchat');
			$addInPerson = $request->input('inperson');
			$addHomeVisit = $request->input('homevisit');
			$addLocation = $request->input('location');

			if($slotAdd != null){
				for ($i = 0; $i < count($slotAdd); $i++) {

					$SlotTime = $slotAdd[$i];
					$Video = $addVideo[$i];
					$Audio = $addAudio[$i];
					$TextBased = $addTextBasedChat[$i];
					$InPerson = $addInPerson[$i];
					$HomeVisit = $addHomeVisit[$i];
					$location = $addLocation[$i];
	
					$slotAvalability = new AvalabilityOfSlot();
					$slotAvalability->avalability_id_fk = $avalability_Id_FK;
					$slotAvalability->time_slot = $SlotTime;
					$timestamp = strtotime($SlotTime) + 60 * 60;
					$slotAvalability->end_time_slot = date('h:i A', $timestamp);
	
					$slotAvalability->video = $Video;
					$slotAvalability->audio = $Audio;
					$slotAvalability->textbasedchat = $TextBased;
					$slotAvalability->inperson = $InPerson;
					$slotAvalability->homevisit = $HomeVisit;
					$slotAvalability->location = $location;
					$slotAvalability->save();
				}
	
				return response()->json([
					'status' => true,
					'message' => "Slot added successfully",
				], );
			}else{
				return response()->json([
					'status' => false,
					'message' => "Please enter slot time",
				], );
			}
		} else {
			if ($validator->fails()) {
				return response()->json(['status' => false, 'message' => $validator->errors()->first()], 200);
			}

			$deleted_time_slot = $request->input('deleted_time_slot');

			if (isset($deleted_time_slot)) 
			{
				for ($i = 0; $i < count($deleted_time_slot); $i++) 
				{
					$avlabilityOfSlot = AvalabilityOfSlot::findOrFail($deleted_time_slot[$i]);
					$avlabilityOfSlot->delete();
				}
			}
			


			$slotAdd = $request->input('time_slot');

			if (!isset($slotAdd)) {
				return response()->json(['status' => true, 'message' => "Slots are updated"], 200);

			}

			$avalability = Avalability::findOrFail($avalability_id_fk);

			$date = $request->input('date');
			$getDate = date_create($date);
			$avalability->slot_date = date_format($getDate, "Y-m-d");
			$avalability->save();

			$avalability_Id_FK = $avalability->id;

			// $delete = DB::delete("DELETE FROM `tbl_avalability_time_slots` WHERE avalability_id_fk =" . $avalability_Id_FK);
			
			

			$addVideo = $request->input('video');
			$addAudio = $request->input('audio');
			$addTextBasedChat = $request->input('textbasedchat');
			$addInPerson = $request->input('inperson');
			$addHomeVisit = $request->input('homevisit');
			$addLocation = $request->input('location');

			for ($i = 0; $i < count($slotAdd); $i++) {

				$SlotTime = $slotAdd[$i];
				$Video = $addVideo[$i];
				$Audio = $addAudio[$i];
				$TextBased = $addTextBasedChat[$i];
				$InPerson = $addInPerson[$i];
				$HomeVisit = $addHomeVisit[$i];
				$location = $addLocation[$i];

				$slotAvalability = new AvalabilityOfSlot();
				$slotAvalability->avalability_id_fk = $avalability_Id_FK;
				$slotAvalability->time_slot = $SlotTime;
				$timestamp = strtotime($SlotTime) + 60 * 60;
				$slotAvalability->end_time_slot = date('h:i A', $timestamp);
				$slotAvalability->video = $Video;
				$slotAvalability->audio = $Audio;
				$slotAvalability->textbasedchat = $TextBased;
				$slotAvalability->inperson = $InPerson;
				$slotAvalability->homevisit = $HomeVisit;
				$slotAvalability->location = $location;
				$slotAvalability->save();
			}

			return response()->json([
				'status' => true,
				'message' => "Slot Update successfully",
			], );
		}
	}

	public function getDataByDateAndTherapistId(Request $request) {

		$therapist_id_fk = $request->input('therapist_id_fk');
		$date = $request->input('date');

		$getDataByDate = $this->avalability->getData($therapist_id_fk, $date);
		$bookedSlot = $this->avalability->bookedSlotCount($therapist_id_fk, $date);
		$availableSlot = $this->avalability->availableSlotCount($therapist_id_fk, $date);

		if ($getDataByDate != "") {
			for ($i = 0; $i < count($getDataByDate); $i++) {
				$checkingSlotStatus = $getDataByDate[$i]->is_booked;
				$getDataByDate[$i]->alreadyBooked = $checkingSlotStatus;
			}

			if ($getDataByDate == false) {
				return response()->json([
					'status' => false,
					'message' => "Data Empty",
				], );
			} else {
				return response()->json([
					'status' => true,
					'getAllDataByDateAndId' => $getDataByDate,
					'countAvailableSlot' => $availableSlot == false ? 0 : count($availableSlot),
					'countBookedSlot' => $bookedSlot == false ? 0 : count($bookedSlot),

				], );
			}
		}
	}

	public function getDataByDate(Request $request) {

		$therapist_id_fk = $request->input('therapist_id_fk');
		$date = $request->input('date');

		$DataByDate = $this->avalability->getData($therapist_id_fk, $date);
		$bookedSlot = $this->avalability->bookedSlotCount($therapist_id_fk, $date);
		$availableSlot = $this->avalability->availableSlotCount($therapist_id_fk, $date);

		if ($DataByDate != "") {
			for ($i = 0; $i < count($DataByDate); $i++) {
				$slotStatus = $DataByDate[$i]->is_booked;
				$DataByDate[$i]->alreadyBooked = $slotStatus;
			}

			if ($DataByDate == false) {
				return response()->json([
					'status' => false,
					'message' => "Data Empty",
				], );
			} else {
				return response()->json([
					'status' => true,
					'getAllDataByDate' => $DataByDate,
					'countAvailableSlot' => $availableSlot == false ? 0 : count($availableSlot),
					'countBookedSlot' => $bookedSlot == false ? 0 : count($bookedSlot),
				], );
			}
		}
	}

	public function getLocation(Request $request) {

		$therapist_id_fk = Session::get('loggedTherapist');

		$getAddressByTherapist = $this->avalability->getAddressTitleForLocation($therapist_id_fk);

		if ($getAddressByTherapist == false) {

			return response()->json([
				'status' => false,
				'message' => "No address found.",
			], );
		} else {

			return response()->json([
				'status' => true,
				'address' => $getAddressByTherapist,
			], );
		}
	}

	public function addBulkSlot(Request $request) {

		$start_time = $request->input('time_slot');
		$end_time = $request->input('end_time_slot');
		$gap = $request->input('gap') == "" ? 0 : $request->input('gap');

		$timeDifference = 60;

		$start_time = strtotime($start_time);
		$end_time = strtotime($end_time);

		$slot = strtotime(date('g:i A', $start_time) . ' +' . $timeDifference . ' minutes');

		$arrayOfSlot = [];

		for ($i = 0; $slot <= $end_time; $i++) {

			$arrayOfSlot[$i] = [
				'start' => date('g:i A', $start_time),
				'end' => date('g:i A', $slot),
			];

			$start_time = $slot;

			$start_time = strtotime(date('g:i A', $start_time) . ' +' . $gap . ' minutes');

			$slot = strtotime(date('g:i A', $start_time) . ' +' . $timeDifference . ' minutes');
		}

		$therapist_id_fk = Session::get('loggedTherapist');

		$getView = view('Website/Doctor/BulkSlot/addBulkSlot', ['arrayOfSlot' => $arrayOfSlot,'therapist_id_fk'=>$therapist_id_fk])->render();

		return response()->json([
			'status' => true,
			'bulkslot' => $getView,
		], );
	}

	public function addSelectedBulkSlot(Request $request) {
		$validator = Validator::make($request->all(),
			[
				'time_slot' => 'required',
				'end_time_slot' => 'required',
				'days' => 'required',
				'start_date' => 'required',
				'end_date_peroid' => 'required',
				
			]);

		if ($validator->fails()) {
			return response()->json(['status' => false, 'message' => $validator->errors()->first()], 200);
		}

		$startDate = $request->input('start_date');
		$endPeroidDate = $request->input('end_date_peroid');
		$days = $request->input('days');
		$TherapistId = Session::get('loggedTherapist');
		$time_slot = $request->input('time_slot');
		$end_time_slot = $request->input('end_time_slot');
		$video = $request->input('video');
		$audio = $request->input('audio');
		$textbasedchat = $request->input('textbasedchat');
		$inperson = $request->input('inperson');
		$homevisit = $request->input('homevisit');
		$addLocation = $request->input('location');

		$start_date = strtotime($startDate);

		$end_date = strtotime(date('Y-m-d', $start_date) . ' +' . $endPeroidDate . ' days');

		$arrayOfTime = [];

		for ($i = 0; $start_date < $end_date; $i++) {

			if (in_array(date('D', $start_date), $days)) {

				$dateOverlapping = $this->avalability->dateOverlapping($TherapistId, date('Y-m-d', $start_date));

				if ($dateOverlapping == false) {

					$avalability = new Avalability();
					$avalability->therapist_id_fk = $TherapistId;
					$avalability->slot_date = date('Y-m-d', $start_date);
					$avalability->save();

					$avalability_Id_FK = $avalability->id;

				} else {

					$avalability = Avalability::findOrFail($dateOverlapping->id);
					$avalability_Id_FK = $avalability->id;
				}

				// $avalability = new Avalability();
				// $avalability->therapist_id_fk = $TherapistId;
				// $avalability->slot_date = date('Y-m-d', $start_date);
				// $avalability->save();

				// $avalability_Id_FK = $avalability->id;

				for ($i = 0; $i < count($time_slot); $i++) {

					$StartTime = $time_slot[$i];
					$endTime = $end_time_slot[$i];
					$Video = isset($video[$i]) ? $video[$i] : 0;
					$Audio = isset($audio[$i]) ? $audio[$i] : 0;
					$TextBased = isset($textbasedchat[$i]) ? $textbasedchat[$i] : 0;
					$InPerson = isset($inperson[$i]) ? $inperson[$i] : 0;
					$HomeVisit = isset($homevisit[$i]) ? $homevisit[$i] : 0;
					// $location = $addLocation[$i];

					$checkForOverlapping = $this->avalability->allowUserToOverlap($StartTime, $TherapistId, date('Y-m-d', $start_date), $endTime);

					if ($checkForOverlapping == false) {
						$slotAvalability = new AvalabilityOfSlot();
						$slotAvalability->avalability_id_fk = $avalability_Id_FK;
						$slotAvalability->time_slot = $StartTime;
						$slotAvalability->end_time_slot = $endTime;
						$slotAvalability->video = $Video;
						$slotAvalability->audio = $Audio;
						$slotAvalability->textbasedchat = $TextBased;
						$slotAvalability->inperson = $InPerson;
						$slotAvalability->homevisit = $HomeVisit;
						// $slotAvalability->location = $location;
						$slotAvalability->save();
					} else {

						// if ($checkForOverlapping->is_booked == 0) {
							$slotAvalability = new AvalabilityOfSlot();
							$slotAvalability->time_slot = $StartTime;
							$slotAvalability->end_time_slot = $endTime;
							$slotAvalability->video = $Video;
							$slotAvalability->audio = $Audio;
							$slotAvalability->textbasedchat = $TextBased;
							$slotAvalability->inperson = $InPerson;
							$slotAvalability->homevisit = $HomeVisit;
							// $slotAvalability->location = $location;
							$slotAvalability->save();
						// }
					}

					// print_r($checkForOverlapping[0]->id);
					// die();

					// if ($checkForOverlapping != false) {

					// $slotAvalability = AvalabilityOfSlot::findOrFail($checkForOverlapping[0]->id);
					// $slotAvalability->avalability_id_fk = $avalability_Id_FK;
					// $slotAvalability->time_slot = $StartTime;
					// $slotAvalability->end_time_slot = $endTime;
					// $slotAvalability->video = $Video;
					// $slotAvalability->audio = $Audio;
					// $slotAvalability->textbasedchat = $TextBased;
					// $slotAvalability->inperson = $InPerson;
					// $slotAvalability->homevisit = $HomeVisit;
					// // $slotAvalability->location = $location;
					// $slotAvalability->save();
					// } else {

					// $slotAvalability = new AvalabilityOfSlot();
					// $slotAvalability->avalability_id_fk = $avalability_Id_FK;
					// $slotAvalability->time_slot = $StartTime;
					// $slotAvalability->end_time_slot = $endTime;
					// $slotAvalability->video = $Video;
					// $slotAvalability->audio = $Audio;
					// $slotAvalability->textbasedchat = $TextBased;
					// $slotAvalability->inperson = $InPerson;
					// $slotAvalability->homevisit = $HomeVisit;
					// // $slotAvalability->location = $location;
					// $slotAvalability->save();
					//}
				}
			}
			$start_date = strtotime(date('Y-m-d', $start_date) . ' +1 days');
		}

		return response()->json([
			'status' => true,
			'message' => "Bulk slot added successfully",
		], );
	}
}
