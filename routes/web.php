<?php

use App\Http\Controllers\WebApi\CalendarEventController;
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

Route::group(['prefix' => 'web-api'], function () {
    Route::apiResource('calendar-event', CalendarEventController::class)
        ->only('index', 'store');
});

Route::get('/', function () {
    return view('welcome');
});
