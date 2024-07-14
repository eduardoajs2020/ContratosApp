<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
     public function head()
    {

    $arquivo = file_get_contents(resource_path('views/contratos/head.blade.php'));

    return response($arquivo, 200, ['Content-Type' => 'text/html']);
    }
}
