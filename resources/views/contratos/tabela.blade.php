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
<body>

<h2>Tabela de Contratos</h2>

<table>
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
        @foreach ($dados as $linha)
        <tr>
           @foreach ($dados as $linha)
            <tr>
                <td>{{ $linha[0] }}</td>                 <td>{{ $linha[1] }}</td>                 @if (isset($linha[2]))                     <td>{{ $linha[2] }}</td>                 @else
                    <td>{{ $linhaModificada[$linha[0]] ?? '' }}</td>                 @endif
                <td>{{ $linha[3] }}</td>                 ...             </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
