<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    use HasFactory;
    protected $table = 'trackings';

    protected $fillable = [
        'tracking_id',
        'order_id',
        'courier_company',
        'order_no_api',
        'slip_link',
        'delivery_charges',
    ];
}
