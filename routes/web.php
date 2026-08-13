<?php

use App\Http\Controllers\Admin\ActualiteController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\CategorieController;
use App\Http\Controllers\Admin\CategorieDocumentController;
use App\Http\Controllers\Admin\CategorieServiceController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\EntiteController;
use App\Http\Controllers\Admin\MembreController;
use App\Http\Controllers\Admin\MotDuMaireController;
use App\Http\Controllers\Admin\PartenaireController;
use App\Http\Controllers\Admin\AncienMaireController;
use App\Http\Controllers\Admin\SecretariatMembreController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Front\HomeController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['prefix' => 'admin','middleware' => 'redirectAdmin'], function() {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('admin.login.post');
});

Route::group(['middleware' =>['auth', 'verified'], 'prefix' => 'admin', 'as' => 'admin.'], function(){
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile', [ProfileController::class, 'updatePassword'])->name('password.update');
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::resource('users', UserController::class);

    Route::resource('categories-documents', CategorieDocumentController::class, [
        'parameters' => ['categories-documents' => 'categorieDocument']
    ]);
    Route::patch('/categories-documents/{categorieDocument}/toggle-active', [CategorieDocumentController::class, 'toggleActive'])->name('categories-documents.toggle-active');
    Route::post('/categories-documents/update-order', [CategorieDocumentController::class, 'updateOrder'])->name('categories-documents.update-order');

    // ======= GESTION DES MEMBRES =======
    Route::get('/membres', [MembreController::class, 'index'])->name('membres.index');
    Route::get('/membres/create', [MembreController::class, 'create'])->name('membres.create');
    Route::post('/membres', [MembreController::class, 'store'])->name('membres.store');
    Route::get('/membres/{id}/edit', [MembreController::class, 'edit'])->name('membres.edit');
    Route::put('/membres/{id}', [MembreController::class, 'update'])->name('membres.update');
    Route::delete('/membres/{id}', [MembreController::class, 'destroy'])->name('membres.destroy');
    Route::get('/membres/{id}', [MembreController::class, 'show'])->name('membres.show');

    // ======= GESTION DU MOT DU MAIRE =======
    Route::get('/mot-du-maire', [MotDuMaireController::class, 'edit'])->name('mot-du-maire.index');
    Route::get('/mot-du-maire/edit', [MotDuMaireController::class, 'edit'])->name('mot-du-maire.edit');
    Route::put('/mot-du-maire', [MotDuMaireController::class, 'update'])->name('mot-du-maire.update');
    Route::patch('/mot-du-maire', [MotDuMaireController::class, 'update'])->name('mot-du-maire.patch');

    // ======= GESTION DES ENTITÉS =======
    Route::resource('entites', EntiteController::class);
    Route::get('entites/{entite}/membres', [EntiteController::class, 'showMembres'])->name('entites.membres');

    // Routes CRUD publiques
    Route::resource('actualites', ActualiteController::class);
    Route::resource('categories', CategorieController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('categorie_services', CategorieServiceController::class);
    Route::resource('partenaires', PartenaireController::class);
    Route::resource('documents', DocumentController::class);

    // ======= GESTION DES ANCIENS MAIRES =======
    Route::get('anciens-maires', [AncienMaireController::class, 'index'])->name('anciens_maires.index');
    Route::get('anciens-maires/create', [AncienMaireController::class, 'create'])->name('anciens_maires.create');
    Route::post('anciens-maires', [AncienMaireController::class, 'store'])->name('anciens_maires.store');
    Route::get('anciens-maires/{id}/edit', [AncienMaireController::class, 'edit'])->name('anciens_maires.edit');
    Route::put('anciens-maires/{id}', [AncienMaireController::class, 'update'])->name('anciens_maires.update');
    Route::delete('anciens-maires/{id}', [AncienMaireController::class, 'destroy'])->name('anciens_maires.destroy');

    // ======= GESTION DU SECRÉTARIAT =======
    Route::get('/secretariat', [SecretariatMembreController::class, 'manage'])->name('secretariat.index');
    Route::get('/secretariat/create', [SecretariatMembreController::class, 'create'])->name('secretariat.create');
    Route::post('/secretariat', [SecretariatMembreController::class, 'store'])->name('secretariat.store');
    Route::get('/secretariat/{id}/edit', [SecretariatMembreController::class, 'edit'])->name('secretariat.edit');
    Route::put('/secretariat/{id}', [SecretariatMembreController::class, 'update'])->name('secretariat.update');
    Route::delete('/secretariat/{id}', [SecretariatMembreController::class, 'destroy'])->name('secretariat.destroy');

    // ======= GESTION DES DOCUMENTS =======
    Route::get('/documents_mairie', [DocumentController::class, 'index2'])->name('mairie.documents.index');
    Route::get('/documents/{document}', [DocumentController::class, 'show'])->name('documents.show');
    Route::get('/documents_mairie/create', [DocumentController::class, 'create'])->name('mairie.documents.create');
    Route::post('/documents_mairie', [DocumentController::class, 'store'])->name('mairie.documents.store');
    Route::get('/documents_mairie/{document}/edit', [DocumentController::class, 'edit'])->name('mairie.documents.edit');
    Route::put('/documents_mairie/{document}', [DocumentController::class, 'update'])->name('mairie.documents.update');
    Route::delete('/documents_mairie/{document}', [DocumentController::class, 'destroy'])->name('mairie.documents.destroy');
    Route::patch('/documents/{document}/toggle-public', [DocumentController::class, 'togglePublic'])->name('documents.toggle-public');
    Route::patch('/documents/{document}/toggle-archive', [DocumentController::class, 'toggleArchive'])->name('documents.toggle-archive');
    Route::get('/documents/statistiques', [DocumentController::class, 'statistiques'])->name('documents.statistiques');
});
require __DIR__.'/auth.php';
