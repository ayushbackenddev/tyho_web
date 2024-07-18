<?php

namespace App\Helpers;

use DB;

class Helper {
	public static function getMultipleServices(String $service_ids) {
		
		$therapistData = DB::table("services")->select('id', 'service')->whereIn('id', explode(",", $service_ids))->where('status', '=', 1)->get();
		$services = "";

		foreach ($therapistData as $key => $value) {
			$services .= $value->service . " | ";
		}

		return rtrim($services, " | ");
	}

	public static function getMultipleServices1(String $service_ids) {
		$singleTherapistData = DB::table("services")->select('id', 'service')->whereIn('id', explode(",", $service_ids))->where('status', '=', 1)->get();

		$services = "<ul class='listServices'>";

		foreach ($singleTherapistData as $key => $value) {
			$services .= "<li>" . $value->service . "</li>";
		}

		$services .= "</ul>";
		return $services;
	}

	// public static function getMultipleMediums(String $medium_Ids) {
	// 	$singleTherapistData = DB::table("mediums")->select('id', 'medium', 'medium_img')->whereIn('id', explode(",", $medium_Ids))->where('status', '=', 1)->get();

	// 	$mediums = "<ul class='listIcons listIconsBig'>";

	// 	foreach ($singleTherapistData as $key => $value) {

	// 		$image = Storage::disk("s3")->url($value->medium_img);

	// 		$mediums .= "<li><a data-toggle='tooltip' title='' data-bs-original-title='$value->medium' aria-label='$value->medium'><img src='" . $image . "' alt='' title=''></a> </li>";
	// 	}

	// 	$mediums .= "</ul>";
	// 	return $mediums;
	// }

	public static function getAllReviewForTherapistFullDetail(String $therapist_id_FK) {
		$allReviews = DB::select("SELECT therapist_reviews.id, therapist_details_id, reviews FROM `therapist_reviews` LEFT JOIN therapist_details ON therapist_reviews.therapist_details_id = therapist_details.id WHERE therapist_details.therapist_id_FK=" . $therapist_id_FK);

		if (count($allReviews) > 0) {
			$reviewsForTherapist = "<div class='carousel-indicators'>";

			$indx = 0;

			foreach ($allReviews as $key => $value) {
				if ($indx == 0) {
					$reviewsForTherapist .= '<button type="button" data-bs-target="#carouselTestimonials" data-bs-slide-to="' . $indx . '" class="active" aria-current="true"></button>';
				} else {
					$reviewsForTherapist .= ' <button type="button" data-bs-target="#carouselTestimonials" data-bs-slide-to="' . $indx . '"></button>';
				}
				$indx = $indx + 1;

			}
			$reviewsForTherapist .= "</div>";

			$reviewsForTherapist .= "<div class='carousel-inner'>";

			$indx = 0;

			foreach ($allReviews as $key => $value) {
				if ($indx == 0) {
					$reviewsForTherapist .= "<div class='carousel-item active'><p>" . $value->reviews . "</p></div>";
				} else {
					$reviewsForTherapist .= "<div class='carousel-item'><p>" . $value->reviews . "</p></div>";
				}
				$indx = $indx + 1;

			}

			$reviewsForTherapist .= "</div>";

			return $reviewsForTherapist;
		} else {
			return false;
		}
	}

	public static function getMultipleLanguages(String $languageIds) {
		$singleTherapistData = DB::table("languages")->select('id', 'language_name')->whereIn('id', explode(",", $languageIds))->where('status', '=', 1)->get();

		$language = "<ul class='listServices'>";

		foreach ($singleTherapistData as $key => $value) {
			$language .= "<li>" . $value->language_name . "</li>";
		}

		$language .= "</ul>";
		return $language;
	}

	public static function getMultipleLanguages_1(String $languageIds) {
		$singleTherapistData = DB::table("languages")->select('id', 'language_name')->whereIn('id', explode(",", $languageIds))->where('status', '=', 1)->get();

		$language = "";

		foreach ($singleTherapistData as $key => $value) {
			$language .= $value->language_name . " | ";
		}

		return rtrim($language, " | ");
	}

	public static function getAllMoodRegulation(String $moodRegulationIds) {
		$issuesMoodRegulation = DB::table("category_subcategory")->select('id', 'category_id_fk', 'subcategory')->whereIn('category_id_fk', explode(",", $moodRegulationIds))->where('status', '=', 1)->get();

		return $issuesMoodRegulation;
	}

	public static function getIssues(String $moodRegulationIds) {
		$issues = DB::table("category_subcategory")->select('category_subcategory.id', 'category_id_fk', 'subcategory')->leftjoin('category', 'category_subcategory.category_id_fk', '=', 'category.id')->whereIn('category_id_fk', explode(",", $moodRegulationIds))->where('category_subcategory.status', '=', 1)->get();

		return $issues;
	}

	public static function getAllIssues(String $moodRegulationIds) {
		$allIssues = DB::table("category_subcategory")->select('id', 'category_id_fk', 'subcategory')->whereIn('category_id_fk', explode(", ", $moodRegulationIds))->where('status', '=', 1)->get();

		return $allIssues;
	}

	public static function getAllSingleMoodRegulation(String $moodRegulationIds) {
		$singlemodregulation = DB::table("category_subcategory")->select('id', 'category_id_fk', 'subcategory')->whereIn('id', explode(",", $moodRegulationIds))->where('status', '=', 1)->get();

		return $singlemodregulation;
	}

	public static function getAllLanguages(String $languageIds) {
		$languages = DB::table("languages")->select('id', 'language_name')->whereIn('id', explode(",", $languageIds))->where('status', '=', 1)->get();

		return $languages;
	}

