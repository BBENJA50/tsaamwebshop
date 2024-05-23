<?php

use App\Livewire\AddRole;
use App\Livewire\categories\AddCategory;
use App\Livewire\categories\CategoryList;
use App\Livewire\categories\EditCategory;
use App\Livewire\children\AddChild;
use App\Livewire\children\ChildList;
use App\Livewire\children\EditChild;
use App\Livewire\EditRole;
use App\Livewire\products\AddProduct;
use App\Livewire\products\EditProduct;
use App\Livewire\products\ProductList;
use App\Livewire\roles\RolesList;
use App\Livewire\studiekeuzes\AddStudiekeuze;
use App\Livewire\studiekeuzes\StudiekeuzeList;
use App\Livewire\studyfields\AddStudyField;
use App\Livewire\studyfields\StudyFieldList;
use App\Livewire\subjects\AddSubject;
use App\Livewire\subjects\SubjectList;
use App\Livewire\users\AddUser;
use App\Livewire\users\EditUser;
use App\Livewire\users\UserList;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome2');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

//admin routes
Route::middleware(['auth', 'checkRole:admin'])->group(function () {

    Route::view('dashboard', 'dashboard')
        ->middleware(['auth', 'verified'])
        ->name('dashboard');

    Route::get('/rollen', RolesList::class)
        ->name('rollen');
    Route::get('/nieuw/rol', AddRole::class)
        ->name('addrole');
    Route::get('/edit/rol/{id}', EditRole::class)
        ->name('editrole');

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

    Route::get('/kinderen', ChildList::class)
        ->name('children');
    Route::get('/nieuw/kind', AddChild::class)
        ->name('addchild');
    Route::get('/edit/kind/{id}', EditChild::class)
        ->name('editchild');

    Route::get('/studiekeuzes', StudiekeuzeList::class)
        ->name('studiekeuzes');
    Route::get('/nieuw/studiekeuze', AddStudiekeuze::class)
        ->name('addstudiekeuze');

    Route::get('/richtingen', StudyFieldList::class)
        ->name('studyfields');
    Route::get('/nieuw/richting', AddStudyField::class)
        ->name('addstudyfield');

    Route::get('/vakken', SubjectList::class)
        ->name('subjects');
    Route::get('/nieuw/vak', AddSubject::class)
        ->name('addsubject');

});


require __DIR__.'/auth.php';
