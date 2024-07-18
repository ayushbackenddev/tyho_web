<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvalabilityOfSlot extends Model {
	use HasFactory;

	protected $table = "tbl_avalability_time_slots";

	protected $fillable = [
		'id',
		'avalability_id_fk',
		'time_slot',
		'audio',
		'video',
		'textbasedchat',
		'inperson',
		'homevisit',
		'location',
	];

	protected $primaryKey = "id";

}
