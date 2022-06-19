<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\BookingController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('events', EventController::class)->only([
    'index',
]);

Route::get('/events/get-dates/{id}', [EventController::class, 'getEventWithAvailabeDates']);
Route::get('/events/get-available-slots/{id}/{date}', [EventController::class, 'getAvailableSlotByDateAndEventId']);
Route::get('/all-events', [EventController::class, 'getAllEvents']);

Route::post('/book-slot', [BookingController::class, 'bookSlot']);
