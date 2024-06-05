<?php

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

Route::namespace('App\Http\Controllers')->group(function () {
    Route::get('/', 'indexController@index')->name('productos'); 
    Route::post('/add/{id}', 'CartController@addToCar')->name('cart-add');
    Route::get('/cart', 'CartController@productosCart')->name('cart');
    Route::delete('/cart/delete/{id}', 'CartController@destroy')->name('delete-cart');
    Route::post('/cart/clear', 'CartController@clearCart')->name('clear-cart');
    Route::get('/producto/{id}', 'indexController@producto')->name('producto');
    Route::get('/buscar-productos', 'indexController@search')->name('buscar-productos');
    Route::get('/producto-vendedor/{id}', 'indexController@searchVendedor')->name('vendedor-productos');

    Route::view('/rol', 'rol')->name('rol')->middleware(['guest:comprador', 'guest:vendedor']);
    Route::view('politica_privacidad', 'politica_privacidad')->name('politica');

    Route::middleware(['auth:comprador', 'revalidate'])->group(function () {
        Route::post('paypal/paymet', 'PayPalController@payment')->name('paypal');
        Route::get('paypal/success', 'PayPalController@success')->name('paypal_success');
        Route::get('paypal/cancel', 'PayPalController@cancel')->name('paypal_cancel');

        Route::get('transaccion', 'TransaccionController@success')->name('transaccion_succes');

    });
});


