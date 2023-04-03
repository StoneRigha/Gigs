<?php

use App\Http\Controllers\ListingController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Listing;


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
//All listings
Route::get('/', [ListingController::class, 'index']);

//Create form 
Route::get('/listings/create', [ListingController::class, 'create']);

//Store listings
Route::post('/listings',[ListingController::class, 'store']);


//Single listings
Route::get('/listings/{listing}',[ListingController::class, 'show']);