{{-- resources/views/contratos/index.blade.php --}}

@extends('layouts.app')

@section('title', 'Lista de Contratos')

@section('content')
    <div class="container">
        <h1>Contratos</h1>

        {{-- Formulário de Filtros --}}
        <form method="GET" action="{{ route('contratos.index') }}" class="mb-4">
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
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>
            </div>
        </form>

        {{-- Tabela de Resultados --}}
        <table class="table table-bordered">
            <thead>
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
                            <a href="{{ route('contratos.show', $contrato->id) }}" class="btn btn-info">Visualizar</a>
                            <a href="{{ route('contratos.edit', $contrato->id) }}" class="btn btn-warning">Alterar</a>
                            <form action="{{ route('contratos.destroy', $contrato->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este contrato?')">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Paginação --}}
        {{ $contratos->links() }}
    </div>
@endsection

@section('total')

<!DOCTYPE html>
    <html lang="pt-br">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Exportar para CSV</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    </head>
    <body>
      <div class="container mt-3">
        <h1>Exportar para CSV</h1>

        <table class="table table-striped">
          <thead>
            <tr>
              <th>Coluna1</th>
              <th>Coluna2</th>
              </tr>
          </thead>
          <tbody>
          </tbody>
        </table>

        <div class="mt-3">
          <button class="btn btn-primary" id="selectAllBtn">Selecionar Todos</button>
          <a href="{{ route('exportar-csv',  $contrato->id)) }}" class="btn btn-success">Exportar para CSV</a>
        </div>
      </div>

      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

      <script>
        $(document).ready(function() {
          $('#selectAllBtn').click(function() {
            $('input[type="checkbox"]').prop('checked', true);
          });
        });
      </script>

@endsection
