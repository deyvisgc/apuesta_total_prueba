<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departament extends Model
{
    use HasFactory;
    protected $table = 'departament';
    protected $fillable = [
        'id', // Asegúrate de agregar la clave primaria a la lista de atributos asignables si no es autoincrementable
        'name',
    ];
}
