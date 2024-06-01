<?php
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;


Route::prefix('vendedor')->name('vendedor.')->group(function () {
    Route::get('/google-auth/redirect', 'App\Http\Controllers\GoogleController@redirectVendedor')->name('google-redirect');

    Route::get('/google-auth/callback', 'App\Http\Controllers\GoogleController@callback')->name('google-callback');

    Route::namespace('App\Http\Controllers\vendedor')->group(function () {
        Route::middleware(['guest:vendedor', 'revalidate'])->group(function () {
            Route::view('/login', 'vendedor.auth.login')->name('login');
            Route::post('/login', 'VendedorController@loginHandler')->name('login-handler');
            Route::view('/register', 'vendedor.auth.register')->name('register');
            Route::post('/register', 'VendedorController@registerHandler')->name('register-handler');
        });

        Route::middleware(['auth:vendedor', 'revalidate'])->group(function () {
            
            Route::view('/home', 'vendedor.home')->name('home');
            Route::post('/logout', 'VendedorController@logoutHandler')->name('logout');

            Route::view('/profile', 'vendedor.profile')->name('profile');
            Route::get('/profile/update', 'VendedorProfileController@showProfileUpdate')->name('profile.update');
            Route::post('/profile/update', 'VendedorProfileController@updateProfileHandler')->name('profile.update-handler');
            Route::get('/sales', 'VendedorController@showSales')->name('sales');

            Route::prefix('producto')->name('producto.')->group(function () {
                Route::get('/all','ProductoController@allProductos')->name('all-productos');
                Route::get('/add', 'ProductoController@addProducto')->name('add-producto');
                Route::get('/edit/{id}', 'ProductoController@editProducto')->name('edit-producto');                
                Route::post('/update', 'ProductoController@updateProducto')->name('update-producto');
                Route::post('/delete/{id}', 'ProductoController@deleteProducto')->name('delete-producto');
                Route::delete('/variante/delete/{id}', 'ProductoController@deleteVariant')->name('delete-variante');
                Route::get('/get-producto-categoria', 'ProductoController@getProductoCategoria')->name('get-producto-categoria');
                Route::post('/create', 'ProductoController@createProducto')->name('create-producto');
            });
        });
    });
});
