<!DOCTYPE html>
<html>
<head>
    <title>Tabela de Contratos</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Contratos</h1>

    <!-- Exibir mensagens de sucesso ou erro -->
    @if (session('sucesso'))
        <div class="alert alert-success">
            {{ session('sucesso') }}
        </div>
    @endif

    @if (session('erro'))
        <div class="alert alert-danger">
            {{ session('erro') }}
        </div>
    @endif

    <!-- Conteúdo da tabela de contratos -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>NU_NUMERO_CONTRATO</th>
                <th>DT_DATA_ASSINATURA</th>
                <th>NU_VALOR_FINANCIAMENTO</th>
                <th>NU_TAXA_JUROS</th>
                <th>NU_PRAZO_CARENCIA</th>
                <th>NO_NOME_MUTUARIO</th>
                <th>NU_CPF</th>
                <th>NU_NUMERO_IDENTIDADE</th>
                <th>DT_DATA_NASCIMENTO</th>
                <th>NO_ESTADO_CIVIL</th>
                <th>NO_SEXO</th>
                <th>NO_UF</th>
                <th>NO_MUNICIPIO</th>
                <th>NO_ENDERECO</th>
                <th>NU_CEP</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contratos as $contrato)
                <tr>
                    <td>{{ $contrato->NU_NUMERO_CONTRATO }}</td>
                    <td>{{ $contrato->DT_DATA_ASSINATURA }}</td>
                    <td>{{ $contrato->NU_VALOR_FINANCIAMENTO }}</td>
                    <td>{{ $contrato->NU_TAXA_JUROS }}</td>
                    <td>{{ $contrato->NU_PRAZO_CARENCIA }}</td>
                    <td>{{ $contrato->NO_NOME_MUTUARIO }}</td>
                    <td>{{ $contrato->NU_CPF }}</td>
                    <td>{{ $contrato->NU_NUMERO_IDENTIDADE }}</td>
                    <td>{{ $contrato->DT_DATA_NASCIMENTO }}</td>
                    <td>{{ $contrato->NO_ESTADO_CIVIL }}</td>
                    <td>{{ $contrato->NO_SEXO }}</td>
                    <td>{{ $contrato->NO_UF }}</td>
                    <td>{{ $contrato->NO_MUNICIPIO }}</td>
                    <td>{{ $contrato->NO_ENDERECO }}</td>
                    <td>{{ $contrato->NU_CEP }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
