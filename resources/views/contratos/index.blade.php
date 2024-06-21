{{-- resources/views/contratos/index.blade.php --}}

@extends('layouts.app')

@section('title', 'Lista de Contratos')

@section('content')


<h1>Novos Contratos para Carga </h1>
    <br>
    <div>
        <form action="{{ route('contratos.importar-csv') }}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="arquivo_csv">Selecione o arquivo para a importação, no formato CSV:</label>
            <input type="file" id="arquivo_csv" name="arquivo_csv" required>
            <button type="submit" class="btn btn-primary">Importar CSV</button>
        </form>
    </div>
    <br><br>

    <div class="container">
        <h1>Pesquisa de Contratos</h1>
        <br>

        {{-- Formulário de Filtros --}}
        <a href="{{ route('contratos.index') }}" class="btn btn-primary">Listar Todos os Contratos</a>         
        
        {{-- Formulário de Filtros --}}
        <br><br>
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


