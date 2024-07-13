{{-- resources/views/contratos/edit.blade.php --}}

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Contrato</h1>

        <form action="{{ route('contratos.update', $contrato->NU_NUMERO_CONTRATO) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="NU_NUMERO_CONTRATO">Número do Contrato</label>
                <input type="text" name="NU_NUMERO_CONTRATO" class="form-control" value="{{ $contrato->NU_NUMERO_CONTRATO }}" required>
            </div>
            <div class="form-group">
                <label for="DT_DATA_ASSINATURA">Data de Assinatura</label>
                <input type="date" name="DT_DATA_ASSINATURA" class="form-control" value="{{ $contrato->DT_DATA_ASSINATURA }}" required>
            </div>
            <div class="form-group">
                <label for="NO_NOME_MUTUARIO">Nome do Mutuário</label>
                <input type="text" name="NO_NOME_MUTUARIO" class="form-control" value="{{ $contrato->NO_NOME_MUTUARIO }}" required>
            </div>
            <div class="form-group">
                <label for="NU_CPF">CPF</label>
                <input type="text" name="NU_CPF" class="form-control" value="{{ $contrato->NU_CPF }}" required>
            </div>
            <div class="form-group">
                <label for="NU_NUMERO_IDENTIDADE">Número de Identidade</label>
                <input type="text" name="NU_NUMERO_IDENTIDADE" class="form-control" value="{{ $contrato->NU_NUMERO_IDENTIDADE }}" required>
            </div>
            {{-- Não esquecer de adicionar os outros campos --}}
            <button type="submit" class="btn btn-success" onclick="return confirm('Alteração realizada com sucesso!')">Salvar Alterações</button>
            <a href="{{ route('contratos.index') }}" class="btn btn-primary">Cancelar</a>
        </form>
    </div>
@endsection
