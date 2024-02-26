<?php

use App\Http\Controllers\PlansController;
use App\Http\Controllers\EventController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/plans/checkout/webhook', [PlansController::class, 'checkoutWebhook' ])->name('plans.checkout.webhook');
Route::post('/plans/update/webhook', [PlansController::class, 'updateWebhook' ])->name('plans.update.webhook');
Route::post('/plans/cancel/webhook', [PlansController::class, 'cancelWebhook' ])->name('plans.cancel.webhook');

Route::get('/calendar/events', [EventController::class, 'events']);

Route::get('/calendar/events/recurrences', [EventController::class, 'eventsWithRecurrences']);
Route::get('/calendar/events/recurrences/calendar', [EventController::class, 'eventsWithRecurrencesFromCalendar']);

Route::get('/calendar/events/recurrences/individual', [EventController::class, 'eventsWithRecurrencesFromIndividual']);
Route::post('/calendar/events/create', [EventController::class, 'create']);

Route::put('/calendar/events/schedule', [EventController::class, 'schedule']);
Route::put('/calendar/events/schedule/calendar', [EventController::class, 'scheduleFromCalendar']);



