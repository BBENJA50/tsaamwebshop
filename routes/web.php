<?php

use App\Livewire\AddCategory;
use App\Livewire\AddProduct;
use App\Livewire\AddUser;
use App\Livewire\CategoryList;
use App\Livewire\EditCategory;
use App\Livewire\ProductList;
use App\Livewire\TestPage;
use App\Livewire\UserList;
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

Route::get('/producten', ProductList::class)
    ->name('producten');
Route::get('/nieuw/product', AddProduct::class)
    ->name('addproduct');

Route::get('/categorie', CategoryList::class)
    ->name('categorie');
Route::get('/nieuw/categorie', AddCategory::class)
    ->name('addcategory');
Route::get('/edit/categorie/{id}', EditCategory::class)
    ->name('editcategory');




require __DIR__.'/auth.php';
