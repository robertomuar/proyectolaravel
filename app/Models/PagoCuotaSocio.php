<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoCuotaSocio extends Model
{
    use HasFactory;

    protected $table = 'pagoscuotas_socios';
    public $timestamps = false;

    protected $fillable = ['idsocio', 'idpago', 'idsociospagados'];
}