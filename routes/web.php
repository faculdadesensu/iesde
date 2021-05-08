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

Route::get('/formattingAlternatives/{disciplinaID}', [ServiceController::class, 'formattingAlternatives'])->name('getGrades');
Route::get('/grades', [ServiceController::class, 'getGrades'])->name('getGrades');
Route::get('/matriculas', [ServiceController::class, 'getMatriculas'])->name('matriculas');
Route::get('/alternativas/{disciplinaID}', [ServiceController::class, 'getAlternativas'])->name('getAlternativas');
Route::get('/disciplinas', [ServiceController::class, 'getDisciplinas'])->name('getDisciplinas');
Route::get('/pdf/{idcurso}/{matricula}', [ServiceController::class, 'pdf'])->name('pdf');
Route::get('/video/{idcurso}/{matricula}', [ServiceController::class, 'video'])->name('video');
Route::get('/aulas/{idcurso}/{matricula}', [ServiceController::class, 'aulasVideo'])->name('aulasVideo');
Route::get('/questoes/{disciplinaID}', [ServiceController::class, 'getBancoQuestoesDisciplinas'])->name('getBancoQuestoesDisciplinas');

