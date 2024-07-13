{{-- resources/views/contratos/show.blade.php --}}

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Visualizar Contrato</h1>

        <table class="table table-bordered">
            <tr>
                <th>Número do Contrato</th>
                <td>{{ $contrato->NU_NUMERO_CONTRATO }}</td>
            </tr>
            <tr>
                <th>Data de Assinatura</th>
                <td>{{ $contrato->DT_DATA_ASSINATURA }}</td>
            </tr>
            <tr>
                <th>Nome do Mutuário</th>
                <td>{{ $contrato->NO_NOME_MUTUARIO }}</td>
            </tr>
            <tr>
                <th>CPF</th>
                <td>{{ $contrato->NU_CPF }}</td>
            </tr>
            <tr>
                <th>Número de Identidade</th>
                <td>{{ $contrato->NU_NUMERO_IDENTIDADE }}</td>
            </tr>
            <tr>
                <th>Data de Nascimento</th>
                <td>{{ $contrato->DT_DATA_NASCIMENTO }}</td>
            </tr>
            <tr>
                <th>Estado Civil</th>
                <td>{{ $contrato->NO_ESTADO_CIVIL }}</td>
            </tr>
            <tr>
                <th>Sexo</th>
                <td>{{ $contrato->NO_SEXO }}</td>
            </tr>
            <tr>
                <th>UF</th>
                <td>{{ $contrato->NO_UF }}</td>
            </tr>
            <tr>
                <th>Município</th>
                <td>{{ $contrato->NO_MUNICIPIO }}</td>
            </tr>
            <tr>
                <th>Endereço</th>
                <td>{{ $contrato->NO_ENDERECO }}</td>
            </tr>
            <tr>
                <th>CEP</th>
                <td>{{ $contrato->NU_CEP }}</td>
            </tr>
        </table>

        <a href="{{ route('contratos.index') }}" class="btn btn-primary">Voltar</a>
        <a href="{{ route('contratos.edit', $contrato->NU_NUMERO_CONTRATO) }}" class="btn btn-warning">Alterar</a>
        <form action="{{ route('contratos.destroy', $contrato->NU_NUMERO_CONTRATO) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este contrato?')">Excluir</button>
        </form>
    </div>
@endsection
