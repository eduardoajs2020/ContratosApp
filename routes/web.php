<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\FrontController;

//Raiz
Route::get('/', [ContratoController::class, 'index'])->name('home');

//Formularios

Route::get   ('/contratos',               [ContratoController::class, 'index'      ])->name('contratos.index'       );
Route::get   ('/contratos/{id}',          [ContratoController::class, 'show'       ])->name('contratos.show'        );
Route::get   ('/contratos/{id}/edit',     [ContratoController::class, 'edit'       ])->name('contratos.edit'        );
Route::put   ('/contratos/{id}',          [ContratoController::class, 'update'     ])->name('contratos.update'      );
Route::delete('/contratos/{id}',          [ContratoController::class, 'destroy'    ])->name('contratos.destroy'     );
Route::get   ('/contratos/exportar-csv',  [ContratoController::class, 'exportarCSV'])->name('contratos.exportarCSV' );
Route::post  ('/contratos/importar-csv',  [ContratoController::class, 'importarCSV'])->name('contratos.importar-csv');
Route::get   ('/mostrarTabela',           [ContratoController::class, 'mostrarTabela'])->name('contratos.importarParaBanco');

//Views
Route::get   ('/importArchive',           [FrontController::class, 'importArchive' ])->name('importArchive'         );
Route::post  ('/importarCSV',             [FrontController::class, 'importarCSV'   ])->name('importarCSV'           );
Route::get   ('/exportarCSV',             [FrontController::class, 'exportarCSV'   ])->name('exportarCSV'           );
Route::get   ('/exportarPDF',             [FrontController::class, 'exportarPDF'   ])->name('exportarPDF'           );
Route::get   ('/exportarHTML',            [FrontController::class, 'exportarHTML'  ])->name('exportarHTML'          );





