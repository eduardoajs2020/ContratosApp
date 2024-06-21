<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use Illuminate\Http\Request;

class ContratoController extends Controller

{
    // Exibe a lista de contratos com filtros
    public function index(Request $request)
    {
        $query = Contrato::query();

        // Aplicar filtros
        if ($request->filled('NU_NUMERO_CONTRATO')) {
            $query->where('NU_NUMERO_CONTRATO', $request->input('NU_NUMERO_CONTRATO'));
        }
        if ($request->filled('DT_DATA_ASSINATURA')) {
            $query->where('DT_DATA_ASSINATURA', $request->input('DT_DATA_ASSINATURA'));
        }
        if ($request->filled('NO_NOME_MUTUARIO')) {
            $query->where('NO_NOME_MUTUARIO', 'like', '%' . $request->input('NO_NOME_MUTUARIO') . '%');
        }
        if ($request->filled('NU_CPF')) {
            $query->where('NU_CPF', $request->input('NU_CPF'));
        }
        if ($request->filled('NU_NUMERO_IDENTIDADE')) {
            $query->where('NU_NUMERO_IDENTIDADE', $request->input('NU_NUMERO_IDENTIDADE'));
        }

        $contratos = $query->paginate(10);

        return view('contratos.index', compact('contratos'));
    }

    // Mostra um contrato específico
    public function show($id)
    {
        $contrato = Contrato::findOrFail($id);
        return view('contratos.show', compact('contrato'));
    }

    // Mostra o formulário de edição
    public function edit($id)
    {
        $contrato = Contrato::findOrFail($id);
        return view('contratos.edit', compact('contrato'));
    }

    // Atualiza um contrato específico
    public function update(Request $request, $id)
    {
        $contrato = Contrato::findOrFail($id);
        $contrato->update($request->all());

        return redirect()->route('contratos.index')->with('success', 'Contrato atualizado com sucesso.');
    }

    // Exclui um contrato específico
    public function destroy($id)
    {
        $contrato = Contrato::findOrFail($id);
        $contrato->delete();

        return redirect()->route('contratos.index')->with('success', 'Contrato excluído com sucesso.');
    }

    public function exportarCSV()
    {
        // Obter os dados que você deseja exportar
        $dados = Contrato::table('contratos')->get();

        $colunas = [
            'contrato' => 'NU_NUMERO_CONTRATO',
            'data_assinatura' => 'DT_DATA_ASSINATURA',
            'valor_financiamento' => 'NU_VALOR_FINANCIAMENTO',
            'taxa_juros' => 'NU_TAXA_JUROS',
            'prazo_carencia' => 'NU_PRAZO_CARENCIA',
            'nome_mutuario' => 'NO_NOME_MUTUARIO',
            'cpf' => 'NU_CPF',
            'numero_identidade' => 'NU_NUMERO_IDENTIDADE',
            'data_nascimento' => 'DT_DATA_NASCIMENTO',
            'estado_civil' => 'NO_ESTADO_CIVIL',
            'sexo' => 'NO_SEXO',
            'uf' => 'NO_UF',
            'municipio' => 'NO_MUNICIPIO',
            'endereco' => 'NO_ENDERECO',
            'cep' => 'NU_CEP',
];

        // Converter os dados em um array associativo
        $arrayDados = [];

       foreach ($dados as $dado) {
        $linha = [];

        foreach ($colunas as $coluna => $campo) {
            $linha[$coluna] = $dado->$campo;
    }

        $arrayDados[] = $linha;
}

        // Criar o arquivo CSV
        $arquivoCSV = fopen('export.csv', 'w');

        // Escrever os cabeçalhos das colunas
        fputcsv($arquivoCSV, array_keys($colunas));

        // Escrever os dados das linhas
        foreach ($arrayDados as $linha) {
            fputcsv($arquivoCSV, $linha);
        }

        // Fechar o arquivo CSV
        fclose($arquivoCSV);

        // Redirecionar para o download do arquivo CSV
        return response()->download('export.csv');
    }

    public function importarCSV(Request $request)
{
    // Validar o arquivo CSV
    $request->validate([
        'arquivo_csv' => 'required|file|mimes:csv',
    ]);

    // Obter o arquivo CSV
    $arquivoCSV = $request->file('arquivo_csv');

    // Ler o conteúdo do arquivo CSV
    $dadosCSV = [];
    if (($handle = fopen($arquivoCSV->getRealPath(), 'r')) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
            $dadosCSV[] = $data;
        }
        fclose($handle);
    }

    // Remover a primeira linha do CSV (cabeçalho)
    array_shift($dadosCSV);

    // Mapear os dados do CSV para o modelo Contrato
    $contratos = [];

    foreach ($dadosCSV as $linha) {
        $contrato = new Contrato();
        $contrato->NU_NUMERO_CONTRATO       = $linha[0];
        $contrato->DT_DATA_ASSINATURA       = $linha[1];
        $contrato->NU_VALOR_FINANCIAMENTO   = $linha[2];
        $contrato->NU_TAXA_JUROS            = $linha[3];
        $contrato->NU_PRAZO_CARENCIA        = $linha[4];
        $contrato->NO_NOME_MUTUARIO         = $linha[5];
        $contrato->NU_NUMERO_IDENTIDADE     = $linha[6];
        $contrato->DT_DATA_NASCIMENTO       = $linha[7];
        $contrato->NO_ESTADO_CIVIL          = $linha[8];
        $contrato->NO_SEXO                  = $linha[9];
        $contrato->NO_UF                    = $linha[10];
        $contrato->NO_MUNICIPIO             = $linha[11];
        $contrato->NO_ENDERECO              = $linha[12];
        $contrato->NU_CEP                   = $linha[13];
        $contratos[] = $contrato;
    }

    // Salvar os contratos no banco de dados
    Contrato::insert($contratos);

    // Retornar mensagem de sucesso
    return redirect()->route('contratos.index')->with('success', 'Contratos importados com sucesso.');
    }


}
