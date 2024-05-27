<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.

use App\Models\Producto;
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('productos', function (BreadcrumbTrail $trail) {
    $trail->push('Inicio', route('productos'));
});

Breadcrumbs::for('producto', function (BreadcrumbTrail $trail, Producto $producto) {
    $trail->parent('productos');
    $trail->push($producto->nombre, route('producto', ['id' => $producto->id]));
});

Breadcrumbs::for('cart', function (BreadcrumbTrail $trail) {
    $trail->parent('productos');
    $trail->push('Carrito', route('cart'));
});

Breadcrumbs::for('buscar-productos', function (BreadcrumbTrail $trail) {
    $trail->parent('productos');
    $trail->push('Buscar Productos', route('buscar-productos'));
});

Breadcrumbs::for('comprador_login', function (BreadcrumbTrail $trail) {
    $trail->parent('productos');
    $trail->push('Login comprador', route('comprador.login'));
});

// // Home > Blog
// Breadcrumbs::for('blog', function (BreadcrumbTrail $trail) {
//     $trail->parent('home');
//     $trail->push('Blog', route('blog'));
// });

// // Home > Blog > [Category]
// Breadcrumbs::for('category', function (BreadcrumbTrail $trail, $category) {
//     $trail->parent('blog');
//     $trail->push($category->title, route('category', $category));
// });