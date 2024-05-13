<?php

use App\Livewire\categories\AddCategory;
use App\Livewire\categories\CategoryList;
use App\Livewire\categories\EditCategory;
use App\Livewire\products\AddProduct;
use App\Livewire\products\EditProduct;
use App\Livewire\products\ProductList;
use App\Livewire\users\AddUser;
use App\Livewire\users\EditUser;
use App\Livewire\users\UserList;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/gebruikers', UserList::class)
    ->name('gebruikers');
Route::get('/nieuw/gebruiker', AddUser::class)
    ->name('adduser');
Route::get('/edit/gebruiker/{id}', EditUser::class)
    ->name('edituser');

Route::get('/producten', ProductList::class)
    ->name('producten');
Route::get('/nieuw/product', AddProduct::class)
    ->name('addproduct');
Route::get('/edit/product/{id}', EditProduct::class)
    ->name('editproduct');

Route::get('/categorie', CategoryList::class)
    ->name('categorie');
Route::get('/nieuw/categorie', AddCategory::class)
    ->name('addcategory');
Route::get('/edit/categorie/{id}', EditCategory::class)
    ->name('editcategory');




require __DIR__.'/auth.php';
