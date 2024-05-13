<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesConsultant extends Model
{
    use HasFactory;
    protected $table = 'sales_consultant';
    protected $primaryKey = 'id'; 
    public $timestamps = true;

   /**
    * Los atributos que deben convertirse en fechas de Carbon.
    *
    * @var array
    */

   protected $dates = ['created_at', 'updated_at'];
   
   protected $fillable = [
       'person_id',
   ];
   public function usuario()
   {

       return $this->hasOne(User::class, 'sales_id');

   }
   
   public function person()
   {
       return $this->belongsTo('App\Models\Person', 'person_id');
   }
   public function clients()
    {
        return $this->hasMany(Client::class);
    }
    public function communications()
    {
        return $this->hasMany(Comunication::class);
    }
    
}
