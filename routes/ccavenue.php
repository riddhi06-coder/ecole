<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\AdmissionFormController;

Route::post('/ccavenue/response', [AdmissionFormController::class, 'handleResponse']);
Route::post('/ccavenue/cancel', [AdmissionFormController::class, 'handleCancel']);
