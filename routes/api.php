<?php

use App\Http\Controllers\CounterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/increment', [CounterController::class, 'increment']);

Route::get('/getAll', [CounterController::class, 'getAllVisitsCount']);