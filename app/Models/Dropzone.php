<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dropzone extends Model {
	use HasFactory;

	protected $table = "dropzones";

	protected $fillable = [
		'id',
		'onboarding_id_fk',
		'type',
		'media',
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
