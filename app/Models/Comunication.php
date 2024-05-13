<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comunication extends Model
{
    use HasFactory;
    protected $table = 'communication';
    protected $primaryKey = 'id'; 
   public $timestamps = true;

   /**
    * Los atributos que deben convertirse en fechas de Carbon.
    *
    * @var array
    */

   protected $dates = ['created_at', 'updated_at'];
   
   protected $fillable = [
       'sales_id', 'client_id', 'channel', 'message', 'status'
   ];
//    public function asesor()
//     {
//         return $this->belongsToMany('App\Models\SalesConsultant', 'sales_id');
//     }
//     public function client()
//     {
//         return $this->belongsToMany('App\Models\Client', 'client_id');

//     }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function asesor()
    {
        return $this->belongsTo('App\Models\SalesConsultant', 'sales_id');
    }
}
