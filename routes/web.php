<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/app', function () {
    return view('app.app');
});

Route::get('/dashboard', function () {
    return view('pages.dashboard');
});

Route::get('/booking', function () {
    return view('pages.booking');
});

Route::post('/bookings', function (Request $request) {
    return view('pages.booking.store', ['request' => $request]);
})->name('bookings.store');

Route::put('/bookings/{id}', function ($id, Request $request) {
    return view('pages.booking.update', ['id' => $id, 'request' => $request]); 
})->name('bookings.update');

Route::delete('/bookings/{id}', function ($id) {
    return view('pages.booking.destroy', ['id' => $id]);
})->name('bookings.destroy');

Route::get('/bookings/create', function () {
    return view('pages.booking.create');
})->name('bookings.create');

Route::get('/bookings/{id}', function ($id) {
    return view('pages.booking.show', ['id' => $id]);
})->name('bookings.show');

Route::get('/bookings/{id}/edit', function ($id) {
    return view('pages.booking.edit', ['id' => $id]);
})->name('bookings.edit');
