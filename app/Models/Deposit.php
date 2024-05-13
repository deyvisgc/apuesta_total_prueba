<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;
    protected $table = 'deposit';
    protected $primaryKey = 'id'; 
   public $timestamps = true;

   /**
    * Los atributos que deben convertirse en fechas de Carbon.
    *
    * @var array
    */

   protected $dates = ['created_at', 'updated_at'];
   
   protected $fillable = [
       'client_id',
       'voucher',
       'amount',
       'bank_id',
       'date_hour',
       'chanel'
   ];
   // En el modelo Deposit
    public function client()
    {
        return $this->belongsTo('App\Models\Client', 'client_id');
    }
    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

}
