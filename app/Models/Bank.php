<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;
    protected $table = 'bank';
    protected $primaryKey = 'id'; 
   public $timestamps = true;

   /**
    * Los atributos que deben convertirse en fechas de Carbon.
    *
    * @var array
    */

   protected $dates = ['created_at', 'updated_at'];
   
   protected $fillable = [
       'name',
   ];
   public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }
}
