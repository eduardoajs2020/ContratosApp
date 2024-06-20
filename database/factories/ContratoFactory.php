<?php

namespace Database\Factories;

use App\Models\Contrato;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contrato>
 */
class ContratoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'DT_DATA_ASSINATURA' => $this->faker->dateTimeBetween('-5 years', 'now'),
            'NU_VALOR_FINANCIAMENTO' => $this->faker->randomFloat(2, 10000, 50000),
            'NU_TAXA_JUROS' => $this->faker->randomFloat(3, 1, 50),
            'NU_PRAZO_CARENCIA' => $this->faker->numberBetween(1, 60),
            'NO_NOME_MUTUARIO' => $this->faker->firstName,
            'NU_CPF' => $this->faker->unique()->numerify('###########'),
            'NU_NUMERO_IDENTIDADE' => $this->faker->unique()->numerify('########'),
            'DT_DATA_NASCIMENTO' => $this->faker->dateTimeBetween('-80 years', '-18 years'),
            'NO_ESTADO_CIVIL' => $this->faker->randomElement(['solteiro', 'casado', 'divorciado', 'viúvo']),
            'NO_SEXO' => $this->faker->randomElement(['M', 'F']),
            'NO_UF' => $this->faker->stateAbbr,
            'NO_MUNICIPIO' => $this->faker->city,
            'NO_ENDERECO' => $this->faker->streetAddress,
            'NU_CEP' => $this->faker->numerify('########')
            
        ];
    }
}
