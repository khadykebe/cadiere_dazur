<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RvController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PlanningController;
use App\Http\Controllers\Auth;



Route::get('/', function (){return view('Home');});

Route::get('list', function () {return view('medecin.listeRV');})->name('all.rv');
Route::post('logout', [UserController::class, 'logout'])->name('logout');

Route::get('/consultation',[RvController::class,'index'])->name('index');
Route::get('/consultation/{data}',[RvController::class,'RV'])->name('rv.creat');
Route::get('/receive-data', [RvController::class,'ConsultEcho'])->name('time');

Route::post('radioRV',[RvController::class,'PatientAsRvRadio'])->name('rv.radio');
Route::post('echoRV',[RvController::class,'PatientAsRvEcho'])->name('rv.echo');
Route::post('mammoRv',[RvController::class,'PatientAsRvMammo'])->name('rv.mammo');

Route::get('allRv',[RvController::class,'liste']);
Route::get('allCt',[UserController::class,'index']);
Route::post('addUser',[UserController::class,'store'])->name('add.user');
Route::post('/login',[UserController::class,'login'])->name('login');
Route::get('deconnect',[UserController::class,'deconnecter'])->name('deconnect');
Route::post('add',[UserController::class,'AddPl'])->name('add.planning');

// rv

Route::get('/rendez-vous',[UserController::class,'AllRv'])->name('liste-Rv');
Route::put('/rendez-vous/{id}', [UserController::class, 'update'])->name('rv.update');
Route::delete('/rendez-vous/{id}', [UserController::class, 'destroy'])->name('rv.destroy');

// planning
Route::get('/plannings', [UserController::class, 'allPl'])->name('planning.allPl');
Route::put('/plannings/{id}', [PlanningController::class, 'update'])->name('planning.update');
Route::delete('/plannings/{id}', [PlanningController::class, 'destroy'])->name('planning.destroy');


