<?php

namespace Blinkswag\Store\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlinkswagStoreUsers extends Model
{
    // use HasFactory;
    protected $table = 'blinkswag_store_users';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_token',
        'google_refresh_token',
        'google_id',
        'store_name',
        'address',
    ];

}
