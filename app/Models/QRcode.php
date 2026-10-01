<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QRcode extends Model
{
    use HasFactory;
    protected $table = 'q_rcodes';
    protected $fillable = [
        'id',
        'order_id',
        'tracking_id',
        'image',
        'user_id'
    ];
}
