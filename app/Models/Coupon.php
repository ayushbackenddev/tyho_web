<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Coupon extends Model
{
    use HasFactory;
    protected $table = "tbl_coupon";

    protected $fillable = [
        'id', 
        'discount_type',
         'discount_code', 
         'per_user_limit', 
         'minimum_spend', 
         'maximum_spend',
         'cliend_name_id',
         'country_id_fk',
         'service_id_fk',
         'medium_id_fk',
         'therapist_id_fk',
         'therapist_fee',
         'discount_value',
         'date_of_issue',
         'expiry_date',
         'usage_limit',
         'email_domains',
         'client_type',
         'country_of_therapist',
         'country_of_client',
         'description',
         'currency',
         'issued_by',
        

    ];

    

    protected $primaryKey = "id";

    public function applycouponcode($userID,$couponcode){
        
        $get = DB::table('tbl_coupon')->select('id','discount_code','expiry_date','date_of_issue','discount_value','discount_type','per_user_limit','minimum_spend','maximum_spend')->whereRaw('find_in_set("'.$userID.'",tbl_coupon.cliend_name_id)')->where('discount_code', $couponcode)->get();
        
        if(count($get)==0){
            return false;
        }else{
            return $get;
        }
    }
    
}

   
