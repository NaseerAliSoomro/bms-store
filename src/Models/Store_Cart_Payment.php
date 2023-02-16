<?php

namespace Blinkswag\Store\Models;

use Illuminate\Database\Eloquent\Model;

class Blinkswag_Store_Cart_Payment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

 protected $fillable = [
        'id_company',
        'store_name',
        'cart_items_json',
        'product_for_shirt',
        'address_id',
        'delivery_date',
        'shipment_cost',
        'salesorder_id',
        'stripe_payment_json'
    ];
    protected $table = 'blinkswag_store_cart_payment';

}
