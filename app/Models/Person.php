<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    protected $table = 'person';
    protected $primaryKey = 'id'; 
   public $timestamps = false;
   
   protected $fillable = [
       'document_type',
       'document_number',
       'name',
       'phone',
       'addres',
       'cod_departament',
       'cod_province',
       'cod_district'
   ];
   public function cliente()
   {
       return $this->hasOne(Client::class);
   }
}
