<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartSession extends Model {
	use HasFactory;

	protected $table = "tbl_cart_session";

	protected $fillable = [
		'id',
		'cart_id_fk',
		'booking_date',
		'slot_id_fk',
	];

	protected $primaryKey = "id";
}
