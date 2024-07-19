<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

class FrontController extends Controller
{
    public function importArchive()
    {
        if ($arquivo = file_get_contents(resource_path('views/contratos/imports.blade.php'))) {
            return response($arquivo, 200, ['Content-Type' => 'text/html']);
        } else {
            return response('Arquivo não encontrado', 404);
        }
    }

    // Ler CSV e retornar um array de dados
    public function lerArquivo($arquivo, $cabecalho = true, $delimitador = ',')
    {
        $arquivo = fopen($arquivo, 'r');
        $dados = [];
        $i = 0;

        while (($linha = fgetcsv($arquivo, 0, $delimitador)) && $i < 1000) {
            if ($cabecalho) {
                $cabecalho = false;
                continue;
            }
            $dados[] = $linha;
            $i++;
        }

        fclose($arquivo);
        return $dados;
    }

    // Importar CSV
    public function importarCSV(Request $request)
    {
        $arquivo = $request->file('arquivo');
        $nomeArquivo = $arquivo->getClientOriginalName();
        $arquivo->move(public_path('uploads'), $nomeArquivo);

        $dados = $this->lerArquivo(public_path('uploads/' . $nomeArquivo));
        $contratos = [];

        foreach ($dados as $linha) {
            $contrato = new Contrato();
            $contrato->nome = $linha[0];
            $contrato->valor = $linha[1];
            $contrato->data = $linha[2];
            $contrato->save();
            $contratos[] = $contrato;
        }

        return response()->json($contratos);
    }

    // Exportar CSV
    public function exportarCSV(Request $request)
    {
        $contratos = Contrato::all();
        $dados = [];

        foreach ($contratos as $contrato) {
            $dados[] = [
                $contrato->nome,
                $contrato->valor,
                $contrato->data,
            ];
        }

        $nomeArquivo = 'contratos.csv';
        $arquivo = fopen(public_path('uploads/' . $nomeArquivo), 'w');

        foreach ($dados as $linha) {
            fputcsv($arquivo, $linha);
        }

        fclose($arquivo);
        return response()->download(public_path('uploads/' . $nomeArquivo));
    }

    // Exportar PDF
    public function exportarPDF()
    {
        $contratos = Contrato::all();
        $dados = [];

        foreach ($contratos as $contrato) {
            $dados[] = [
                $contrato->nome,
                $contrato->valor,
                $contrato->data,
            ];
        }

        return Excel::create('contratos', function ($excel) use ($dados) {
            $sheet = $excel->sheet('Contratos');

            $sheet->row(1, [
                'ID', 'Nome', 'Valor', 'Data', // Exemplo de cabeçalho
            ]);

            $linha = 2; // Começar na linha 2

            foreach ($dados as $contrato) {
                $sheet->row($linha, [
                    $contrato['id'], // Acessar dados por chave
                    $contrato['nome'],
                    $contrato['valor'],
                    $contrato['data'], // Exemplo de dados
                ]);
                $linha++;
            }
        })->download('pdf');
    }

    // Exportar HTML
    public function exportarHTML()
    {
        $contratos = Contrato::all();
        $dados = [];

        foreach ($contratos as $contrato) {
            $dados[] = [
                $contrato->nome,
                $contrato->valor,
                $contrato->data,
            ];
        }

        return Excel::create('contratos', function ($excel) use ($dados) {
            $excel->sheet('contratos', function ($sheet) use ($dados) {
                $sheet->fromArray($dados);
            });
        })->download('html');
    }
}
?>
