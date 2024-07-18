<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AvalabilityOfSlot;

class Avalability extends Model {
	use HasFactory;

	protected $table = "tbl_avalability";

	protected $fillable = [
		'id',
		'therapist_id_fk',
		'slot_date',
	];

	protected $primaryKey = "id";

	public function getData($therapist_id_fk, $date) {

		$getDataByDateAndId = DB::select("SELECT tbl_avalability_time_slots.id,tbl_avalability_time_slots.avalability_id_fk, tbl_avalability_time_slots.time_slot, tbl_avalability_time_slots.end_time_slot, tbl_avalability_time_slots.audio, tbl_avalability_time_slots.video, tbl_avalability_time_slots.textbasedchat, tbl_avalability_time_slots.inperson, tbl_avalability_time_slots.homevisit, tbl_avalability_time_slots.is_booked FROM `tbl_avalability_time_slots`
			LEFT JOIN tbl_avalability ON tbl_avalability_time_slots.avalability_id_fk = tbl_avalability.id
			WHERE tbl_avalability.therapist_id_fk = " . $therapist_id_fk . " and tbl_avalability.slot_date ='" . $date . "' ORDER BY tbl_avalability_time_slots.time_slot ASC");

		if ($getDataByDateAndId == false) {
			return false;
		} else {
			return $getDataByDateAndId;
		}
	}

	public function getAddressTitleForLocation($therapist_id_fk) {
		$getAddressTitle = DB::select("SELECT therapist_address.id, `address_title` FROM `therapist_address`
		LEFT JOIN onboardings ON therapist_address.onboarding_id = onboardings.id
		WHERE onboardings.therapist_id_fk =" . $therapist_id_fk);

		if (count($getAddressTitle) == false) {
			return false;
		} else {
			return $getAddressTitle;
		}
	}

	public function getBookedSessions($avalabilityId) {
		$getBookedSlots = DB::select("SELECT id, `slot_id_fk` FROM `tbl_order_session` WHERE slot_id_fk =" . $avalabilityId);

		if (count($getBookedSlots) == false) {
			return false;
		} else {
			return true;
		}
	}

	public function dateOverlapping($TherapistId, $slot_date) {

		$getBookedSlots = DB::select("SELECT * FROM tbl_avalability where therapist_id_fk =" . $TherapistId . " AND slot_date = '" . $slot_date . "'");
		if (count($getBookedSlots) == 0) {
			return false;
		} else {
			return $getBookedSlots[0];
		}

	}

	public function allowUserToOverlap($StartTime, $TherapistId, $slot_date, $endTime) {

		$getBookedSlots = DB::select("SELECT tbl_avalability_time_slots.id,is_booked FROM tbl_avalability_time_slots LEFT JOIN tbl_avalability ON tbl_avalability.id = tbl_avalability_time_slots.avalability_id_fk where
			(UNIX_TIMESTAMP(STR_TO_DATE('20131111 $StartTime','%Y%m%d%h:%i%p')) >
			UNIX_TIMESTAMP(STR_TO_DATE(CONCAT('20131111',time_slot),'%Y%m%d%h:%i%p')) AND UNIX_TIMESTAMP(STR_TO_DATE('20131111 $StartTime','%Y%m%d%h:%i%p')) <
			UNIX_TIMESTAMP(STR_TO_DATE(CONCAT('20131111',end_time_slot),'%Y%m%d%h:%i%p'))) OR (UNIX_TIMESTAMP(STR_TO_DATE('20131111 $endTime','%Y%m%d%h:%i%p')) >
			UNIX_TIMESTAMP(STR_TO_DATE(CONCAT('20131111',time_slot),'%Y%m%d%h:%i%p')) AND UNIX_TIMESTAMP(STR_TO_DATE('20131111 $endTime','%Y%m%d%h:%i%p')) <
			UNIX_TIMESTAMP(STR_TO_DATE(CONCAT('20131111',end_time_slot),'%Y%m%d%h:%i%p'))) AND tbl_avalability.therapist_id_fk =" . $TherapistId . " AND slot_date = '" . $slot_date . "'");


		// print_r("SELECT tbl_avalability_time_slots.id,is_booked FROM tbl_avalability_time_slots LEFT JOIN tbl_avalability ON tbl_avalability.id = tbl_avalability_time_slots.avalability_id_fk where
		// (UNIX_TIMESTAMP(STR_TO_DATE('20131111 $StartTime','%Y%m%d%h:%i%p')) >
		// UNIX_TIMESTAMP(STR_TO_DATE(CONCAT('20131111',time_slot),'%Y%m%d%h:%i%p')) AND UNIX_TIMESTAMP(STR_TO_DATE('20131111 $StartTime','%Y%m%d%h:%i%p')) <
		// UNIX_TIMESTAMP(STR_TO_DATE(CONCAT('20131111',end_time_slot),'%Y%m%d%h:%i%p'))) OR (UNIX_TIMESTAMP(STR_TO_DATE('20131111 $endTime','%Y%m%d%h:%i%p')) >
		// UNIX_TIMESTAMP(STR_TO_DATE(CONCAT('20131111',time_slot),'%Y%m%d%h:%i%p')) AND UNIX_TIMESTAMP(STR_TO_DATE('20131111 $endTime','%Y%m%d%h:%i%p')) <
		// UNIX_TIMESTAMP(STR_TO_DATE(CONCAT('20131111',end_time_slot),'%Y%m%d%h:%i%p'))) AND tbl_avalability.therapist_id_fk =" . $TherapistId . " AND slot_date = '" . $slot_date . "'");
		if (count($getBookedSlots) == 0) {
			return false;
		} else {

			$needToRemove = true;
			foreach ($getBookedSlots as $key => $value) {
				if ($value->is_booked == 1)
				{
					
					$needToRemove = false;
					
				}
			}

			
			$status_array = array();

			if ($needToRemove == true)
			{
				foreach ($getBookedSlots as $key => $value) {
					$slotAvalability = AvalabilityOfSlot::findOrFail($value->id);	
					$status = $slotAvalability->delete();
					$status_array[] = $status;
				}
			}

			// print_r($status_array);
			// die;

			
			return false;
		}
	}

	public function bookedSlotCount($therapist_id_fk, $date) {

		$bookedSlot = DB::select("SELECT tbl_avalability_time_slots.id, tbl_avalability.therapist_id_fk, tbl_avalability.slot_date FROM `tbl_avalability_time_slots`
			LEFT JOIN tbl_avalability ON tbl_avalability.id = tbl_avalability_time_slots.avalability_id_fk
			WHERE tbl_avalability.therapist_id_fk = '" . $therapist_id_fk . "' AND tbl_avalability.slot_date = '" . $date . "' AND tbl_avalability_time_slots.is_booked = 1 ");

		if (count($bookedSlot) == 0) {
			return false;
		} else {
			return $bookedSlot;
		}
	}

	public function availableSlotCount($therapist_id_fk, $date) {

		$availableSlot = DB::select("SELECT tbl_avalability_time_slots.id, tbl_avalability.therapist_id_fk, tbl_avalability.slot_date FROM `tbl_avalability_time_slots`
			LEFT JOIN tbl_avalability ON tbl_avalability.id = tbl_avalability_time_slots.avalability_id_fk
			WHERE tbl_avalability.therapist_id_fk = '" . $therapist_id_fk . "' AND tbl_avalability.slot_date = '" . $date . "' AND tbl_avalability_time_slots.is_booked = 0 ");

		if (count($availableSlot) == 0) {
			return false;
		} else {
			return $availableSlot;
		}
	}
}
