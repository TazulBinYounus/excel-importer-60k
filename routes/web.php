<?php

use App\Http\Controllers\ImportController;
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

Route::get('/', [ImportController::class,'show'])->name('customer');
Route::post('/search-result', [ImportController::class,'showSearchResult'])->name('customer.search');
Route::get('import', [ImportController::class,'index'])->name('import');
Route::post('import', [ImportController::class,'store'])->name('store');


