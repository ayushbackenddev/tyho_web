<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model {
	use HasFactory;

	public function showBookingPageLeftSideData($client_id_fk) {
		$selectLeftData = DB::select("SELECT tbl_cart.id, tbl_cart.therapist_id_fk, tbl_cart.discount_coupon, `client_id_fk`, users.first_name, users.middle_name, users.last_name, services.service, mediums.medium, tbl_cart.service_id_fk, tbl_cart.medium_id_fk FROM `tbl_cart`
            LEFT JOIN services ON tbl_cart.service_id_fk = services.id
            LEFT JOIN mediums ON tbl_cart.medium_id_fk = mediums.id
            LEFT JOIN users ON tbl_cart.therapist_id_fk = users.id
            WHERE client_id_fk =" . $client_id_fk);

		if (count($selectLeftData) == 0) {
			return false;
		} else {
			return $selectLeftData;
		}
	}

	public function showBookingPageRightSideData($client_id_fk) {
		$selectRightData = DB::select("SELECT tbl_cart.id,  tbl_cart.discount_coupon,`client_id_fk`, tbl_avalability_time_slots.time_slot, tbl_avalability_time_slots.end_time_slot, tbl_cart_session.booking_date, tbl_cart_session.slot_id_fk, therapist_address.address_title, tbl_avalability_time_slots.homevisit FROM `tbl_cart_session`
            LEFT JOIN tbl_cart ON tbl_cart.id = tbl_cart_session.cart_id_fk
            LEFT JOIN tbl_avalability_time_slots ON tbl_cart_session.slot_id_fk = tbl_avalability_time_slots.id
            LEFT JOIN therapist_address ON tbl_avalability_time_slots.location = therapist_address.id
            WHERE client_id_fk =" . $client_id_fk);

		if (count($selectRightData) == false) {
			return false;
		} else {
			return $selectRightData;
		}
	}

	public function showBookingSlots($client_id_fk) {
		$bookingSlots = DB::select("SELECT tbl_cart.id, tbl_cart.discount_coupon, `client_id_fk`, tbl_avalability_time_slots.time_slot, 
		tbl_avalability_time_slots.end_time_slot, tbl_cart_session.booking_date, tbl_cart_session.slot_id_fk, 
		therapist_address.address_title FROM `tbl_cart_session`
		LEFT JOIN tbl_cart ON tbl_cart.id = tbl_cart_session.cart_id_fk
		LEFT JOIN tbl_avalability_time_slots ON tbl_cart_session.slot_id_fk = tbl_avalability_time_slots.id
		LEFT JOIN therapist_address ON tbl_avalability_time_slots.location = therapist_address.id
		WHERE client_id_fk =" . $client_id_fk);

		if (count($bookingSlots) == 0) {
			return false;
		} else {
			return $bookingSlots;
		}
	}


	public function hasHomeVisit($client_id_fk) {
		$bookingSlots = DB::select("SELECT tbl_cart.id, `client_id_fk`, tbl_avalability_time_slots.time_slot, 
		tbl_avalability_time_slots.end_time_slot, tbl_cart_session.booking_date, tbl_cart_session.slot_id_fk, 
		therapist_address.address_title FROM `tbl_cart_session`
		LEFT JOIN tbl_cart ON tbl_cart.id = tbl_cart_session.cart_id_fk
		LEFT JOIN tbl_avalability_time_slots ON tbl_cart_session.slot_id_fk = tbl_avalability_time_slots.id
		LEFT JOIN therapist_address ON tbl_avalability_time_slots.location = therapist_address.id
		WHERE client_id_fk =" . $client_id_fk." and medium_id_fk = 5");

		if (count($bookingSlots) == 0) {
			return false;
		} else {
			return true;
		}
	}

	public function sessionExist($client_id_fk) {
		$selectRightData = DB::select("SELECT tbl_cart.id FROM `tbl_cart_session`
            LEFT JOIN tbl_cart ON tbl_cart.id = tbl_cart_session.cart_id_fk
            LEFT JOIN tbl_avalability_time_slots ON tbl_cart_session.slot_id_fk = tbl_avalability_time_slots.id
            WHERE client_id_fk =" . $client_id_fk);

		if (count($selectRightData) == 0) {
			return false;
		} else {
			return true;
		}

	}
	public function mywalletacount($client_id_fk){
		$mywallet = DB::select('SELECT client_id_fk, details, amount, type  FROM tbl_wallet WHERE client_id_fk ='.$client_id_fk );
		$creaditamount = 0;
		$debitamount = 0;
		$walletbalane = 0;
		if(count($mywallet) > 0 ){
			foreach($mywallet as $key => $value){
				if($value->type == "Credit"){
					$creaditamount += $value->amount;
					
				}else{
					$debitamount += $value->amount;	
					
				}
			}
			$walletbalane = $creaditamount - $debitamount ;
		
			return $walletbalane ;
		}else{
			return $walletbalane;
		}
	}
}
