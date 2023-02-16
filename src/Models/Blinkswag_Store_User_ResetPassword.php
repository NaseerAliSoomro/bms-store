<?php

namespace Blinkswag\Store\Models;

use Illuminate\Database\Eloquent\Model;

class Blinkswag_Store_User_ResetPassword extends Model
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
    protected $table = 'blinkswag_store_user_resetpassword';

}
