<?php

namespace Bms\Store\Models;

use Illuminate\Database\Eloquent\Model;

class Store_User_ResetPassword extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

 protected $fillable = [
        'email',
        'token'
    ];
    protected $table = 'store_user_resetpassword';

}
