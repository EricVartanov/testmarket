<?php

use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;


// routes/api.php
Route::get('/products', [ProductController::class, 'index']);
