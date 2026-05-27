<?php

use App\Http\Controllers\admin\offerController;
use App\Http\Controllers\admin\ordersController;
use App\Http\Controllers\admin\productController;
use App\Http\Controllers\cartController;
use App\Http\Controllers\prietoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

//HOME PRIETO
Route::get("/prieto", [prietoController::class, 'mostrar'])->name("home_prieto");
//LOGIN
Route::get('/login_prieto', [prietoController::class, 'create'])->name('login_prieto');
Route::post('/login_prieto', [prietoController::class, 'store'])->name('login_prieto.post');
//REGISTER
Route::get('/register_prieto', [prietoController::class, 'register'])->name('register_prieto');
Route::post('/register_prieto', [prietoController::class, 'storeRegister'])->name('register_prieto.post');
Route::get('/home', function () {
    return redirect()->route('home_prieto');
})->name('home');



Route::middleware("auth")->group(function () {
    //LOGOUT
    Route::post('logout_prieto', [prietoController::class, 'destroy'])->name('logout_prieto');

    //CARRITO
    Route::get("/cartShow", [cartController::class, 'cartShow'])->name("cartShow");
    Route::post("/cartAdd/{id}", [cartController::class, 'cartAdd'])->name("cartAdd");
    Route::delete("/cartRemove/{id}/{ofertaId}", [cartController::class, 'cartRemove'])->name("cartRemove");
    Route::delete("/cartClear", [cartController::class, 'cartClear'])->name("cartClear");

    Route::post("/cartAddOne/{id}", [cartController::class, 'cartAddOne'])->name("cartAddOne");
    Route::post("/cartRemoveOne/{id}/{ofertaId}", [cartController::class, 'cartRemoveOne'])->name("cartRemoveOne");
    Route::post("/cartOrder", [cartController::class, 'cartOrder'])->name("cartOrder");


    //PEDIDOS
    Route::get("/ordersShow", [prietoController::class, 'ordersShow'])->name("ordersShow");

    // Route::middleware("isAdmin")->group(function () {
        //RUTAS ADMINISTRADOR


    // });
});

// Route::middleware("auth", "isAdmin")->group(function () {
   //RUTAS ADMINISTRADOR
// });

Route::middleware(["auth", "isAdmin"])
    ->prefix("admin")
    ->name("admin.")
    ->group(function (){
        //RUTAS ADMINISTRADOR
        Route::resource("products", productController::class);
        Route::resource("offers", offerController::class);
        Route::get("orders", [ordersController::class, 'index'])->name("orders.index");
        Route::get("orders/{id}", [ordersController::class, 'show'])->name("orders.show");
    });

//LARAVEL
Route::get('/', function () {
    return redirect()->route('home_prieto');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
