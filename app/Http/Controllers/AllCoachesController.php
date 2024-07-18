<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Allcoaches;
use Illuminate\Http\Request;
use Response;
use Session;
use Illuminate\Support\Facades\DB;

class AllCoachesController extends Controller {
	public function __construct(Allcoaches $allcoaches) {
		$this->allcoaches = $allcoaches;
	}

	public function getAllCoachesPage() {
		return view('Website/User/allcoaches');
	}

	public function getAllCoaches(Request $request) {
		$id = $request->input('id');

		$therapistData = $this->allcoaches->AllTherapistData($id);

		if ($therapistData == false) {
			return response()->json([
				'status' => false,
				'message' => "Data Empty",
			], );
		} else {
			$data = view('Website/User/AllCoaches/all_coaches_list_box', ['therapistData' => $therapistData])->render();

			return response()->json([
				'status' => true,
				'therapistData' => $data,
			], );
		}
	}

	//for single therapist
	public function getCoachesPage($id) {
		return view('Website/User/coaches', ['id' => $id]);
	}

	public function getCoachesData(Request $request) {
		$id = $request->input('id');

		$singleTherapistData = $this->allcoaches->getParticularTherapistData($id);

		if ($singleTherapistData == false) {
			return response()->json([
				'status' => false,
				'message' => "Data Empty",
			], );
		} else {
			$therapist_data = view('Website/User/SingleCoach/coach_details_box', ['singleTherapistData' => $singleTherapistData])->render();

			return response()->json([
				'status' => true,
				'singleTherapistData' => $therapist_data,
				'data' => $singleTherapistData,
			], );
		}
	}

	public function showAllCoaches(Request $request) {

		$mood_regulation = $request->input('mood_regulation');
		$family_and_relationships = $request->input('family_and_relationships');
		$academic_or_work_related = $request->input('academic_or_work_related');
		$personal = $request->input('personal');
		$other = $request->input('other');
		$language = $request->input('language');
		$medium = $request->input('medium');
		$service = $request->input('service');
		$countries = $request->input('countries');
		$gender = $request->input('gender');
		$category_of_therapist = $request->input('category_of_therapist');

		$therapistData = $this->allcoaches->getAllTherapistData($mood_regulation, $family_and_relationships, $academic_or_work_related, $personal, $other, $language, $medium, $service, $countries, $gender, $category_of_therapist);

		if ($therapistData == false) {
			return response()->json([
				'status' => false,
				'message' => "Data Empty",
			], );
		} else {
			$therapist = view('Website/User/Landing_Page/Therapist/show_therapist', ['therapistData' => $therapistData])->render();

			return response()->json([
				'status' => true,
				'therapistData' => $therapist,
			], );
		}
	}

	public function showCoacheData(Request $request) {
		$id = $request->input('id');

		

		$showTherapistData = $this->allcoaches->getTherapistDetails($id);

		

		if ($showTherapistData == false) {
			return response()->json([
				'status' => false,
				'message' => "Data Empty",
			], );
		} else {
			$data = view('Website/User/Landing_Page/Therapist/therapist_info', ['showTherapistData' => $showTherapistData])->render();

			return response()->json([
				'status' => true,
				'showTherapistData' => $data,
			], );
		}
	}

	public function getTherapistDashboard() {
		//session()->pull('loggedTherapist');
		return view('Website/Doctor/therapist_dashboard');
	}

	public function getclientBookingPage(Request $request) {
		$id = $request->input('id');

		$clientBooking = $this->allcoaches->clientBookingPage($id);

		// print_r($clientBooking);
		// die;
		

		if ($clientBooking == false) {
			return response()->json([
				'status' => false,
				'message' => "Data Empty",
			], );
		} else {
			$data = view('Website/User/Client_booking/client_booking', ['clientBooking' => $clientBooking,'isReschedule' => false])->render();

			return response()->json([
				'status' => true,
				'clientBooking' => $data,
			], );
		}
	}

	public function editSlotPage(Request $request) {
		$userId = Session::get('loggedUser');

		$cartTherapistData = DB::select("SELECT * FROM `tbl_cart` WHERE client_id_fk =" . $userId);

		if (count($cartTherapistData) == 0) {
			return response()->json([
				'status' => false,
				'message' => "Data Empty",
			], );
		}

		$id = $cartTherapistData[0]->therapist_id_fk;

		$therapistProfileData = $this->allcoaches->clientBookingPage($id);

		if ($therapistProfileData == false) {
			return response()->json([
				'status' => false,
				'message' => "Data Empty",
			], );
		} else {

			$slotsSelected = $this->allcoaches->selectedSlots($userId);
			$arrayOfSelectedSlots = array();

			if ($slotsSelected != false) {
				foreach ($slotsSelected as $key => $value) {
					$value->booking_date_original = $value->booking_date;

					if ($value->booking_date == "") {
						$value->booking_date = " ";
					} else {
						$value->booking_date = Helper::getFormatedDateTimeForSelectedSlots($value->booking_date);
					}
					$arrayOfSelectedSlots[] = $value;
				}
			}

			$data = view('Website/User/Client_booking/client_booking', ['clientBooking' => $therapistProfileData, 'cartTherapistData' => $cartTherapistData[0],'isReschedule' => false])->render();

			return response()->json([
				'status' => true,
				'clientBooking' => $data,
				'showSelectedSlots' => $arrayOfSelectedSlots,
			], );
		}
	}

