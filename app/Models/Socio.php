<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Socio extends Model
{
    use HasFactory;

    protected $table = 'socios';
    protected $primaryKey = 'idsocio'; // Asegura que 'idsocio' es la clave primaria
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nombre_socio',
        'apellido1_socio',
        'tlf_socio',
        'email_socio',
    ];
}