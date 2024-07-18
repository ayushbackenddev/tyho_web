<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ClientDetails extends Model
{
    use HasFactory;

    public function getClientData($client_id_fk){

        $clientsDetails = DB::select("SELECT users.id, users.first_name, users.last_name, intakes.age, intakes.gender, intakes.country_of_residence AS country, intakes.city_of_residence AS city, intakes.name AS contact_name, intakes.relationship, CONCAT(intakes.dial_code, ' ', intakes.mobile) AS mobile_no FROM `users` 
            LEFT JOIN intakes ON intakes.user_id = users.id
            WHERE users.id = " . $client_id_fk);

        if (count($clientsDetails) == false) {
            return false;
        } else {
            return $clientsDetails;
        }
    }

    public function getClientDataForEdit($client_id_fk){

        $clientsProfileData = DB::select("SELECT users.id, users.first_name, users.last_name, users.email, users.mobile_no, users.password FROM `users` WHERE users.id = " . $client_id_fk);

        if (count($clientsProfileData) == false) {
            return false;
        } else {
            return $clientsProfileData;
        }
    }

    public function OTPverify($user_id, $otp) {
		$user = DB::table('users')->select('mobile_no', 'otp')->where('id', $user_id)->where('otp', $otp)->get();

		if (count($user) == 0) {
			return false;
		} else {
			return $user;
		}
	}
    
    public function getclientIntekformData($user_id){
        $intekform =  DB::select("SELECT intakes.id, age, gender, country_of_residence, users.last_name,users.first_name ,users.user_id, city_of_residence, name, relationship, intakes.dial_code, mobile, mood_regulation, family_and_relationships, academic_or_work_related, personal, other, anything_else, your_relationship_status, your_occupation, highest_qualifications, if_yes_last_consulted , if_yes_they_are_helping_you , previously_had_any_sessions_with_anyone, are_you_currently_consulting_with_anyone,  share_personal_and_professional_goals  FROM intakes 
        LEFT JOIN users ON intakes.user_id=users.id
        WHERE intakes.user_id =".$user_id);
        
		if (count($intekform) == 0) {
			return false;
		} else {
			return $intekform;
		}

    }
}
