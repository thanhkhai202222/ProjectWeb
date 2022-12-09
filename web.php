<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\http\Controllers\CustomerController;
use App\http\Controllers\CategoryController;

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
    return view('welcome');
});

//Route::get('product-list', [ProductController::class, 'index2']);
Route::get('customers/index', [ProductController::class, 'index3']);
Route::get('customers/register', [CustomerController::class, 'register']);
Route::post('customers/adduser', [CustomerController::class, 'adduser']);
Route::get('customers/login', [CustomerController::class, 'login']);
Route::post('customers/login', [CustomerController::class, 'userlogin']);
Route::get('customers/logout', [CustomerController::class, 'logout']);

Route::get('customers/AddToCart{id}', [CustomerController::class, 'AddToCart']);
Route::get('cart', [CustomerController::class, 'cart']);

Route::get('admins/index', [AdminController::class, 'index']);
Route::get('admins/products', [AdminController::class, 'getProducts']);
Route::get('admins/categories', [AdminController::class, 'getCategories']);
Route::post('admins/login', [AdminController::class, 'login']);
Route::get('admins/logout', [AdminController::class, 'logout']);
Route::get('admins/admin-profile/{id}', [AdminController::class, 'editAdmin']);
Route::post('admin-update', [AdminController::class, 'updateAdmin']);
Route::get('admin-delete/{id}', [AdminController::class, 'deleteAdmin']);

Route::get('admins/customers', [AdminController::class, 'getCustomers']);
Route::get('customer-delete/{email}', [AdminController::class, 'deleteCustomer']);
Route::get('admins/customers-edit/{email}', [AdminController::class, 'editCustomer']);
Route::post('customer-update', [AdminController::class, 'updateCustomer']);
Route::get('admins/customer-add', [AdminController::class, 'addCustomer']);
Route::post('customer-save', [AdminController::class, 'saveCustomer']);

Route::get('product-add', [ProductController::class, 'add2']);
Route::post('product-save', [ProductController::class, 'save']);
Route::get('product-edit/{id}', [ProductController::class, 'edit']);
Route::post('product-update', [ProductController::class, 'update']);
Route::get('product-delete/{id}', [ProductController::class, 'delete']);

Route::get('category-delete/{id}', [CategoryController::class, 'delete']);
Route::get('category-edit/{id}', [CategoryController::class, 'edit']);
Route::get('category-add', [CategoryController::class, 'add']);
Route::post('category-update', [CategoryController::class, 'update']);
Route::post('category-save', [CategoryController::class, 'save']);


