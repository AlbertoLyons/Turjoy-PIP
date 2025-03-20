<?php

use App\Http\Controllers\TravelController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::get('/login', [App\Http\Controllers\LoginController::class,'index'])->name('login');
Route::post('/login', [App\Http\Controllers\LoginController::class,'store']);
Route::post('/logout',[App\Http\Controllers\LogoutController::class,'index'])->name('logout');
Route::get('/reserveTickets',[App\Http\Controllers\TravelController::class, 'homeIndex'])->name('reserveTickets');


Route::get('/search/Reserve', [App\Http\Controllers\SearchController::class, 'index'])->name('search.index');
Route::post('/search', [SearchController::class, 'store'])->name('search.store');

Route::get('/get/origins', [TravelController::class, 'obtainOrigins']);
Route::get('/get/destinations/{origin}', [TravelController::class, 'searchDestinations']);
Route::get('/seating/{origin}/{destination}/{date}', [TravelController::class, 'seatings']);
Route::post('/check', [TravelController::class, 'checkTravel'])->name('travels.check');
Route::post('/reservation', [TicketController::class, 'store'])->name('add-reservation');



Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [UsuarioController::class, 'dashboardIndex'])->name('dashboard');
    Route::get('/report', [App\Http\Controllers\ReportController::class, 'index'])->name('report');
    Route::post('/report', [App\Http\Controllers\ReportController::class, 'searchToDate'])->name('report.search');
    Route::get('/add/travel',[TravelController::class,'indexAddTravels'])->name('travels.index');
    Route::post('/addtravel',[TravelController::class,'travelCheck'])->name('travel.check');
    Route::get('/result/travels',[TravelController::class,'indexTravels'])->name('travelsAdd.index');
});

Route::get('/travel-reservation/{id}', [VoucherController::class, 'generatePDF'])->name('generate.pdf');
Route::get('download-pdf/{id}', [VoucherController::class, 'downloadPDF'])->name('pdf.download');
