<?php

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

Route::get('/', 'IndexController@index');
Route::post('/flights', 'ApiController@search')->name('flights.search');
Route::post('/listFlights', 'ApiController@listFlights')
        ->name('flights.list');
Route::get('/listFlights', 'ApiController@listFlights')
        ->name('flights.list');
        
Route::post('/detailFlight', 'ApiController@detailFlight')->name('flights.detail');
Route::get('/detailFlight', 'IndexController@index');

Route::post('/saveReservation', 'ApiController@saveReservation')->name('flights.saveReservation');
Route::get('/reservation', 'ApiController@reservation')->name('reservation.list');
Route::get('/cancellation/{idReserva}', 'ApiController@showCancellation')->name('cancellation.show');
Route::post('/cancelReservation', 'ApiController@cancelReservation')->name('reservation.cancel');
