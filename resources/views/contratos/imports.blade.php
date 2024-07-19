
<!--{{-- resources/views/contratos/imports.blade.php --}}

@extends('layouts.app')-->
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <title>Sistema de Gestão de Contratos</title>
</head>


<div class="card p-4 mb-4">
    <h1 class="mb-4">Adicionar novos Contratos </h1>

    <form action="{{ route('contratos.importar-csv') }}" method="post" enctype="multipart/form-data">

      @csrf
        <div class="form-group">

            <label for="arquivo_csv">Selecione um arquivo no formato CSV para a importação:</label>
            <input type="file" class="form-control-file" id="arquivo_csv" name="arquivo_csv" required>
            <br>
            <button type="submit" class="btn btn-primary mt-2">Importar Contratos</button>
        </div>

    </form>
</div>

