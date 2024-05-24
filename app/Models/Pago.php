<?php

namespace App\Models;

use App\Http\Controllers\CuotasController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

  
    protected $table = 'pagos';
    protected $primaryKey = 'idpago'; // Asegura que 'idpago' es la clave primaria
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = ['idsocio', 'fechpago_de_cuota', 'idcuota', 'total_pago'];

    public function socios()
    {
        return $this->belongsToMany(Socio::class, 'pagoscuotas_socios', 'idpago', 'idsociopagado');
    }
    
    public function cuotas()
    {
        return $this->belongsToMany(Cuotas::class, 'pagoscuotas_socios');
    }
    public function sociosPagados()
    {
        return $this->belongsToMany(Socio::class, 'pagoscuotas_socios', 'idpago', 'idsociopagado');
    }
public function pagos()
{
    return $this->belongsToMany(Pago::class, 'pagoscuotas_socios', 'idsociopagado', 'idpago');
}

}