<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;

class Finaluser extends Model
{

    protected $fillable = [
        'id','name', 'post_code', 'phone_number',
    ];
 
    
}
