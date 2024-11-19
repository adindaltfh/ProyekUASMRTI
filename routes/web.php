<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\master\AssetController;
use App\Http\Controllers\master\CIAController;
use App\Http\Controllers\master\RiskController;
use App\Http\Controllers\master\RiskValueController;
use App\Http\Controllers\transaksi\AssessmentController;
use App\Http\Controllers\transaksi\MitigasiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\master\UserController;
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

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.show');
Route::get('/dashboard/data-chart', [DashboardController::class, 'getChartData']);

Route::get('/user/show', [UserController::class, 'show'])->name('user.show');
Route::get('/user/add',[UserController::class, 'add'])->name('user.add');
Route::post('/user/store',[UserController::class, 'store'])->name('user.store');
Route::get('/user/edit/{id}',[UserController::class, 'edit'])->name('user.edit');
Route::put('/user/update/{id}',[UserController::class, 'update'])->name('user.update');
Route::delete('/user/destroy/{id}',[UserController::class, 'destroy'])->name('user.destroy');

Route::get('/risk/show',[RiskController::class, 'show'])->name('risk.show');
Route::get('/risk/add',[RiskController::class, 'add'])->name('risk.add');
Route::post('/risk/store',[RiskController::class, 'store'])->name('risk.store');
Route::get('/risk/edit/{id}',[RiskController::class, 'edit'])->name('risk.edit');
Route::put('/risk/update/{id}',[RiskController::class, 'update'])->name('risk.update');
Route::delete('/risk/destroy/{id}',[RiskController::class, 'destroy'])->name('risk.destroy');

Route::get('/cia/show',[CIAController::class, 'show'])->name('cia.show');
Route::get('/cia/add',[CIAController::class, 'add'])->name('cia.add');
Route::post('/cia/store',[CIAController::class, 'store'])->name('cia.store');
Route::get('/cia/edit/{id}',[CIAController::class, 'edit'])->name('cia.edit');
Route::put('/cia/update/{id}',[CIAController::class, 'update'])->name('cia.update');
Route::delete('/cia/destroy/{id}',[CIAController::class, 'destroy'])->name('cia.destroy');

Route::get('/asset', [AssetController::class, 'show'])->name('asset.show');
Route::get('/asset/add', [AssetController::class, 'add'])->name('asset.add');
Route::post('/asset/store', [AssetController::class, 'store'])->name('asset.store');
Route::get('/asset/edit/{id}', [AssetController::class, 'edit'])->name('asset.edit');
Route::put('/asset/update/{id}', [AssetController::class, 'update'])->name('asset.update');
Route::delete('/asset/delete/{id}', [AssetController::class, 'destroy'])->name('asset.destroy');

Route::get('/riskvalue/show',[RiskValueController::class, 'show'])->name('riskvalue.show');
Route::get('/riskvalue/add',[RiskValueController::class, 'add'])->name('riskvalue.add');
Route::post('/riskvalue/store',[RiskValueController::class, 'store'])->name('riskvalue.store');
Route::get('/riskvalue/edit/{id}',[RiskValueController::class, 'edit'])->name('riskvalue.edit');
Route::put('/riskvalue/update/{id}',[RiskValueController::class, 'update'])->name('riskvalue.update');
Route::delete('/riskvalue/destroy/{id}',[RiskValueController::class, 'destroy'])->name('riskvalue.destroy');

Route::get('/assessment/show',[AssessmentController::class, 'show'])->name('assessment.show');
Route::get('/assessment/add',[AssessmentController::class, 'add'])->name('assessment.add');
Route::post('/assessment/dampak',[AssessmentController::class, 'getDampakByActivity'])->name('assessment.dampak');
Route::get('/assessment/get-dampak',[AssessmentController::class, 'getImpacts'])->name('assessment.get-dampak');
Route::post('/assessment/store',[AssessmentController::class, 'store'])->name('assessment.store');
Route::get('/assessment/edit/{id}',[AssessmentController::class, 'edit'])->name('assessment.edit');
Route::put('/assessment/update/{id}',[AssessmentController::class, 'update'])->name('assessment.update');
Route::delete('/assessment/destroy/{id}',[AssessmentController::class, 'destroy'])->name('assessment.destroy');

Route::get('/mitigasi/show',[MitigasiController::class, 'show'])->name('mitigasi.show');
Route::get('/mitigasi/add',[MitigasiController::class, 'add'])->name('mitigasi.add');
Route::post('/mitigasi/store',[MitigasiController::class, 'store'])->name('mitigasi.store');
Route::get('/mitigasi/edit/{id}',[MitigasiController::class, 'edit'])->name('mitigasi.edit');
Route::put('/mitigasi/update/{id}',[MitigasiController::class, 'update'])->name('mitigasi.update');
Route::delete('/mitigasi/destroy/{id}',[MitigasiController::class, 'destroy'])->name('mitigasi.destroy');


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');

// Protected routes
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.show');
    Route::get('/dashboard/data-chart', [DashboardController::class, 'getChartData']);
});