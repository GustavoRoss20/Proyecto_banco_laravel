<?php

use App\Http\Controllers\FilesController;
use App\Http\Controllers\FinancialStatementsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OperationsController;
use App\Http\Controllers\UserController;

Route::get('/healthcheck', function () {
    return view('others.welcome');
});

Route::get('/', function () {
    return view('others.login');
})->name('login');

Route::get('/home', function () {
    return view('home.home');
})->middleware('auth')->name('home');

//User's route

Route::get('users/profile', [UserController::class, 'getDataUser'])->middleware('auth')->name('profile');

Route::post('users/post/sendDataUser', [UserController::class, 'registerUser'])->name('register');

Route::post('users/post/showAllUsers', [UserController::class, 'showAll'])->name('showAll');



Route::get('/users/register', function () {
    return view('users.register');
})->middleware('auth');

Route::get('/users/showAll', [UserController::class, 'showAll'])->middleware('auth')->name('showAllUsers');
Route::get('/users/delete/{id}', [UserController::class, 'deleteUser'])->name('users.delete');


// File's rutes

Route::get('/files/txt', function () {
    return view('files.txt');
})->middleware('auth');

Route::get('/files/csv', function () {
    return view('files.csv');
})->middleware('auth');

Route::get('/files/xml', function () {
    return view('files.xml');
})->middleware('auth');

Route::get('/files/import', function () {
    return view('files.import');
})->middleware('auth');

Route::get('/files/charts', [UserController::class, 'showDataCharts'])->middleware('auth')->name('chartsShowData');

Route::post('/files/getData',[FilesController::class, 'GetDataUsers'])->name('Data.Charts');

Route::post('/files/downloadTxt', [FilesController::class, 'GenerateFileTxt'])->name('download.txt');

Route::post('/files/downloadCsv', [FilesController::class, 'GenerateFileCsv'])->name('download.csv');

Route::post('/files/downloadXml', [FilesController::class, 'GenerateFileXml'])->name('download.xml');

//Querie's rutes

Route::get('/queries/ascd', [UserController::class, 'showAllAscd'])->middleware('auth')->name('showAllAscd');
Route::get('/queries/desc', [UserController::class, 'showAllDesc'])->middleware('auth')->name('showAllDesc');


//operations's rutes

Route::get('/operations/deposits', function () {
    return view('operations.deposits');
})->middleware('auth');

Route::get('/operations/service_payment', function () {
    return view('operations.service_payment');
})->middleware('auth');

Route::get('/operations/service_payment', [OperationsController::class, 'GetCatServices'])->middleware('auth')->name('show.cat.services');
    //RUTAS 
Route::get('/operations/transfers', [OperationsController::class, 'GetUsersWithIds'])->middleware('auth')->name('show.ids.users');

Route::post('/operations/validation/Transfers', [OperationsController::class, 'Transfers'])->name('opt.transfers');

Route::post('/operatiosn/validation/Pays', [OperationsController::class, 'PayServices'])->name('opt.pay.services');

Route::post('/operations/validationDeposits', [OperationsController::class, 'ToDeposit'])->name('opt.deposits');

//financial_statements's rutes

Route::get('financial_statements/apply_for_loan', function () {
    return view('financial_statements.apply_for_loan');
})->middleware('auth');
Route::get('/financial_statements/balance', [FinancialStatementsController::class, 'getSaldoData'])->middleware('auth');

Route::get('/financial_statements/loans', [FinancialStatementsController::class, 'getInfoLoans'])->middleware('auth');

Route::post('financial_statements/insert.loans', [FinancialStatementsController::class, 'InsertLoans'])->name('insert.loans');

Route::post('financial_statements/pay.loans', [FinancialStatementsController::class, 'payLoan'])->name('pay.loans');

// Rutas de autenticación
Route::post('/login', [LoginController::class, 'login'])->name('loginAuth');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

//Ruta de actualizacion del usuario

Route::post('/profile/updateUser', [UserController::class, 'updateData'])->middleware('auth')->name('perfil.update');