	public static function getAllServices(String $servicesIds) {
		$services = DB::table("services")->select('id', 'service')->whereIn('id', explode(",", $servicesIds))->where('status', '=', 1)->get();

		return $services;
	}

	public static function getMyService() {

		$service = DB::table("services")->select('id', 'service')->where('status', '=', 1)->get();
		return $service;
	}

	public static function getCheckMyMedium(String $medium_id, String $therapist_id) {
		$definedMediums = DB::table("therapist_details")->select('id', 'medium_id_fk')->where('therapist_id_FK', '=', $therapist_id)->first();

		$myMediums = explode(",", $definedMediums->medium_id_fk);

		if (in_array($medium_id, $myMediums)) {
			return true;
		} else {
			return false;
		}
	}

	public static function getMyMedium() {

		$mediums = DB::table("mediums")->select('id', 'medium', 'medium_img')->where('status', '=', 1)->get();
		return $mediums;

		// $therapist_id = Session::get('loggedTherapist');
		// $definedMediums = DB::table("therapist_details")->select('id', 'medium_id_fk')->where('therapist_id_FK', '=', $therapist_id)->first();

		// print_r(explode(",", $definedMediums->medium_id_fk));
		// die;
	}

	public static function getAllCountries(String $country_Ids) {
		$countries = DB::table("countries")->select('id', 'country')->whereIn('id', explode(",", $country_Ids))->where('status', '=', 1)->get();

		return $countries;
	}

	public static function getServicesForTherapistBooking(String $service_ids, String $therapistId) {
		$clientBooking = DB::table("services")
			->select('services.id', 'service', 'therapist_fees')
			->leftjoin('tbl_therapist_service_prices', 'services.id', '=', 'tbl_therapist_service_prices.service_id_fk')
			->whereIn('services.id', explode(",", $service_ids))
			->where('status', '=', 1)
			->where('tbl_therapist_service_prices.therapist_id_fk', '=', $therapistId)
			->get();

		return $clientBooking;
	}

	public static function getMediumsForTherapistBooking(String $medium_Id) {
		$clientBooking = DB::table("mediums")->select('id', 'medium', 'medium_price')->whereIn('id', explode(",", $medium_Id))->where('status', '=', 1)->get();

		return $clientBooking;
	}

	public static function AllIssues(String $moodRegulationIds) {
		$application = DB::table("category_subcategory")->select('id', 'subcategory')->whereIn('id', explode(",", $moodRegulationIds))->get();

		$issues = "";

		foreach ($application as $key => $value) {
			$issues .= $value->subcategory . ", ";
		}

		return rtrim($issues, ", ");
	}

	public static function getFormatedDateTimeForTimeSlots(String $created_at) {

		$getDate = date_create($created_at);

		return date_format($getDate, "D, d M Y");
	}

	public static function getFormatedDateTimeForSelectedSlots(String $booking_date) {

		$getDate = date_create($booking_date);

		return date_format($getDate, "D, d M Y");
	}

	public static function getServicePrice(String $therapist_id_fk, String $service_id) {
		$servicePrice = DB::table("tbl_therapist_service_prices")->select('id', 'therapist_fees')->where('therapist_id_fk', '=', $therapist_id_fk)->where('service_id_fk', '=', $service_id)->first();

		return $servicePrice->therapist_fees;
	}

	public static function getMediumPrice(String $medium_id_fk) {
		$mediumPrice = DB::table("mediums")->select('id', 'medium_price')->where('id', '=', $medium_id_fk)->first();

		return $mediumPrice->medium_price;
	}

	public static function getFormatedDateForTherapistDashboard(String $booked_date) {

		$getDate = date_create($booked_date);

		return date_format($getDate, "D, d M Y");
	}

	public static function getServicesForApplicationView(String $serviceIds) {
		$servicesForApplication = DB::table("services")->select('id', 'service')->whereIn('id', explode(",", $serviceIds))->where('status', '=', 1)->first();

		return $servicesForApplication->service;
	}

	public static function getMediumForApplicationView(String $mediumIds) {
		$mediumsForApplication = DB::table("mediums")->select('id', 'medium')->whereIn('id', explode(",", $mediumIds))->where('status', '=', 1)->first();

		return $mediumsForApplication->medium;
	}

	public static function getFormatedDateForSessionReciept(String $booked_date) {

		$getDate = date_create($booked_date);

		return date_format($getDate, "D d M Y");
	}

	public static function getFormatedDateForClientsDatatable(String $booking_date) {

		$getDate = date_create($booking_date);

		return date_format($getDate, "M Y");
	}

	public static function getFormatedDateTimeForMyClients(String $created_at) {

		$getDate = date_create($created_at);

		return date_format($getDate, "d M Y");
	}

	public static function getTherapistCurrency(String $therapist_id) {

		$currency = DB::select("SELECT currency_symbole FROM `therapist_details` LEFT JOIN countries ON countries.id = therapist_details.country_id_fk WHERE therapist_details.therapist_id_FK=" . $therapist_id);

		if (count($currency) > 0) 
		{
			return $currency[0]->currency_symbole;
		}else
		{
			return "";
		}
	}

	public static function getStartingPrice(String $therapist_id) {

		$price = DB::select("SELECT min(therapist_fees) as therapist_fees FROM `tbl_therapist_service_prices` WHERE therapist_id_fk=" . $therapist_id);

		if (count($price) > 0) 
		{
			return $price[0]->therapist_fees;
		}else
		{
			return "";
		}
	}

	public static function getCouponDetails(String $discount_code){
		$getcoupon = DB::select("SELECT discount_type, discount_value FROM tbl_coupon WHERE discount_code = '".$discount_code."'");
		$array = array();

		if(count($getcoupon) > 0){
			return $getcoupon;
		}else{
			return $array;	
		}
	}
}

?>