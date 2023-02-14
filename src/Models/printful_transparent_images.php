<?php

namespace Bms\Store\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class printful_transparent_images extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "printful_transparent_images";
}
