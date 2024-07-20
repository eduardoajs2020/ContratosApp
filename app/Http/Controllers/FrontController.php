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

}
