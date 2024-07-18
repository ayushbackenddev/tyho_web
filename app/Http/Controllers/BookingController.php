<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Order;
use App\Models\OrderSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Stripe;
use Validator;

class BookingController extends Controller {
	public function __construct(Booking $booking) {
		$this->booking = $booking;
	}

	public function selectedSlotsById(Request $request) {
		$client_id_fk = $request->session()->get('loggedUser');

		$leftSide = $this->booking->showBookingPageLeftSideData($client_id_fk);
		$rightSide = $this->booking->showBookingPageRightSideData($client_id_fk);
		$selectedSlotsByTherapist = $this->booking->showBookingSlots($client_id_fk);
		$hasHomeVisit = $this->booking->hasHomeVisit($client_id_fk);
		$mywallet = $this->booking->mywalletacount($client_id_fk);

		if ($leftSide == false) {
			return response()->json([
				'status' => false,
				'message' => "Your Cart is Empty",
			], );
		} else {
			$data = view('Website/User/Confirm_booking/bookingData/showBookingData', ['leftSide' => $leftSide, 'mywallet' => $mywallet ,'showSelectedSlots' => count($selectedSlotsByTherapist)])->render();

			$selectedSlots = view('Website/User/Confirm_booking/bookingData/showSelectedSlot', ['rightSide' => $rightSide])->render();

			return response()->json([
				'status' => true,
				'leftSide' => $data,
				'$mywallet' => $mywallet,
				'rightSide' => $selectedSlots,
				'selectedSlots' => $rightSide[0],
				'hasHomeVisit' => $hasHomeVisit
			], );
		}
	}

	public function removeSelectedSlots(Request $request) {
		$slot_id_fk = $request->input('slot_id_fk');

		$deleteSlot = DB::select("DELETE FROM `tbl_cart_session` WHERE slot_id_fk =" . $slot_id_fk);

		$client_id_fk = $request->session()->get('loggedUser');

		$isSessionExist = $this->booking->sessionExist($client_id_fk);

		if ($isSessionExist == false) {

			DB::select("DELETE FROM `tbl_cart` WHERE client_id_fk =" . $client_id_fk);

			return response()->json([
				'status' => true,
				'refershPage' => true,
				'message' => "Slot deleted successfully.",
			], );
		}

		if ($deleteSlot) {

			return response()->json([
				'status' => false,
				'refershPage' => false,
				'message' => "Slot not deleted.",
			], );
		} else {

			return response()->json([
				'status' => true,
				'refershPage' => false,
				'message' => "Slot deleted successfully.",
			], );
		}
	}

