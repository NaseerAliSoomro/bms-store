<?php

namespace Blinkswag\Store\Models;

use Illuminate\Database\Eloquent\Model;

class BlinkswagStore extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

 protected $fillable = [
        'id_company',
        'id_category',
        'user_id',
        'name',
        'contents',
        'my_editing',
        'token'
    ];
    protected $table = 'blinkswag_store';
}
