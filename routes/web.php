<?php

use App\Http\Controllers\InvoiceController;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\CategoryIngredientComponent;
use App\Http\Livewire\IngredientComponent;
use App\Http\Livewire\Laporan;
use App\Http\Livewire\MenuComponent;
use App\Http\Livewire\OrderComponent;
use App\Http\Livewire\PembayaranComponent;
use App\Http\Livewire\StokBahanComponent;
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

Route::get('/', function () {
    return redirect('order');
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');


Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    // Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::get('category', CategoryComponent::class)->name('category');
    Route::get('bahan', IngredientComponent::class)->name('bahan');
    Route::get('menu', MenuComponent::class)->name('menu');
    Route::get('order', OrderComponent::class)->name('order');
    Route::get('pembayaran', PembayaranComponent::class)->name('pembayaran');
    Route::get('invoice/{id}', [InvoiceController::class,'index'])->name('invoice');
    // Route::view('forms', 'forms')->name('forms');
    // Route::view('cards', 'cards')->name('cards');
    // Route::view('charts', 'charts')->name('charts');
    // Route::view('buttons', 'buttons')->name('buttons');
    // Route::view('modals', 'modals')->name('modals');
    // Route::view('tables', 'tables')->name('tables');
    // Route::view('calendar', 'calendar')->name('calendar');
    Route::get('laporan', Laporan::class)->name('laporan');
    Route::get('stokbahan', StokBahanComponent::class)->name('stokbahan');
    Route::get('komposisi/{category_id}', CategoryIngredientComponent::class)->name('categoryingredient');
});
