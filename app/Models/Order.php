<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
       'id',
       'customer_fname',
       'customer_lname',
       'customer_number',
       'customer_address1',
       'customer_address2',
       'postal_code',
       'customer_city',
       'customer_province',
       'customer_country',
       'extra_customer_details',
       'shipping_gateway',
       'payment_method',
       'extra_shipping_details',
       'shipping_cost',
       'total_price',
       'total_items',
       'qrcode_id',
       'cart_items',
       'user_profit',
       'admin_cost',
       'status',
       'user_id',
       'tracking_id',
       'total_purchase',
       'order_tracking'
    ];

    public function user()
{
    return $this->belongsTo(User::class);
}
}
