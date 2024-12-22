<?php

use App\Http\Controllers\Payment\PaymentController;
use Illuminate\Support\Facades\Route;

Route::post('/payment/process', [PaymentController::class, 'processPayment']);
