<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = [
        'nama',
        'email',
        'alamat',
        'paket',
        'biaya',
        'status',
        'bukti_transfer'
    ];
}