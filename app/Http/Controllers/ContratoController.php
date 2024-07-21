<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Laravel\Prompts\Table;

use function PHPUnit\Framework\countOf;
use function PHPUnit\Framework\returnSelf;

class ContratoController extends Controller
{
    // Exibe a lista de contratos com filtros
    public function index(Request $request)
    {
        $query = Contrato::query();

        $filters = [
            'NU_NUMERO_CONTRATO',
            'DT_DATA_ASSINATURA',
            'NO_NOME_MUTUARIO',
            'NU_CPF',
            'NU_NUMERO_IDENTIDADE'
        ];

        foreach ($filters as $filter) {
            if ($request->filled($filter)) {
                $query->where($filter, 'like', '%' . $request->input($filter) . '%');
            }
        }

        $contratos = $query->paginate(10);
        return view('contratos.index', compact('contratos'));
    }

    // Mostra um contrato específico
    public function show($NU_NUMERO_CONTRATO)
    {
        $contrato = Contrato::findOrFail($NU_NUMERO_CONTRATO);
        return view('contratos.show', compact('contrato'));
    }

    // Mostra o formulário de edição
    public function edit($NU_NUMERO_CONTRATO)
    {
        $contrato = Contrato::findOrFail($NU_NUMERO_CONTRATO);
        return view('contratos.edit', compact('contrato'));
    }

    // Atualiza um contrato específico
    public function update(Request $request, $NU_NUMERO_CONTRATO)
    {
        $contrato = Contrato::findOrFail($NU_NUMERO_CONTRATO);
        $contrato->update($request->all());

        return redirect()->route('contratos.index')->with('success', 'Contrato atualizado com sucesso.');
    }

    // Exclui um contrato específico
    public function destroy($NU_NUMERO_CONTRATO)
    {
        $contrato = Contrato::findOrFail($NU_NUMERO_CONTRATO);
        $contrato->delete();

        return redirect()->route('contratos.index')->with('success', 'Contrato excluído com sucesso.');
    }

    // Exporta dados para CSV
public function exportarCSV()
{
    $contratos = Contrato::all();
    $csv = $this->gerarCSV($contratos);

    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename=contratos.csv',
    ];

    return response($csv, 200, $headers);
}

// Gera o conteúdo do CSV
private function gerarCSV($contratos)
{
    $headers = [
        'NU_NUMERO_CONTRATO',
        'DT_DATA_ASSINATURA',
        'NU_VALOR_FINANCIAMENTO',
        'NU_TAXA_JUROS',
        'NU_PRAZO_CARENCIA',
        'NO_NOME_MUTUARIO',
        'NU_CPF',
        'NU_NUMERO_IDENTIDADE',
        'DT_DATA_NASCIMENTO',
        'NO_ESTADO_CIVIL',
        'NO_SEXO',
        'NO_UF',
        'NO_MUNICIPIO',
        'NO_ENDERECO',
        'NU_CEP'
    ];

    $output = fopen('php://temp', 'w');
    fputcsv($output, $headers);

    foreach ($contratos as $contrato) {
        fputcsv($output, [
            $contrato->NU_NUMERO_CONTRATO,
            $contrato->DT_DATA_ASSINATURA,
            $contrato->NU_VALOR_FINANCIAMENTO,
            $contrato->NU_TAXA_JUROS,
            $contrato->NU_PRAZO_CARENCIA,
            $contrato->NO_NOME_MUTUARIO,
            $contrato->NU_CPF,
            $contrato->NU_NUMERO_IDENTIDADE,
            $contrato->DT_DATA_NASCIMENTO,
            $contrato->NO_ESTADO_CIVIL,
            $contrato->NO_SEXO,
            $contrato->NO_UF,
            $contrato->NO_MUNICIPIO,
            $contrato->NO_ENDERECO,
            $contrato->NU_CEP
        ]);
    }

    rewind($output);
    $csv = stream_get_contents($output);
    fclose($output);

    return $csv;
}


// Função para importar CSV
public function importarCSV()
{
    if (request()->hasFile('arquivo_csv')) {
        $arquivo = request()->file('arquivo_csv');

        // Ler o conteúdo do CSV
        $dadosCSV = $this->lerCSV($arquivo->path());

        // Importar dados para o banco de dados
        $this->importarParaBanco($dadosCSV);

        return redirect()->route('contratos.index')->with('sucesso', 'Importação concluída!');

    } else {
         return redirect()->route('contratos.index')->with('erro', 'Selecione um arquivo para upload.');
    }
}

// Função para ler o conteúdo do CSV
private function lerCSV($caminhoArquivo)
{
    $dados = [];

    if (($handle = fopen($caminhoArquivo, 'r')) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ';')) !== FALSE) {
            $dados[] = $data;
        }
        fclose($handle);
    }

    return $dados;
}

// Função para importar dados para o banco de dados
private function importarParaBanco($dadosCSV)
{

    // Remover a primeira linha (cabeçalho)

     array_shift($dadosCSV);
    

    foreach ($dadosCSV as $linha) {


        $dadosContrato = [
            'NU_NUMERO_CONTRATO' => $linha[0],
            'DT_DATA_ASSINATURA' => $linha[1],
            'NU_VALOR_FINANCIAMENTO' => $linha[2],
            'NU_TAXA_JUROS' => $linha[3],
            'NU_PRAZO_CARENCIA' => $linha[4],
            'NO_NOME_MUTUARIO' => $linha[5],
            'NU_CPF' => $linha[6],
            'NU_NUMERO_IDENTIDADE' => $linha[7],
            'DT_DATA_NASCIMENTO' => $linha[8],
            'NO_ESTADO_CIVIL' => $linha[9],
            'NO_SEXO' => $linha[10],
            'NO_UF' => $linha[11],
            'NO_MUNICIPIO' => $linha[12],
            'NO_ENDERECO' => $linha[13],
            'NU_CEP' => $linha[14],
        ];

        // Inserir dados na tabela 'contratos'
        if (DB::table('contratos')->insert($dadosContrato)){

            return redirect()->route('contratos.index')->with('sucesso', 'Dados incluídos no sistema com sucesso!');
        }
        else{
            return redirect()->route('contratos.index')->with('erro', 'Erro ao incluir dados, verifique a compatibilidade do arquivo!');
        }
     }
  }
}