	public function getOtherTherapist(Request $request) {

		$therapist_id_fk = $request->input('therapist_id_fk');

		$otherTherapist = $this->allcoaches->getOtherTherapist($therapist_id_fk);

		if ($otherTherapist == false) {
			return response()->json([
				'status' => false,
				'message' => "Data Empty",
			], );
		} else {
			$data = view('Website/User/Client_booking/otherTherapist', ['otherTherapist' => $otherTherapist,'isReschedule' => false])->render();

			return response()->json([
				'status' => true,
				'otherTherapist' => $data,
			], );
		}
	}

	public function getAddedSlots(Request $request) {

		$date = $request->input('viewDate');
		$therapist_id_fk = $request->input('therapist_id_fk');

		$medium = $request->input('medium');
		$service = $request->input('service');

		$getDate = date_create($date);

		$slotsAdded = $this->allcoaches->addedSlots(date_format($getDate, "Y-m-d"), $therapist_id_fk, $medium, $service);

		if ($slotsAdded == false) {
			return response()->json([
				'status' => false,
				'message' => "Data Empty",
			], );
		} else {

			return response()->json([
				'status' => true,
				'slotsAdded' => $slotsAdded,
			], );
		}
	}

	public function getSelectedSlots(Request $request) {

		$client_id_fk = Session::get('loggedUser');
	}

	public function getAddedSlotsForInpreson(Request $request) {

		$date = $request->input('viewDate');
		$therapist_id_fk = $request->input('therapist_id_fk');

		$medium = $request->input('medium');
		$service = $request->input('service');

		$getDate = date_create($date);

		$slotsAdded = $this->allcoaches->addedSlotsForInperson(date_format($getDate, "Y-m-d"), $therapist_id_fk, $medium, $service);

		if ($slotsAdded == false) {
			return response()->json([
				'status' => false,
				'message' => "Data Empty",
			], );
		} else {

			return response()->json([
				'status' => true,
				'inpersonSlotsAdded' => $slotsAdded,
			], );
		}
	}

	public function showOtherBookedTherapist(Request $request) {

		$client_id_fk = Session::get('loggedUser');

		$OtherBookedTherapist = $this->allcoaches->getAllOtherBookedTherapist($client_id_fk);

		if ($OtherBookedTherapist == false) {
			return response()->json([
				'status' => false,
				'message' => "Data Empty",
			], );
		} else {
			$therapist = view('Website/User/Dashboard/other_therapist', ['OtherBookedTherapist' => $OtherBookedTherapist])->render();

			return response()->json([
				'status' => true,
				'OtherBookedTherapist' => $therapist,
			], );
		}
	}

	public function getTherapistEditProfilePage(){
		return view('Website/Doctor/therapist_edit_profile');
	}

	public function editTherapistProfile(Request $request){

		$therapist_id_fk = $request->session()->get('loggedTherapist');

		

		$therapistDataForEditProfile = $this->allcoaches->selectTherapistProfileData($therapist_id_fk);
		$therapistAddresses = $this->allcoaches->selectTherapistAddresses($therapist_id_fk);
		$therapistAddresses = $therapistAddresses == "" ? array() : $therapistAddresses;
		$issues = $this->allcoaches->getIssuesForEditProfile();
		$showEmail = $this->allcoaches->getTherapistEmail($therapist_id_fk);

		if ($therapistDataForEditProfile == false) {
			return response()->json([
				'status' => false,
				'message' => "Data Empty",
			], );
		} else {
			$therapistDataForEdit = view('Website/Doctor/ProfileEdit/generalDetails', ['therapistDataForEditProfile' => $therapistDataForEditProfile[0]])->render();
			$getTherapistAddress = view('Website/Doctor/ProfileEdit/showAddressOnEditProfile', ['therapistAddresses' => $therapistAddresses])->render();
			$data = view('Website/Doctor/ProfileEdit/ShowAllIssues', ['issues' => $issues,'therapistDataForEditProfile' => $therapistDataForEditProfile[0]])->render();
			$contactPage = view('Website/Doctor/ProfileEdit/contactDetails', ['showEmail' => $showEmail[0]])->render();
			
			return response()->json([
				'status' => true,
				'therapistDataForEditProfile' => $therapistDataForEdit,
				'therapistDataForEdit' => $therapistDataForEditProfile,
				'getTherapistAddress' => $therapistAddresses,
				'therapistAddresses' => $getTherapistAddress,
				'getissues' => $issues,
				'issues' => $data,
				'contactPage' => $showEmail,
				'showEmail' => $contactPage,
			], );
		}
	}


	public function rescheduleBooking(Request $request) {
		$id = $request->input('id');
		$order_session_id = $request->input('order_session_id');

		

		$clientBooking = $this->allcoaches->clientBookingPage($id);
		$orderDetails = $this->allcoaches->getOrderDetailsFromSessionId($order_session_id);


		

		if ($clientBooking == false) {
			return response()->json([
				'status' => false,
				'message' => "Data Empty",
			], );
		} else {
			$data = view('Website/User/Client_booking/client_booking', ['clientBooking' => $clientBooking,'isReschedule' => true,'orderDetails'=>$orderDetails])->render();

			return response()->json([
				'status' => true,
				'clientBooking' => $data,
			], );
		}
		
	}
}