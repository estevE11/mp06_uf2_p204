<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormValidator;

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
    $validator = new FormValidator;
    $clients = $validator->getClientList();
    return view('main', ['correct' => true, 'clients' => $clients]);
});

Route::get('/validate', [FormValidator::class, 'validateAndSave']);