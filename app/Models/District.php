<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $table = 'district';
    protected $fillable = [
        'id', // Asegúrate de agregar la clave primaria a la lista de atributos asignables si no es autoincrementable
        'name',
        'province_id',
        'department_id'
    ];
}
