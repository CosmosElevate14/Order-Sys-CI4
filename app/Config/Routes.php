<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Admin;
use App\Controllers\Auth;
use App\Controllers\Users;

// ADMIN
$routes->get('/home', [Users::class, 'home']);
$routes->get('admin/dashboard', [Admin::class, 'dashboard']);

// PRODUCTS
$routes->match(['GET', 'POST'], 'admin/products', [Admin::class, 'products']);
$routes->post('admin/product/add', [Admin::class, 'addProduct']);
$routes->match(['GET', 'POST'], 'admin/product/edit/(:num)', [Admin::class, 'editProduct']);
$routes->match(['GET', 'POST'], 'admin/product/delete/(:num)', [Admin::class, 'deleteProduct']);

// CATEGORY
$routes->get('admin/category', [Admin::class, 'category']);
$routes->post('admin/category/add', [Admin::class, 'addCategory']);
$routes->match(['GET', 'POST'], 'admin/category/edit/(:num)', [Admin::class, 'editCategory']);
$routes->match(['GET', 'POST'], 'admin/category/delete/(:num)', [Admin::class, 'deleteCategory']);
$routes->get('admin', [Auth::class, 'index']);

// ORDERS
$routes->get('admin/orders/(:alpha)', [Admin::class, 'orders/$1']);
$routes->get('admin/order/confirm/(:num)', [Admin::class, 'confirmOrder/$1']);
$routes->get('admin/order/decline/(:num)', [Admin::class, 'declineOrder/$1']);
$routes->get('admin/order/ready/(:num)', [Admin::class, 'orderReady/$1']);
$routes->get('admin/order/pay/(:num)', [Admin::class, 'payOrder/$1']);
$routes->get('admin/order/unpaid/(:num)', [Admin::class, 'unpaidOrder/$1']);

// Customers
$routes->get('admin/customers', [Admin::class, 'customers']);

// Sales
$routes->match(['GET', 'POST'], 'admin/sales', [Admin::class, 'sales']);


// AUTHENTICATION
$routes->post('/login/authenticate', 'Auth::authenticate');
$routes->get('/logout', 'Auth::logout');


// USERS
$routes->get('/', [Users::class, 'index']);
$routes->match(['GET', 'POST'], '/home', [Users::class, 'home']);
$routes->get('/cart', [Users::class, 'cart']);
$routes->match(['GET', 'POST'], '/cart/add', [Users::class, 'addToCart']);
$routes->match(['GET', 'POST'], '/cart/checkout', [Users::class, 'checkout']);
// 👇 NEW: Update quantity and remove item from cart
$routes->post('/cart/update', [Users::class, 'updateQuantity']);
$routes->get('/cart/remove/(:num)', [Users::class, 'removeItem/$1']);
$routes->get('/notification', [Users::class, 'notification']);
$routes->get('user/logout', [Auth::class, 'userLogout']);
$routes->match(['GET', 'POST'], '/profile', [Users::class, 'profile']);



// USER LOGIN AND REGISTER
$routes->match(['GET', 'POST'], '/login', [Auth::class, 'userLogin']);
$routes->match(['GET', 'POST'], '/register', [Auth::class, 'userRegister']);