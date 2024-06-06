<?php

use App\Livewire\admin\categories\AddCategory;
use App\Livewire\admin\categories\CategoryList;
use App\Livewire\admin\categories\EditCategory;
use App\Livewire\admin\children\AddChild;
use App\Livewire\admin\children\ChildList;
use App\Livewire\admin\children\EditChild;
use App\Livewire\admin\products\AdminAddProduct;
use App\Livewire\admin\products\AdminEditProduct;
use App\Livewire\admin\products\AdminProductList;
use App\Livewire\admin\roles\AddRole;
use App\Livewire\admin\roles\EditRole;
use App\Livewire\admin\roles\RolesList;
use App\Livewire\admin\studiekeuzes\AddStudiekeuze;
use App\Livewire\admin\studiekeuzes\EditStudiekeuze;
use App\Livewire\admin\studiekeuzes\StudiekeuzeList;
use App\Livewire\admin\studyfields\AddStudyField;
use App\Livewire\admin\studyfields\StudyFieldList;
use App\Livewire\admin\subjects\AddSubject;
use App\Livewire\admin\subjects\SubjectList;
use App\Livewire\admin\users\AddUser;
use App\Livewire\admin\users\EditUser;
use App\Livewire\admin\users\UserList;
use App\Livewire\public\products\AddProduct;
use App\Livewire\public\products\EditProduct;
use App\Livewire\public\products\ProductList;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome2');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('home', 'home')
    ->middleware(['auth'])
    ->name('home');

//ProductList route showing only products with studiekeuze of current child
Route::get('/producten/{childId?}', ProductList::class)
    ->name('productList');

Route::get('/edit/kind/{id}', EditChild::class)
    ->name('editchild', ChildList::class);
Route::get('/nieuw/kind', AddChild::class)
    ->name('addchild');

//admin routes ---------------------------------------------------------
Route::middleware(['auth', 'checkRole:admin'])->group(function () {

    Route::view('admin/dashboard', 'dashboard')
        ->middleware(['auth', 'verified'])
        ->name('dashboard');

    Route::get('admin/rollen', RolesList::class)
        ->name('rollen');
    Route::get('admin/nieuw/rol', AddRole::class)
        ->name('addrole');
    Route::get('admin/edit/rol/{id}', EditRole::class)
        ->name('editrole');

    Route::get('admin/gebruikers', UserList::class)
        ->name('gebruikers');
    Route::get('admin/nieuw/gebruiker', AddUser::class)
        ->name('adduser');
    Route::get('admin/edit/gebruiker/{id}', EditUser::class)
        ->name('edituser');

    Route::get('admin/kinderen', ChildList::class)
        ->name('children');

    Route::get('admin/producten', AdminProductList::class)
        ->name('producten');
    Route::get('admin/nieuw/product', AdminAddProduct::class)
        ->name('addproduct');
    Route::get('admin/edit/product/{id}', AdminEditProduct::class)
        ->name('editproduct');

    Route::get('admin/categorie', CategoryList::class)
        ->name('categorie');
    Route::get('admin/nieuw/categorie', AddCategory::class)
        ->name('addcategory');
    Route::get('admin/edit/categorie/{id}', EditCategory::class)
        ->name('editcategory');

    Route::get('admin/studiekeuzes', StudiekeuzeList::class)
        ->name('studiekeuzes');
    Route::get('admin/nieuw/studiekeuze', AddStudiekeuze::class)
        ->name('addstudiekeuze');
    Route::get('admin/edit/studiekeuze', EditStudiekeuze::class)
        ->name('editstudiekeuze');

    Route::get('admin/richtingen', StudyFieldList::class)
        ->name('studyfields');
    Route::get('admin/nieuw/richting', AddStudyField::class)
        ->name('addstudyfield');

    Route::get('admin/vakken', SubjectList::class)
        ->name('subjects');
    Route::get('admin/nieuw/vak', AddSubject::class)
        ->name('addsubject');

});


require __DIR__.'/auth.php';
