<?php

namespace App;	
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class SalesAgreement extends Model
{
    use Notifiable, HasApiTokens;

    protected $fillable = [
      'saNumber','user_id'
    ];


}
