<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\{
    Calendar, CardapioController
};
use App\Http\Controllers\Admin\{
    HomeController, AdminLoginController
};

Route::get('/', function () {
    return view('welcome');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/cardapio', function () {
        return view('cardapio');
    })->name('cardapio');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

//admin

Route::group(['prefix' => 'admin'], function(){

    Route::group(['middleware' => 'admin.guest'], function (){

        Route::get('/login', [AdminLoginController::class, 'index'])->name('admin.login');
        Route::post('/authenticate', [AdminLoginController::class, 'authenticate'])->name('admin.authenticate');
    });

    Route::group(['middleware' => 'admin.auth'], function (){
        Route::get('dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
        Route::post('dashboard/store', [App\Http\Livewire\CardapioController::class, 'store']);
    });
});


Route::get('/reservas', Calendar::class);


// Rota para visualizar o cardápio
Route::get('/admin/viewcardapio', CardapioController::class . '@show')->name('admin.viewcardapio');

// Rota para editar o cardápio

Route::get('/cardapio/{id}/edit', [CardapioController::class, 'edit'])->name('cardapio.edit');
Route::put('/cardapio/{id}/update', [CardapioController::class, 'update'])->name('cardapio.update');

Route::get('dashboard', [HomeController::class, 'index'])->name('admin.dashboard');



