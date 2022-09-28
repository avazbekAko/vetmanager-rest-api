<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ConnController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PetController;
use Illuminate\Support\Facades\Auth;
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


Auth::routes();

Route::group([
    'middleware' => 'auth'
], function(){
    Route::group([
        'middleware' => 'checkconn'
    ], function(){

        Route::get('/home', [HomeController::class, 'index'])->name('home');

    });
    Route::resource('/companies', CompanyController::class);
    Route::get('/connection/{id}/clients-all', [ConnController::class, 'all'])->name('clients-all');
    Route::get('/connection/{id}/client-create', [ConnController::class, 'create']);
    Route::post('/connection/{id}/client-create', [ConnController::class, 'store']);
    Route::get('/connection/{id}/client/{id_client}/delete', [ConnController::class, 'destroy']);
    Route::get('/connection/{id}/client/{id_client}/edit', [ConnController::class, 'edit']);
    Route::put('/connection/{id}/client/{id_client}/edit', [ConnController::class, 'update']);

    Route::get('/connection/{id}/client/{id_client}/pets-all', [PetController::class, 'all'])->name('pets-all');
    Route::get('/connection/{id}/client/{id_client}/pet-create', [PetController::class, 'create']);
    Route::post('/connection/{id}/client/{id_client}/pet-create', [PetController::class, 'store']);
    Route::get('/connection/{id}/client/{id_client}/pet/{id_pet}/delete', [PetController::class, 'destroy']);
    Route::get('/connection/{id}/client/{id_client}/pet/{id_pet}/edit', [PetController::class, 'edit']);
    Route::put('/connection/{id}/client/{id_client}/pet/{id_pet}/edit', [PetController::class, 'update']);
});
