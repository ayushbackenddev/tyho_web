<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TherapistProfile extends Model
{
    use HasFactory;

    protected $table = "therapist_details";

    protected $fillable = [
        'id',
        'notice_period_for_new_bookings',
        'my_timezone',
        'taking_new_clients',
    ];

    protected $primaryKey = "id";
}
