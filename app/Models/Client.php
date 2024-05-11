<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
   public $timestamps = true;

   /**
    * Los atributos que deben convertirse en fechas de Carbon.
    *
    * @var array
    */
   protected $dates = ['created_at', 'updated_at'];
   
   protected $fillable = [
       'document_type', // Asegúrate de agregar la clave primaria a la lista de atributos asignables si no es autoincrementable
       'document_number',
       'name',
       'phone',
       'player_id',
       'balance',
   ];
}
