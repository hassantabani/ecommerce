<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDetails extends Model
{
    use HasFactory;
    protected $table = 'payment_details';
    protected $fillable = [
        'payment_type',
        'account_number',
        'account_name',
        'user_id'
    ];
    
}
