<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model {
	use HasFactory;

	protected $table = "therapist_address";

	protected $fillable = [
		'id',
		'address_title',
		'address_line1',
		'address_line2',
		'landmark',
		'city',
		'postal_code',
		'country_id_fk',
	];

	protected $primaryKey = "id";

	protected $hidden = [
		'password',
		'remember_token',
	];

	protected $casts = [
		'email_verified_at' => 'datetime',
	];
}
