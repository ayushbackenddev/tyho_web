<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model {
	use HasFactory;

	protected $table = "tbl_cart";

	protected $fillable = [
		'id',
		'therapist_id_fk',
		'client_id_fk',
		'service_id_fk',
		'medium_id_fk',
		'charge',
		'discount_coupon',
	];

	protected $primaryKey = "id";
}
