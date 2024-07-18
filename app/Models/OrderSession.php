<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderSession extends Model {
	use HasFactory;

	protected $table = "tbl_order_session";

	protected $fillable = [
		'id',
		'order_id_fk',
		'booking_date',
		'slot_id_fk',
		'is_cancel',
		'delay_time',
		'delay_reason',
		'request_delay',
		'request_reschedule_status',
		'reason_for_cancellation',
		'cancel_by',
		'cancel_by_both',
		'cancel_time',
	];

	protected $primaryKey = "id";

	public function TherapistAllSessions($therapist_id_fk) {

		$therapistSessions = DB::select("SELECT tbl_order_session.id, tbl_order_session.booking_date, 
			users.first_name, tbl_order_session.cancel_time, tbl_order_session.is_cancel, tbl_order_session.no_show_by_therapist , tbl_order_session.no_show_by_client , tbl_order.id as oreder_id ,users.last_name, users.id as user_id_fk, users.middle_name, users.user_id, mediums.medium as medium_name, mediums.id as medium_id, tbl_order_session.delay_time, tbl_order_session.delay_reason, mediums.medium_img , tbl_avalability_time_slots.time_slot as start_time, tbl_avalability_time_slots.end_time_slot as end_time, therapist_address.address_title as address, therapist_address.address_line1, therapist_address.address_line2, therapist_address.landmark, therapist_address.city AS City, therapist_address.postal_code, services.service as service_name, tbl_avalability_time_slots.id AS slot_id, tbl_order_session.request_reschedule_reason, tbl_order_session.request_reschedule_status, tbl_order_session.slot_id_fk, tbl_order.homevisit_address, tbl_order.zip_code, tbl_order.phone_no, tbl_order.country, tbl_order.city, tbl_order.state, tbl_order_session.cancel_by_both 
			FROM `tbl_order_session`
			LEFT JOIN tbl_order ON tbl_order.id = tbl_order_session.order_id_fk
			LEFT JOIN users ON users.id = tbl_order.client_id_fk
			LEFT JOIN tbl_avalability_time_slots ON tbl_avalability_time_slots.id = tbl_order_session.slot_id_fk
			LEFT JOIN therapist_address ON therapist_address.id = tbl_avalability_time_slots.location
			LEFT JOIN mediums ON mediums.id = tbl_order.medium_id_fk
			LEFT JOIN services ON services.id =tbl_order.service_id_fk
			WHERE tbl_order.therapist_id_fk =" . $therapist_id_fk);

		if (count($therapistSessions) == false) {
			return false;
		} else {
			return $therapistSessions;
		}
	}

	public function ClientAllSessions($client_id_fk) {

		$sessionsBookedByClient = DB::select("SELECT tbl_order.id as order_id, tbl_order.therapist_id_fk as therapist_id, mediums.id as medium_id, tbl_order_session.id, tbl_order_session.booking_date, users.first_name, users.last_name, users.middle_name, mediums.medium as medium_name, mediums.medium_img , tbl_avalability_time_slots.time_slot as start_time, tbl_avalability_time_slots.end_time_slot as end_time, therapist_address.address_title as address, therapist_address.address_line1, therapist_address.address_line2, therapist_address.landmark, therapist_address.city AS City, therapist_address.postal_code, services.service as service_name,
		   tbl_avalability_time_slots.id AS slot_id, tbl_order_session.slot_id_fk, tbl_order_session.request_reschedule_status, tbl_order.homevisit_address, tbl_order.zip_code, tbl_order.phone_no, tbl_order.country, tbl_order.city, tbl_order.state, tbl_order_session.cancel_by_both, tbl_order_session.no_show_by_therapist, tbl_order_session.no_show_by_client
			FROM `tbl_order_session`
			LEFT JOIN tbl_order ON tbl_order.id = tbl_order_session.order_id_fk
			LEFT JOIN users ON users.id = tbl_order.therapist_id_fk
			LEFT JOIN tbl_avalability_time_slots ON tbl_avalability_time_slots.id = tbl_order_session.slot_id_fk
			LEFT JOIN therapist_address ON therapist_address.id = tbl_avalability_time_slots.location
			LEFT JOIN mediums ON mediums.id = tbl_order.medium_id_fk
			LEFT JOIN services ON services.id =tbl_order.service_id_fk
			WHERE tbl_order.client_id_fk =" . $client_id_fk);

		if (count($sessionsBookedByClient) == false) {
			return false;
		} else {
			return $sessionsBookedByClient;
		}
	}

	public function dataForReqRescheduleForm($client_id_fk, $slot_id_fk) {

		$rescheduleRequest = DB::select("SELECT tbl_order.id as order_id, tbl_order.therapist_id_fk as therapist_id, mediums.id as medium_id, users.user_id,
		 tbl_order_session.id, tbl_order_session.booking_date, users.first_name, 
		 users.last_name, users.middle_name, mediums.medium as medium_name,
		  mediums.medium_img , tbl_avalability_time_slots.time_slot as start_time, 
		  tbl_avalability_time_slots.end_time_slot as end_time, 
		  therapist_address.address_title as address, services.service as service_name,
		   tbl_avalability_time_slots.id AS slot_id, tbl_order_session.slot_id_fk 
			FROM `tbl_order_session`
			LEFT JOIN tbl_order ON tbl_order.id = tbl_order_session.order_id_fk
			LEFT JOIN users ON users.id = tbl_order.therapist_id_fk
			LEFT JOIN tbl_avalability_time_slots ON tbl_avalability_time_slots.id = tbl_order_session.slot_id_fk
			LEFT JOIN therapist_address ON therapist_address.id = tbl_avalability_time_slots.location
			LEFT JOIN mediums ON mediums.id = tbl_order.medium_id_fk
			LEFT JOIN services ON services.id =tbl_order.service_id_fk
			WHERE tbl_order_session.is_cancel = 0 AND tbl_order.client_id_fk =" . $client_id_fk . " AND tbl_order_session.slot_id_fk=" . $slot_id_fk);

		if (count($rescheduleRequest) == false) {
			return false;
		} else {
			return $rescheduleRequest;
		}
	}

	public function dataForCancelFormInTherapist($therapist_id_fk, $slot_id_fk) {

		$cancelAppointment = DB::select("SELECT tbl_order.id as order_id, tbl_order.client_id_fk ,tbl_order.therapist_id_fk as therapist_id, mediums.id as medium_id, users.user_id,
		 tbl_order_session.id, tbl_order_session.booking_date, users.first_name, 
		 users.last_name, users.middle_name, mediums.medium as medium_name,
		  mediums.medium_img , tbl_avalability_time_slots.time_slot as start_time, 
		  tbl_avalability_time_slots.end_time_slot as end_time, 
		  therapist_address.address_title as address, services.service as service_name,
		   tbl_avalability_time_slots.id AS slot_id, tbl_order_session.slot_id_fk 
			FROM `tbl_order_session`
			LEFT JOIN tbl_order ON tbl_order.id = tbl_order_session.order_id_fk
			LEFT JOIN users ON users.id = tbl_order.client_id_fk
			LEFT JOIN tbl_avalability_time_slots ON tbl_avalability_time_slots.id = tbl_order_session.slot_id_fk
			LEFT JOIN therapist_address ON therapist_address.id = tbl_avalability_time_slots.location
			LEFT JOIN mediums ON mediums.id = tbl_order.medium_id_fk
			LEFT JOIN services ON services.id =tbl_order.service_id_fk
			WHERE tbl_order_session.is_cancel = 0 AND tbl_order.therapist_id_fk =" . $therapist_id_fk . " AND tbl_order_session.slot_id_fk=" . $slot_id_fk);

		if (count($cancelAppointment) == false) {
			return false;
		} else {
			return $cancelAppointment;
		}
	}

	public function dataForCancelFormInClient($client_id_fk, $slot_id_fk) {

		$rescheduleRequest = DB::select("SELECT tbl_order.id as order_id, tbl_order.therapist_id_fk as therapist_id, mediums.id as medium_id, users.user_id,
		 tbl_order_session.id, tbl_order_session.booking_date, users.first_name, 
		 users.last_name, users.middle_name, mediums.medium as medium_name,
		  mediums.medium_img , tbl_avalability_time_slots.time_slot as start_time, 
		  tbl_avalability_time_slots.end_time_slot as end_time, 
		  therapist_address.address_title as address, services.service as service_name,
		   tbl_avalability_time_slots.id AS slot_id, tbl_order_session.slot_id_fk 
			FROM `tbl_order_session`
			LEFT JOIN tbl_order ON tbl_order.id = tbl_order_session.order_id_fk
			LEFT JOIN users ON users.id = tbl_order.therapist_id_fk
			LEFT JOIN tbl_avalability_time_slots ON tbl_avalability_time_slots.id = tbl_order_session.slot_id_fk
			LEFT JOIN therapist_address ON therapist_address.id = tbl_avalability_time_slots.location
			LEFT JOIN mediums ON mediums.id = tbl_order.medium_id_fk
			LEFT JOIN services ON services.id =tbl_order.service_id_fk
			WHERE tbl_order_session.is_cancel = 0 AND tbl_order.client_id_fk =" . $client_id_fk . " AND tbl_order_session.slot_id_fk=" . $slot_id_fk);

		if (count($rescheduleRequest) == false) {
			return false;
		} else {
			return $rescheduleRequest;
		}
	}
}