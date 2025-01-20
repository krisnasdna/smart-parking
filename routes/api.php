<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParkingController;
Route::get('/set_mode', [ParkingController::class, 'scanCard']);
Route::get('/start_register_card', [ParkingController::class, 'startRegisterCard']);
Route::post('/register_card', [ParkingController::class, 'registerCard']);
Route::get('/verify_card/{cardID}', [ParkingController::class, 'verifyCard']);
Route::post('/slot_parking', [ParkingController::class, 'updateSlotStatus']);
