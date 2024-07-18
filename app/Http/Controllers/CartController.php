<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartSession;
use DB;
use Illuminate\Http\Request;
use Response;
use Session;
use Validator;

class CartController extends Controller {
	public function __construct(Cart $cart) {
		$this->cart = $cart;
	}

	public function addSlotIntoCart(Request $request) {
		$validator = Validator::make($request->all(),
			[
				'therapist_id_pop_up' => 'required',
				'service_id_fk' => 'required',
				'medium_id_fk' => 'required',
				// 'charge' => 'required',
				// 'discount_coupon' => 'required',
				// 'client_id_fk' => 'required',
			]);

		if ($validator->fails()) {
			return response()->json(['status' => false, 'message' => $validator->errors()->first()], 200);
		}

		if (session()->has('loggedUser')) {

			$therapistId = $request->input('therapist_id_pop_up');

			$selectTherapistId = DB::table('tbl_cart')->select('id', 'therapist_id_fk')->where('client_id_fk', session()->get('loggedUser'))->first();

			// print_r($selectTherapistId);
			// die;
			// $selectedTherapistId = $selectTherapistId->therapist_id_fk;
			if (!isset($selectTherapistId) ) {

				
				$cart = new Cart;
				$cart->therapist_id_fk = $therapistId;
				$cart->client_id_fk = $request->session()->get('loggedUser');
				$cart->service_id_fk = $request->input('service_id_fk');
				$cart->medium_id_fk = $request->input('medium_id_fk');
				$cart->charge = "100";
				$cart->discount_coupon = "abc@123";
				$cart->save();

				$cartID = $cart->id;

				$selectSlotId = $request->input('slot_id_fk');
				$date = $request->input('booking_date');

				if ($selectSlotId != null) {

					for ($i = 0; $i < count($selectSlotId); $i++) {

						$slot_id = $selectSlotId[$i];
						$selectedDate = $date[$i];

						$selectedSlotId = DB::table('tbl_avalability_time_slots')->select('is_booked')->where('is_booked', '=', 1)->where('id', $slot_id)->first();

						if ($selectedSlotId == "") {

							$cartSession = new CartSession();
							$cartSession->cart_id_fk = $cartID;
							$cartSession->slot_id_fk = $slot_id;
							$cartSession->booking_date = $selectedDate;
							$cartSession->save();
						} else {

							return response()->json([
								'status' => false,
								'message' => "Slot already booked.",
							], );
						}
					}
				}

				return response()->json([
					'status' => true,
					'message' => "Your cart selected successfully.",
				], );

			
			}else if ($selectTherapistId->therapist_id_fk == $therapistId) {

				$cart = Cart::findOrFail($selectTherapistId->id);
				$cart->therapist_id_fk = $therapistId;
				$cart->client_id_fk = $request->session()->get('loggedUser');
				$cart->service_id_fk = $request->input('service_id_fk');
				$cart->medium_id_fk = $request->input('medium_id_fk');
				$cart->charge = "$100";
				$cart->discount_coupon = "abc@123";
				$cart->save();

				$cartID = $cart->id;

				$selectSlotId = $request->input('slot_id_fk');
				$date = $request->input('booking_date');

				if ($selectSlotId != null) {

					DB::select("DELETE FROM `tbl_cart_session` WHERE cart_id_fk =" . $cartID);

					for ($i = 0; $i < count($selectSlotId); $i++) {

						$slot_id = $selectSlotId[$i];
						$selectedDate = $date[$i];

						$selectedSlotId = DB::table('tbl_cart_session')->select('slot_id_fk')->where('slot_id_fk', $slot_id)->first();

						if ($selectedSlotId == "") {

							$cartSession = new CartSession();
							$cartSession->cart_id_fk = $cartID;
							$cartSession->slot_id_fk = $slot_id;
							$cartSession->booking_date = $selectedDate;
							$cartSession->save();
						}
						// else {

						// 	return response()->json([
						// 		'status' => false,
						// 		'message' => "Slot already booked.",
						// 	], );
						// }
					}
				}

				return response()->json([
					'status' => true,
					'message' => "Your cart updated successfully.",
				], );
			}
			
				
			
		} else {
			return response()->json([
				'status' => false,
				'message' => "Please login first.",
			], );
		}
	}
}
