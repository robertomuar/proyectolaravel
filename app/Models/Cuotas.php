<?php
// app/Models/Cuotas.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cuotas extends Model
{
    protected $table = 'cuotas';
    protected $primaryKey = 'idcuota';
    public $timestamps = true; // Activa el manejo automático de timestamps

    // Define el atributo importecuota como entero
    protected $casts = [
        'importecuota' => 'integer',
    ];
    public function pagos()
{
    return $this->belongsToMany(Pago::class);
}
}
