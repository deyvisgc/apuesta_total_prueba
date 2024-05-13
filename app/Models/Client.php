<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $table = 'client';
    protected $primaryKey = 'id'; 
   public $timestamps = true;

   /**
    * Los atributos que deben convertirse en fechas de Carbon.
    *
    * @var array
    */

   protected $dates = ['created_at', 'updated_at'];
   
   protected $fillable = [
       'player_id',
       'balance',
       'person_id',
       
   ];
    public function user()
    {
        return $this->hasOne('App\Models\User');
    }
    public function person()
    {
        return $this->belongsTo('App\Models\Person', 'person_id');
    }
    // En el modelo Client
    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }
    // En el modelo Client
    public function sales()
    {
        return $this->belongsTo(SalesConsultant::class);
    }
    public function communications()
    {
        return $this->hasMany(Comunication::class);
    }
}
