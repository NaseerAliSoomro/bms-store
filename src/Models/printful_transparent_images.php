<?php

namespace Blinkswag\Store\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Blinkswag_Store_printful_transparent_images extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "blinkswag_store_printful_transparent_images";
}
