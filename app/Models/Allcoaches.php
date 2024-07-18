<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Allcoaches extends Model {
	use HasFactory;

	public function AllTherapistData() {

		$therapistData = DB::select("SELECT users.id AS id, users.first_name, users.middle_name, users.last_name, therapist_details.therapist_occupation, therapist_details.short_description_1, therapist_details.category_of_therapist, therapist_details.profile_photo, therapist_details.video, therapist_details.service_id_fk, therapist_details.medium_id_fk FROM `users`
			LEFT JOIN therapist_details ON users.id = therapist_details.therapist_id_FK
            LEFT JOIN applications ON users.id = applications.therapist_id_FK WHERE usertype = 2");

		if (count($therapistData) == false) {
			return false;
		} else {
			return $therapistData;
		}
	}

	public function getAllTherapistData($mood_regulation, $family_and_relationships, $academic_or_work_related, $personal, $other, $language, $medium, $service, $countries, $gender, $category_of_therapist) {

		$therapistData = DB::table("users")->select('users.id', 'applications.mood_regulation', 'applications.gender', 'users.first_name', 'users.middle_name', 'users.last_name', 'therapist_details.therapist_occupation', 'therapist_details.short_description_1', 'therapist_details.category_of_therapist', 'therapist_details.profile_photo', 'therapist_details.video', 'therapist_details.service_id_fk', 'therapist_details.medium_id_fk')
			->leftJoin('therapist_details', 'users.id', '=', 'therapist_details.therapist_id_FK')
			->leftJoin('applications', 'users.id', '=', 'applications.therapist_id_FK')
			->where('usertype', 2);

		if ($mood_regulation != "") {
			$therapistData->where(function ($query) use ($mood_regulation) {
				foreach ($mood_regulation as $key => $value) {
					$query->orWhereRaw('FIND_IN_SET("' . $value . '",mood_regulation)');
				}
			});
		}

		if ($family_and_relationships != "") {
			$therapistData->where(function ($query) use ($family_and_relationships) {
				foreach ($family_and_relationships as $key => $value) {
					$query->orWhereRaw('FIND_IN_SET("' . $value . '",family_and_relationships)');
				}
			});
		}

		if ($academic_or_work_related != "") {
			$therapistData->where(function ($query) use ($academic_or_work_related) {
				foreach ($academic_or_work_related as $key => $value) {
					$query->orWhereRaw('FIND_IN_SET("' . $value . '",academic_or_work_related)');
				}
			});
		}

		if ($personal != "") {
			$therapistData->where(function ($query) use ($personal) {
				foreach ($personal as $key => $value) {
					$query->orWhereRaw('FIND_IN_SET("' . $value . '",personal)');
				}
			});
		}

		if ($other != "") {
			$therapistData->where(function ($query) use ($other) {
				foreach ($other as $key => $value) {
					$query->orWhereRaw('FIND_IN_SET("' . $value . '",other)');
				}
			});
		}

		if ($language != "") {
			$therapistData->where(function ($query) use ($language) {
				foreach ($language as $key => $value) {
					$query->orWhereRaw('FIND_IN_SET("' . $value . '",language_id_fk)');
				}
			});
		}

		if ($medium != "") {
			$therapistData->where(function ($query) use ($medium) {
				foreach ($medium as $key => $value) {
					$query->orWhereRaw('FIND_IN_SET("' . $value . '",medium_id_fk)');
				}
			});
		}

		if ($service != "") {
			$therapistData->where(function ($query) use ($service) {
				// print_r($service);
				// die();
				foreach ($service as $key => $value) {
					$query->orWhereRaw('FIND_IN_SET("' . $value . '",service_id_fk)');
				}
			});
		}

		if ($countries != "") {
			$therapistData->where(function ($query) use ($countries) {
				foreach ($countries as $key => $value) {
					$query->orWhereRaw('FIND_IN_SET("' . $value . '",country_id_fk)');
				}
			});
		}

		if ($gender != null) {
			if (!in_array("All", $gender)) {
				if ($gender != "") {
					$therapistData->where(function ($query) use ($gender) {
						foreach ($gender as $key => $value) {
							$query->orWhereRaw('FIND_IN_SET("' . $value . '",gender)');
						}
					});
				}
			}
		}

		if ($category_of_therapist != "") {
			$therapistData->where(function ($query) use ($category_of_therapist) {
				foreach ($category_of_therapist as $key => $value) {
					$query->orWhereRaw('FIND_IN_SET("' . $value . '",category_of_therapist)');
				}
			});
		}

		$result = $therapistData->get();

		if (count($result) == false) {
			return false;
		} else {
			return $result;
		}
	}

	public function getParticularTherapistData($id) {
		$singleTherapistData = DB::select("SELECT users.id AS id, users.first_name, users.middle_name, users.last_name, therapist_details.therapist_occupation, therapist_details.short_description_1, therapist_details.category_of_therapist, therapist_details.profile_photo, therapist_details.video, applications.language_id_fk, therapist_details.therapist_profile_description, therapist_details.what_therapist_can_help_with_1, therapist_details.educational_qualification_certification, therapist_details.professional_membership_affiliation, therapist_details.therapist_therapeutic_approaches, therapist_details.service_id_fk, therapist_details.medium_id_fk, therapist_details.id AS therapist_id
            FROM `users`
            LEFT JOIN therapist_details ON users.id = therapist_details.therapist_id_FK
            LEFT JOIN applications ON users.id = applications.therapist_id_FK
            WHERE usertype=2 AND users.id=" . $id);

		if (count($singleTherapistData) == false) {
			return false;
		} else {
			return $singleTherapistData[0];
		}
	}

	public function getTherapistDetails($id) {
		$showTherapistData = DB::select("SELECT users.id AS id, users.first_name, therapist_details.short_description, therapist_details.therapist_educational_qualification, therapist_details.what_therapist_can_help_with, applications.language_id_fk, therapist_details.category_of_therapist, therapist_details.id AS therapist_id
            FROM `users`
            LEFT JOIN therapist_details ON users.id = therapist_details.therapist_id_FK
            LEFT JOIN applications ON users.id = applications.therapist_id_FK
            WHERE usertype=2 AND users.id=" . $id);

		if (count($showTherapistData) == false) {
			return false;
		} else {
			return $showTherapistData[0];
		}
	}

	public function clientBookingPage($id) {

		$clientBooking = DB::select("SELECT users.id, users.first_name, users.middle_name, users.last_name, therapist_details.therapist_educational_qualification, therapist_details.category_of_therapist, therapist_details.profile_photo, therapist_details.service_id_fk, therapist_details.medium_id_fk, therapist_details.id as therapist_id
			FROM `users` as users
			LEFT JOIN therapist_details ON users.id = therapist_details.therapist_id_FK
			WHERE usertype=2 AND users.id=" . $id);

		if (count($clientBooking) == false) {
			return false;
		} else {
			return $clientBooking[0];
		}
	}

	public function getOtherTherapist($therapist_id_fk) {

		$getTherapist = DB::select("SELECT users.id, users.first_name, users.middle_name, users.last_name, therapist_details.therapist_educational_qualification, therapist_details.category_of_therapist, therapist_details.profile_photo, therapist_details.service_id_fk, therapist_details.medium_id_fk, therapist_details.id as therapist_id
			FROM `users` as users
			LEFT JOIN therapist_details ON users.id = therapist_details.therapist_id_FK
			WHERE usertype=2 AND users.id !=" . $therapist_id_fk);

		if (count($getTherapist) == false) {
			return false;
		} else {
			return $getTherapist;
		}
	}

	public function addedSlots($date, $therapist_id_fk, $medium, $service) {

		if ($medium == 1) {
			$where = "tbl_avalability_time_slots.video = 1";

		} elseif ($medium == 2) {
			$where = " tbl_avalability_time_slots.audio = 1";

		} elseif ($medium == 3) {
			$where = "tbl_avalability_time_slots.textbasedchat = 1 ";
		} elseif ($medium == 4) {
			$where = "tbl_avalability_time_slots.inperson = 1  ";
		} elseif ($medium == 5) {
			$where = "tbl_avalability_time_slots.homevisit = 1";
		} else {
			$where = " 1 ";
		}

		$showAddedSlots = DB::select("SELECT tbl_avalability.id AS avalabitityId, tbl_avalability_time_slots.id, tbl_avalability_time_slots.time_slot, tbl_avalability_time_slots.end_time_slot, tbl_avalability.therapist_id_fk, tbl_avalability_time_slots.audio, tbl_avalability_time_slots.video, tbl_avalability_time_slots.textbasedchat, tbl_avalability_time_slots.inperson, tbl_avalability_time_slots.homevisit, therapist_details.service_id_fk, therapist_details.medium_id_fk FROM `tbl_avalability`
			LEFT JOIN tbl_avalability_time_slots ON tbl_avalability.id = tbl_avalability_time_slots.avalability_id_fk
            LEFT JOIN therapist_details ON tbl_avalability.therapist_id_fk = therapist_details.therapist_id_FK
			WHERE tbl_avalability.slot_date = '" . $date . "' AND tbl_avalability.therapist_id_fk = '" . $therapist_id_fk . "' AND therapist_details.service_id_fk like '%" . $service . "%' AND " . $where . " AND tbl_avalability_time_slots.is_booked = 0 ORDER BY tbl_avalability_time_slots.time_slot ASC ");

		if (count($showAddedSlots) == false) {
			return false;
		} else {
			return $showAddedSlots;
		}
	}

	public function selectedSlots($client_id_fk) {

		$showSelectedSlots = DB::select("SELECT tbl_cart_session.id, tbl_cart_session.cart_id_fk, tbl_cart_session.slot_id_fk, tbl_cart_session.booking_date, tbl_cart.service_id_fk, tbl_cart.medium_id_fk, tbl_avalability_time_slots.time_slot, tbl_avalability_time_slots.end_time_slot FROM `tbl_cart_session`
			LEFT JOIN tbl_avalability_time_slots ON tbl_cart_session.slot_id_fk = tbl_avalability_time_slots.id
			LEFT JOIN tbl_cart ON tbl_cart_session.cart_id_fk = tbl_cart.id
			WHERE tbl_cart.client_id_fk =" . $client_id_fk);

		if (count($showSelectedSlots) == 0) {
			return false;
		} else {
			return $showSelectedSlots;
		}
	}

	public function addedSlotsForInperson($date, $therapist_id_fk, $medium, $service) {

		if ($medium == 4) {
			$inperson = "tbl_avalability_time_slots.inperson = 1";
		}

		$showAddedSlotsByInperson = DB::select("SELECT tbl_avalability.id AS avalabitityId, tbl_avalability_time_slots.id, tbl_avalability_time_slots.time_slot, tbl_avalability_time_slots.end_time_slot, tbl_avalability.therapist_id_fk, tbl_avalability_time_slots.inperson, therapist_details.service_id_fk, therapist_details.medium_id_fk, therapist_address.address_title,therapist_address.id as address_id FROM `tbl_avalability`
			LEFT JOIN tbl_avalability_time_slots ON tbl_avalability.id = tbl_avalability_time_slots.avalability_id_fk
            LEFT JOIN therapist_details ON tbl_avalability.therapist_id_fk = therapist_details.therapist_id_FK
            LEFT JOIN therapist_address on therapist_address.id = tbl_avalability_time_slots.location
			WHERE tbl_avalability.slot_date = '" . $date . "' AND tbl_avalability.therapist_id_fk = '" . $therapist_id_fk . "' AND therapist_details.service_id_fk like '%" . $service . "%' AND " . $inperson . " AND tbl_avalability_time_slots.is_booked = 0 ");

		if (count($showAddedSlotsByInperson) == false) {
			return false;
		} else {
			return $showAddedSlotsByInperson;
		}
	}

	public function getAllOtherBookedTherapist($client_id_fk) {

		$therapistData = DB::select("SELECT users.id, applications.mood_regulation, applications.gender, users.first_name, users.middle_name, users.last_name, therapist_details.therapist_occupation, therapist_details.short_description_1, therapist_details.category_of_therapist, therapist_details.profile_photo, therapist_details.video, therapist_details.service_id_fk, therapist_details.medium_id_fk FROM users
			LEFT JOIN therapist_details ON therapist_details.therapist_id_FK = users.id
			LEFT JOIN applications ON applications.therapist_id_FK = users.id
			LEFT JOIN tbl_order ON tbl_order.therapist_id_fk = users.id 
			WHERE tbl_order.client_id_fk = ".$client_id_fk." GROUP by tbl_order.client_id_fk");

		if (count($therapistData) == 0) {
			return false;
		} else {
			return $therapistData;
		}
	}

	public function selectTherapistProfileData($therapist_id_fk){

		$therapistProfileData = DB::select("SELECT applications.mood_regulation, applications.family_and_relationships, applications.academic_or_work_related, applications.personal, applications.other, applications.services_are_you_able_to_provide, applications.medium_are_you_able_to_use_for_counselling, applications.days, applications.timeslots, applications.anything_else, applications.approximate_availability, applications.currently_under_supervision, applications.supervision_please_provide_details, applications.currently_have_any_professional_indemnity_insurance, applications.insurance_please_provide_details, applications.any_clients_that_you_prefer_not_to_work_with_for_personal_reason, applications.work_with_any_specific_groups_of_people, tbl_countries.name AS country_name, 
		onboardings.profile_description, applications.language_id_fk, 
		applications.id, applications.first_name, applications.middle_name,
		 applications.last_name, applications.country_of_residence, 
		 applications.city_of_residence, applications.gender, applications.occupation, 
		 applications.occupation_other, applications.length_of_experience, 
		 applications.areas_of_expertise_specialisation, applications.therapeutic_approaches, 
		 applications.current_last_place_of_work, applications.educational_qualifications, 
		 applications.professional_certifications, applications.professional_memberships, 
		 applications.work_with_any_specific_groups_of_people, 
		 applications.any_clients_that_you_prefer_not_to_work_with_for_personal_reason, 
		 applications.supervision_please_provide_details, applications.insurance_please_provide_details, 
		 applications.approximate_availability, applications.days, applications.timeslots,applications.mood_regulation FROM `applications`
			LEFT JOIN expression_of_interest ON expression_of_interest.id = applications.expression_id_fk
			LEFT JOIN onboardings ON onboardings.expression_id_fk = expression_of_interest.id
			LEFT JOIN tbl_countries ON tbl_countries.id = applications.country_of_residence
			WHERE applications.therapist_id_FK = " . $therapist_id_fk);

		if (count($therapistProfileData) == 0) {
			return false;
		} else {
			return $therapistProfileData;
		}
	}
	// $therapistProfileData = DB::table("applications")->select('applications.id', 'applications.first_name', 'applications.middle_name', 'applications.last_name', 'applications.email', 'applications.city_of_residence', 'applications.gender', 'applications.occupation', 'applications.occupation_other', 'applications.length_of_experience', 'applications.areas_of_expertise_specialisation', 'applications.therapeutic_approaches', 'applications.current_last_place_of_work', 'applications.educational_qualifications', 'applications.professional_certifications', 'applications.professional_memberships', 'applications.work_with_any_specific_groups_of_people', 'applications.any_clients_that_you_prefer_not_to_work_with_for_personal_reason', 'applications.supervision_please_provide_details', 'applications.insurance_please_provide_details', 'applications.approximate_availability', 'applications.days', 'applications.timeslots')
	// 		->where('applications.therapist_id_FK', $therapist_id_fk)->first();

	public function selectTherapistAddresses($therapist_id_fk){

		$therapistAddressForProfile = DB::select("SELECT therapist_address.id, `onboarding_id`, `address_title`, `address_line1`, `address_line2`, `landmark`, `city`, `postal_code`, tbl_countries.name AS country_name FROM `therapist_address`
			LEFT JOIN onboardings ON onboardings.id = therapist_address.onboarding_id
			LEFT JOIN tbl_countries ON tbl_countries.id = therapist_address.country_id_fk
			WHERE onboardings.therapist_id_FK = " . $therapist_id_fk);

		if (count($therapistAddressForProfile) == 0) {
			return false;
		} else {
			return $therapistAddressForProfile;
		}
	}

	public function getIssuesForEditProfile() {
		$issues = DB::select("SELECT id, category_name, name FROM `category` WHERE status = 1");

		if ($issues == false) {
			return false;
		} else {
			return $issues;
		}
	}

	public function getTherapistEmail($therapist_id_fk) {
		$therapistEmail = DB::select("SELECT email FROM `users` WHERE id =" . $therapist_id_fk);

		if ($therapistEmail == false) {
			return false;
		} else {
			return $therapistEmail;
		}
	}

	public function getOrderDetailsFromSessionId($order_session_id) {
		$orderDetails = DB::select("SELECT service_id_fk as service_id , medium_id_fk as medium_id ,
		tbl_order_session.booking_date, tbl_avalability_time_slots.time_slot,
		tbl_avalability_time_slots.end_time_slot,tbl_order_session.id as order_session_id,
		tbl_avalability_time_slots.id as old_avalability_slot_id
		FROM tbl_order 
		left join tbl_order_session on tbl_order_session.order_id_fk = tbl_order.id
		left join tbl_avalability_time_slots on tbl_avalability_time_slots.id = tbl_order_session.slot_id_fk
		WHERE tbl_order_session.id =" . $order_session_id);

		if ($orderDetails == false) {
			return false;
		} else {
			return $orderDetails;
		}
	}
}