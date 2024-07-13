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

    protected $table = 'contratos';

    // Defina a chave primária, caso não seja 'id'
    protected $primaryKey = 'NU_NUMERO_CONTRATO'; // Exemplo de chave primária diferente

    // Se a chave primária não for auto-incremento, defina $incrementing como false
    public $incrementing = false;

    // Se a chave primária não for um inteiro, defina $keyType como 'string'
    protected $keyType = 'string';
}

