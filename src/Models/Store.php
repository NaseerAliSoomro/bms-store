<?php

namespace Bms\Store\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
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
    protected $table = 'store';

}
