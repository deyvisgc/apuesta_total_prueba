<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    protected $table = 'province';
    protected $fillable = [
        'id', // Asegúrate de agregar la clave primaria a la lista de atributos asignables si no es autoincrementable
        'name',
        'department_id'
    ];
}
