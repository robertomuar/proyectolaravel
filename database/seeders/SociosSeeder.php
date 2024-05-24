<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Socio;

class SociosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Elimina todos los registros existentes en la tabla Socios
        Socio::truncate();
        
        // Utiliza el factory SocioFactory para crear 20 registros de ejemplo
        Socio::factory()->count(20)->create();
    }
}