<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;

    protected $fillable = [
        'DT_DATA_ASSINATURA',
        'NU_VALOR_FINANCIAMENTO',
        'NU_TAXA_JUROS',
        'NU_PRAZO_CARENCIA',
        'NO_NOME_MUTUARIO',
        'NU_CPF',
        'NU_NUMERO_IDENTIDADE',
        'DT_DATA_NASCIMENTO',
        'NO_ESTADO_CIVIL',
        'NO_SEXO',
        'NO_UF',
        'NO_MUNICIPIO',
        'NO_ENDERECO',
        'NU_CEP'
    ];
}