	public function slotBookingPayment(Request $request) {

		$validator = Validator::make($request->all(),
		[
			'full_name' => 'required',
			'email' => 'required|email',
			'address' => 'required',
			'token' => 'required',
		]);

		if ($validator->fails()) {
			return response()->json(['status' => false, 'message' => $validator->errors()->first()], 200);
		}

		$clientId = $request->session()->get('loggedUser');

		$selectUserSelectedSlot = DB::select("SELECT tbl_cart_session.id, `cart_id_fk`, `slot_id_fk`, `booking_date` FROM `tbl_cart_session`
			LEFT JOIN tbl_cart ON tbl_cart.id = tbl_cart_session.cart_id_fk
			WHERE client_id_fk=" . $clientId);

		for ($i = 0; $i < count($selectUserSelectedSlot); $i++) {

			$getSelectedSlotId[$i] = $selectUserSelectedSlot[0]->slot_id_fk;

			$checkBookedSlot = DB::select("SELECT `is_booked`, `time_slot`, `end_time_slot` FROM `tbl_avalability_time_slots` WHERE is_booked = 1 AND id=" . $getSelectedSlotId[$i]);

			if (count($checkBookedSlot) > 0) {

				return response()->json([
					'status' => false,
					'message' => "Slot time " . $checkBookedSlot[0]->time_slot . " - " . $checkBookedSlot[0]->end_time_slot . " is already booked.",
				], );
			}
		}

		$token = $request->input('token');
		$full_name = $request->input('full_name');
		$email = $request->input('email');
		$address = $request->input('address');

		Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

		$customer = \Stripe\Customer::create(array(
			'name' => $full_name,
			'email' => $email,
			'description' => 'test description',
			'source' => $token,
			"address" => ["city" => "hyd", "country" => "india", "line1" => "adsafd werew", "postal_code" => "500090", "state" => "telangana"],
		));

		$respose = Stripe\Charge::create([
			"amount" => $request->input('amount') * 100,
			'customer' => $customer->id,
			// 'customer' => "cus_KW4n5npYwcZQaC",
			"currency" => "inr",
			"description" => "This payment is tested purpose phpcodingstuff.com",
		]);

		$transaction_Id = $respose->balance_transaction;

		$getCartDetails = DB::table('tbl_cart')->select('id', 'therapist_id_fk', 'service_id_fk', 'medium_id_fk', 'charge', 'discount_coupon')->where('client_id_fk', $clientId)->first();

		$cartId = $getCartDetails->id;
		$therapistId = $getCartDetails->therapist_id_fk;
		$serviceId = $getCartDetails->service_id_fk;
		$mediumId = $getCartDetails->medium_id_fk;
		$charge = $getCartDetails->charge;
		$discountCoupon = $getCartDetails->discount_coupon;

		$getServicePrice = DB::table('tbl_therapist_service_prices')->select('id', 'therapist_id_fk', 'service_id_fk', 'therapist_fees')->where('service_id_fk', $serviceId)->first();

		$servicePrice = $getServicePrice->therapist_fees;

		$getMediumPrice = DB::table('mediums')->select('id', 'medium_price')->where('id', $mediumId)->first();

		$mediumPrice = $getMediumPrice->medium_price;

		$order = new Order();
		$order->therapist_id_fk = $therapistId;
		$order->client_id_fk = $clientId;
		$order->service_id_fk = $serviceId;
		$order->medium_id_fk = $mediumId;
		$order->charge = $charge;
		$order->discount_coupon = $discountCoupon;
		$order->transaction_id = $transaction_Id;
		$order->amount = $request->input('amount');
		$order->service_amount = $servicePrice;
		$order->medium_amount = $mediumPrice;
		$order->homevisit_address = $request->input('homevisit_address');
		$order->zip_code = $request->input('zip_code');
		$order->phone_no = $request->input('phone_no');
		$order->country = $request->input('country');
		$order->state = $request->input('state');
		$order->city = $request->input('city');
		$order->save();

		$orderId = $order->id;

		$getCartSessionDetails = DB::table('tbl_cart_session')->select('*')->where('cart_id_fk', $cartId)->get();

		// $arrayOfBookedSlots = array();

		foreach ($getCartSessionDetails as $key => $value) {

			$slotId = $value->slot_id_fk;
			$bookingDate = $value->booking_date;

			$orderSession = new OrderSession();
			$orderSession->order_id_fk = $orderId;
			$orderSession->slot_id_fk = $slotId;
			$orderSession->booking_date = $bookingDate;
			$orderSession->save();

			DB::select("UPDATE `tbl_avalability_time_slots` SET `is_booked`='1' WHERE id=" . $slotId);

			// $arrayOfBookedSlots[] = $value;
		}

		$deleteSlotData = DB::select("DELETE FROM `tbl_cart` WHERE client_id_fk =" . $clientId);
		$deleteSlotData = DB::select("DELETE FROM `tbl_cart_session` WHERE cart_id_fk =" . $cartId);

		return response()->json([
			'status' => true,
			'message' => "Successfully.",
		], );
	}

	public function stripePost(Request $request) {

		Session::flash('success', 'Payment successful!');

		return back();
	}

	public function GetCountries(Request $request) {
		$getAllCountries = DB::table('tbl_countries')->select('id', 'name')->get();

		if ($getAllCountries == "") {
			return response()->json([
				'status' => false,
				'message' => "Country is Empty",
			], );
		} else {
			return response()->json([
				'status' => true,
				'data' => $getAllCountries,
			], );
		}
	}

	public function GetState(Request $request) {
		$country_id = $request->input('country_id');

		$getAllState = DB::table('state_list')->select('state_id', 'state_name')->where('country_id', '=', $country_id)->get();

		if ($getAllState == "") {
			return response()->json([
				'status' => false,
				'message' => "State is Empty",
			], );
		} else {
			return response()->json([
				'status' => true,
				'data' => $getAllState,
			], );
		}
	}

	public function GetCity(Request $request) {
		$state_id = $request->input('state_id');

		$getAllCity = DB::table('tbl_cities')->select('id', 'name')->where('state_id', '=', $state_id)->get();

		if ($getAllCity == "") {
			return response()->json([
				'status' => false,
				'message' => "City is Empty",
			], );
		} else {
			return response()->json([
				'status' => true,
				'data' => $getAllCity,
			], );
		}
	}
}