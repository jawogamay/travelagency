<?php

namespace App;
use App\SalesAgreement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
class Booklet extends Model
{
    use Notifiable, HasApiTokens;


    protected $fillable = [
        'nameAssign','bookletNumber','f1','f2'
    ];

    public function users(){
        return $this->belongsTo('App\User');
    }
 
}
