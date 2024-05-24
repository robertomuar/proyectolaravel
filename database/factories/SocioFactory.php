<?php

namespace Database\Factories;

use App\Models\Socio;
use Illuminate\Database\Eloquent\Factories\Factory;

class SocioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre_socio' => $this->faker->firstName,
            'apellido1_socio' => $this->faker->lastName,
            'tlf_socio' => $this->faker->numerify('#########'), // Genera un número de teléfono de 9 dígitos
            'email_socio' => $this->faker->unique()->safeEmail,
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'), // Fecha de creación
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'), // Fecha de última modificación
            // Aquí puedes agregar más atributos de tu modelo Socio si los tienes
        ];
    }
}

