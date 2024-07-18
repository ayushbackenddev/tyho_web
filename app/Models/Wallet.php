<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $table = "tbl_wallet";

    protected $fillable = [
        'id',
        'client_id_fk',
        'transaction_id',
        'amount',
        'type',
        'date',
    ];

    protected $primaryKey = "id";
}
