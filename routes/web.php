<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;




Route::get('/error', [FrontController::class, 'trateErros'])->name('contratos.trateErros');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login')->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');



//Raiz
Route::get('/', [ContratoController::class, 'index'])->name('home');

//Formularios

Route::get   ('/contratos',               [ContratoController::class, 'index'      ])->name('contratos.index'       );
Route::get   ('/contratos/{id}',          [ContratoController::class, 'show'       ])->name('contratos.show'        );
Route::get   ('/contratos/{id}/edit',     [ContratoController::class, 'edit'       ])->name('contratos.edit'        );
Route::put   ('/contratos/{id}',          [ContratoController::class, 'update'     ])->name('contratos.update'      );
Route::delete('/contratos/{id}',          [ContratoController::class, 'destroy'    ])->name('contratos.destroy'     )->middleware('auth');;
Route::get   ('/contratos/exportar-csv',  [ContratoController::class, 'exportarCSV'])->name('contratos.exportarCSV' );
Route::post  ('/contratos/importar-csv',  [ContratoController::class, 'importarCSV'])->name('contratos.importar-csv');
Route::get   ('/contratos/exportar    ',  [ContratoController::class, 'exportarCSV'])->name('contratos.exportar-csv');



//Views
Route::get   ('/importArchive',           [FrontController::class, 'importArchive' ])->name('contratos.importArchive');
Route::get   ('/error',                   [FrontController::class, 'trateErros'    ])->name('contratos.trateErros'   );



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'authenticate'])->name('login')->middleware('guest');
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout')->middleware('auth');



Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/register', [LoginController::class, 'register'])->name('register');
Route::get('/password/reset', [LoginController::class, 'passwordReset'])->name('passwordReset');
Route::post('/password/reset', [LoginController::class, 'passwordReset'])->name('passwordReset');
Route::get('/password/reset/{token}', [LoginController::class, 'passwordResetToken'])->name('passwordResetToken');
Route::post('/password/reset/{token}', [LoginController::class, 'passwordResetToken'])->name('passwordResetToken');
Route::get('/password/email', [LoginController::class, 'passwordEmail'])->name('passwordEmail');
Route::post('/password/email', [LoginController::class, 'passwordEmail'])->name('passwordEmail');
Route::get('/password/confirm', [LoginController::class, 'passwordConfirm'])->name('passwordConfirm');
Route::post('/password/confirm', [LoginController::class, 'passwordConfirm'])->name('passwordConfirm');
Route::get('/password/change', [LoginController::class, 'passwordChange'])->name('passwordChange');
Route::post('/password/change', [LoginController::class, 'passwordChange'])->name('passwordChange');
Route::get('/password/confirm/{token}', [LoginController::class, 'passwordConfirmToken'])->name('passwordConfirmToken');
Route::post('/password/confirm/{token}', [LoginController::class, 'passwordConfirmToken'])->name('passwordConfirmToken');
Route::get('/password/change/{token}', [LoginController::class, 'passwordChangeToken'])->name('passwordChangeToken');
Route::post('/password/change/{token}', [LoginController::class, 'passwordChangeToken'])->name('passwordChangeToken');
Route::get('/password/confirm/{token}', [LoginController::class, 'passwordConfirmToken'])->name('passwordConfirmToken');
Route::post('/password/confirm/{token}', [LoginController::class, 'passwordConfirmToken'])->name('passwordConfirmToken');
Route::get('/password/change/{token}', [LoginController::class, 'passwordChangeToken'])->name('passwordChangeToken');
Route::post('/password/change/{token}', [LoginController::class, 'passwordChangeToken'])->name('passwordChangeToken');
Route::get('/password/confirm/{token}', [LoginController::class, 'passwordConfirmToken'])->name('passwordConfirmToken');
Route::post('/password/confirm/{token}', [LoginController::class, 'passwordConfirmToken'])->name('passwordConfirmToken');
Route::get('/password/change/{token}', [LoginController::class, 'passwordChangeToken'])->name('passwordChangeToken');
Route::post('/password/change/{token}', [LoginController::class, 'passwordChangeToken'])->name('passwordChangeToken');
Route::get('/password/confirm/{token}', [LoginController::class, 'passwordConfirmToken'])->name('passwordConfirmToken');
Route::post('/password/confirm/{token}', [LoginController::class, 'passwordConfirmToken'])->name('passwordConfirmToken');
Route::get('/password/change/{token}', [LoginController::class, 'passwordChangeToken'])->name('passwordChangeToken');
Route::post('/password/change/{token}', [LoginController::class, 'passwordChangeToken'])->name('passwordChangeToken');
Route::get('/password/confirm/{token}', [LoginController::class, 'passwordConfirmToken'])->name('passwordConfirmToken');
Route::post('/password/confirm/{token}', [LoginController::class, 'passwordConfirmToken'])->name('passwordConfirmToken');
Route::get('/password/change/{token}', [LoginController::class, 'passwordChangeToken'])->name('passwordChangeToken');
Route::post('/password/change/{token}', [LoginController::class, 'passwordChangeToken'])->name('passwordChangeToken');
Route::get('/password/confirm/{token}', [LoginController::class, 'passwordConfirmToken'])->name('passwordConfirmToken');
Route::post('/password/confirm/{token}', [LoginController::class, 'passwordConfirmToken'])->name('passwordConfirmToken');





Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

