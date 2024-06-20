<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratosTable extends Migration
{

    public function up()
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->id('NU_NUMERO_CONTRATO');
            $table->date('DT_DATA_ASSINATURA');
            $table->decimal('NU_VALOR_FINANCIAMENTO', 10, 2);
            $table->decimal('NU_TAXA_JUROS', 5, 3);
            $table->integer('NU_PRAZO_CARENCIA');
            $table->string('NO_NOME_MUTUARIO');
            $table->string('NU_CPF')->unique();
            $table->string('NU_NUMERO_IDENTIDADE')->unique();
            $table->date('DT_DATA_NASCIMENTO');
            $table->string('NO_ESTADO_CIVIL');
            $table->string('NO_SEXO', 1);
            $table->string('NO_UF', 2);
            $table->string('NO_MUNICIPIO');
            $table->string('NO_ENDERECO');
            $table->string('NU_CEP', 8);
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('contratos');
    }
}
