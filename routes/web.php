<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContratoController;


//Raiz
Route::get('/', [ContratoController::class, 'index'])->name('home');

//Formularios

Route::get   ('/contratos',               [ContratoController::class, 'index'      ])->name('contratos.index'       );
Route::get   ('/contratos/{id}',          [ContratoController::class, 'show'       ])->name('contratos.show'        );
Route::get   ('/contratos/{id}/edit',     [ContratoController::class, 'edit'       ])->name('contratos.edit'        );
Route::get   ('/contratos/importar',      [ContratoController::class, 'head'       ])->name('contratos.head'        );
Route::put   ('/contratos/{id}',          [ContratoController::class, 'update'     ])->name('contratos.update'      );
Route::delete('/contratos/{id}',          [ContratoController::class, 'destroy'    ])->name('contratos.destroy'     );
Route::post  ('/contratos/exportar-csv',  [ContratoController::class, 'exportarCSV'])->name('contratos.exportarCSV' );
Route::post  ('/contratos/importar-csv',  [ContratoController::class, 'importarCSV'])->name('contratos.importar-csv');


