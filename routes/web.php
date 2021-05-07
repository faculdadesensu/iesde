<?php

use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/disciplinas', [ServiceController::class, 'service'])->name('get.disciplinas');
Route::get('/pdf/{idcurso}/{matricula}', [ServiceController::class, 'pdf'])->name('index');
Route::get('/video/{idcurso}/{matricula}', [ServiceController::class, 'video'])->name('index');
Route::get('/aulas/{idcurso}/{matricula}', [ServiceController::class, 'aulasVideo'])->name('index');