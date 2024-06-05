<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.

use App\Models\Producto;
use App\Models\Vendedor;
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('productos', function (BreadcrumbTrail $trail) {
    $trail->push('Inicio', route('productos'));
});

Breadcrumbs::for('producto', function (BreadcrumbTrail $trail, $id) {
    $producto = Producto::findOrFail($id);
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

Breadcrumbs::for('vendedor-productos', function (BreadcrumbTrail $trail, $id) {
    $vendedor = Vendedor::findOrFail($id);
    $trail->parent('productos');
    $trail->push($vendedor->nickname, route('vendedor.producto.edit-producto', ['id' => $vendedor->id]));
});

/*
    Comprador Breadcrumbs
*/

Breadcrumbs::for('comprador_login', function (BreadcrumbTrail $trail) {
    $trail->parent('productos');
    $trail->push('Login comprador', route('comprador.login'));
});

Breadcrumbs::for('comprador_register', function (BreadcrumbTrail $trail) {
    $trail->parent('comprador_login');
    $trail->push('Registro comprador', route('comprador.register'));
});

Breadcrumbs::for('comprador_home', function (BreadcrumbTrail $trail) {
    $trail->parent('productos');
    $trail->push('home', route('comprador.home'));
});

Breadcrumbs::for('comprador_profile', function (BreadcrumbTrail $trail) {
    $trail->parent('comprador_home');
    $trail->push('perfil', route('comprador.profile'));
});

Breadcrumbs::for('comprador_update', function (BreadcrumbTrail $trail) {
    $trail->parent('comprador_profile');
    $trail->push('actualizar datos', route('comprador.profile.update'));
});

Breadcrumbs::for('comprador_orders', function (BreadcrumbTrail $trail) {
    $trail->parent('comprador_home');
    $trail->push('pedidos', route('comprador.orders'));
});

Breadcrumbs::for('comprador_payment', function (BreadcrumbTrail $trail) {
    $trail->parent('comprador_home');
    $trail->push('métodos de pago', route('comprador.payment'));
});

/*
    vendedor Breadcrumbs
*/

Breadcrumbs::for('vendedor_login', function (BreadcrumbTrail $trail) {
    $trail->parent('productos');
    $trail->push('Login vendedor', route('vendedor.login'));
});

Breadcrumbs::for('vendedor_register', function (BreadcrumbTrail $trail) {
    $trail->parent('vendedor_login');
    $trail->push('Registro vendedor', route('vendedor.register'));
});

Breadcrumbs::for('vendedor_home', function (BreadcrumbTrail $trail) {
    $trail->parent('productos');
    $trail->push('home', route('vendedor.home'));
});

Breadcrumbs::for('vendedor_profile', function (BreadcrumbTrail $trail) {
    $trail->parent('vendedor_home');
    $trail->push('perfil', route('vendedor.profile'));
});

Breadcrumbs::for('vendedor_update', function (BreadcrumbTrail $trail) {
    $trail->parent('vendedor_profile');
    $trail->push('actualizar datos', route('vendedor.profile.update'));
});

Breadcrumbs::for('vendedor_productos', function (BreadcrumbTrail $trail) {
    $trail->parent('vendedor_home');
    $trail->push('lista de productos', route('vendedor.producto.all-productos'));
});

Breadcrumbs::for('vendedor_add_producto', function (BreadcrumbTrail $trail) {
    $trail->parent('vendedor_productos');
    $trail->push('agregar producto', route('vendedor.producto.add-producto'));
});

Breadcrumbs::for('vendedor_edit_producto', function (BreadcrumbTrail $trail, $id) {
    $producto = Producto::findOrFail($id);
    $trail->parent('vendedor_productos');
    $trail->push($producto->nombre, route('vendedor.producto.edit-producto', ['id' => $producto->id]));
});

Breadcrumbs::for('vendedor_sales', function (BreadcrumbTrail $trail) {
    $trail->parent('vendedor_home');
    $trail->push('lista de ventas', route('vendedor.producto.all-productos'));
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