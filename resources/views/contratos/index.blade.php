@extends('layouts.app')

@section('title', 'Lista de Contratos')
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <title>Sistema de Gestão de Contratos</title>
</head>


@section('content')
<div class="container my-4">
{{-- Header --}}
    <div class="header text-center mb-4">
        <h1 class="display-5 p-3 mb-2 bg-primary text-white rounded-2">Caixa Econômica Federal</h1>
        <p class="lead">Sistema de Gestão de Contratos</p>
    </div>

{{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <a class="navbar-brand" href="#">Contratos Habitacionais</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('home') }}">Início <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contratos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contratos.head') }}">Importar Contratos</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contratos.head') }}">Relatórios</a>

                </li>

            </ul>
        </div>
    </nav>



    <h1 class="mb-4">Pesquisar Contratos</h1>
    <div class="card p-4 mb-4">
        <a href="{{ route('contratos.index') }}" class="btn btn-secondary mb-3">Listar Todos os Contratos</a>

        <form method="GET" action="{{ route('contratos.index') }}">
            <div class="row">
                <div class="col">
                    <input type="text" name="NU_NUMERO_CONTRATO" class="form-control" placeholder="Número do Contrato" value="{{ request('NU_NUMERO_CONTRATO') }}">
                </div>
                <div class="col">
                    <input type="date" name="DT_DATA_ASSINATURA" class="form-control" placeholder="Data de Assinatura" value="{{ request('DT_DATA_ASSINATURA') }}">
                </div>
                <div class="col">
                    <input type="text" name="NO_NOME_MUTUARIO" class="form-control" placeholder="Nome do Mutuário" value="{{ request('NO_NOME_MUTUARIO') }}">
                </div>
                <div class="col">
                    <input type="text" name="NU_CPF" class="form-control" placeholder="CPF" value="{{ request('NU_CPF') }}">
                </div>
                <div class="col">
                    <input type="text" name="NU_NUMERO_IDENTIDADE" class="form-control" placeholder="Número de Identidade" value="{{ request('NU_NUMERO_IDENTIDADE') }}">
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary btn-block">Filtrar</button>
                </div>
            </div>
        </form>
    </div>

    <div class="card p-4 mb-4">
        <h2 class="mb-4">Lista de Contratos</h2>
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Número do Contrato</th>
                    <th>Data de Assinatura</th>
                    <th>Nome do Mutuário</th>
                    <th>CPF</th>
                    <th>Número de Identidade</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contratos as $contrato)
                    <tr>
                        <td>{{ $contrato->NU_NUMERO_CONTRATO }}</td>
                        <td>{{ $contrato->DT_DATA_ASSINATURA }}</td>
                        <td>{{ $contrato->NO_NOME_MUTUARIO }}</td>
                        <td>{{ $contrato->NU_CPF }}</td>
                        <td>{{ $contrato->NU_NUMERO_IDENTIDADE }}</td>
                        <td>
                            <a href="{{ route('contratos.show', $contrato->NU_NUMERO_CONTRATO) }}" class="btn btn-info btn-sm">Visualizar</a>
                            <a href="{{ route('contratos.edit', $contrato->NU_NUMERO_CONTRATO) }}" class="btn btn-warning btn-sm">Alterar</a>
                            <form action="{{ route('contratos.destroy', $contrato->NU_NUMERO_CONTRATO) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este contrato?')">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-3">
            <form action="{{ route('contratos.exportarCSV') }}" method="get">
                @csrf
                <button type="submit" class="btn btn-primary">Exportar Contratos para CSV</button>
            </form>
        </div>

    </div>

    {{-- Paginação --}}
    <div class="d-flex justify-content-center">
        {{ $contratos->links('pagination::bootstrap-4') }}
    </div>
    @include('contratos.head')
</div>

@endsection
