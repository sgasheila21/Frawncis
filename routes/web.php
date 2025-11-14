<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TransactionController;

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
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'loginShow'])->name('login.show');
Route::post('/login', [AuthController::class, 'loginAuthentication'])->name('login.auth');

Route::get('/register', [AuthController::class, 'registerShow'])->name('register.show');
Route::post('/register', [AuthController::class, 'registerAuthentication'])->name('register.auth');

Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/home', function () {
    return view('home');
})->name('home')->middleware('mustLogin');

Route::post('/search', [SearchController::class, 'getData'])->name('search.getData')->middleware('mustLogin');

Route::get('/locations', [LocationController::class, 'locationShow'])->name('location.show')->middleware('mustLogin');
Route::get('/locations/add', [LocationController::class, 'newLocationShow'])->name('location.new.show')->middleware('mustAdmin');
Route::post('/locations/add', [LocationController::class, 'newLocation'])->name('location.new')->middleware('mustAdmin');
Route::get('/locations/edit/{id}', [LocationController::class, 'updateLocationShow'])->name('location.edit.show')->middleware('mustAdmin');
Route::post('/locations/edit/{id}', [LocationController::class, 'updateLocation'])->name('location.edit')->middleware('mustAdmin');
Route::post('/locations/delete/{id}', [LocationController::class, 'deleteLocation'])->name('location.delete')->middleware('mustAdmin');

Route::get('/products', [ProductController::class, 'productShow'])->name('product.show')->middleware('mustLogin');
Route::get('/products/add', [ProductController::class, 'newProductShow'])->name('product.new.show')->middleware('mustAdmin');
Route::post('/products/add', [ProductController::class, 'newProduct'])->name('product.new')->middleware('mustAdmin');
Route::get('/products/edit/{id}', [ProductController::class, 'updateProductShow'])->name('product.edit.show')->middleware('mustAdmin');
Route::post('/products/edit/{id}', [ProductController::class, 'updateProduct'])->name('product.edit')->middleware('mustAdmin');
Route::post('/products/delete/{id}', [ProductController::class, 'deleteProduct'])->name('product.delete')->middleware('mustAdmin');
Route::post('/products/update/cart/{id}', [ProductController::class, 'updateProductCart'])->name('update.product.cart')->middleware('mustMember');

Route::get('/carts',[CartController::class, 'cartShow'])->name('cart.show')->middleware('mustMember');
Route::post('/carts/{id}',[CartController::class, 'quantityUpdate'])->name('update.quantity')->middleware('mustMember');
Route::post('/checkout',[CartController::class, 'checkoutCart'])->name('checkout')->middleware('mustMember');

Route::get('/profile', [ProfileController::class, 'profileShow'])->name('profile.show')->middleware('mustMember');
Route::post('/profile', [ProfileController::class, 'profileStore'])->name('profile.store')->middleware('mustMember');
Route::post('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change.password')->middleware('mustMember');

Route::get('/transactions', [TransactionController::class, 'transactionShow'])->name('transaction.show')->middleware('mustAdmin');
Route::post('/transactions/pickup', [TransactionController::class, 'updatePickupStatus'])->name('update.pickup.status')->middleware('mustAdmin');