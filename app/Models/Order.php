<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model {
	use HasFactory;

	protected $table = "tbl_order";

	protected $fillable = [
		'id',
		'therapist_id_fk',
		'client_id_fk',
		'service_id_fk',
		'medium_id_fk',
		'charge',
		'discount_coupon',
		'transaction_id',
		'amount',
		'homevisit_address',
		'zip_code',
		'phone_no',
		'country',
		'state',
		'city',
	];

	protected $primaryKey = "id";
}
