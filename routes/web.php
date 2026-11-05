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
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\SecretariatMembreController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Front\CitoyenController;
use App\Http\Controllers\Front\CommuneController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\MairieController;
use App\Http\Controllers\Front\PostController;
use App\Http\Controllers\Front\ServiceController as FrontServiceController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('trackVisits')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/actualites', [PostController::class, 'index'])->name('actualites.index');
    Route::get('/actualites/{post:slug}', [PostController::class, 'show'])->name('actualites.show');

    Route::get('/services', [FrontServiceController::class, 'index'])->name('services.index');
    Route::get('/services/tarifs/{id}', [FrontServiceController::class, 'show'])->name('services.tarif');

    Route::get('/maire/elus-municipaux', [MairieController::class, 'elus'])->name('front.elus');
    Route::get('/mairie/secretariat-executif', [MairieController::class, 'executif'])->name('front.executif');
    Route::get('/maire/mot-du-maire', [MairieController::class, 'maire'])->name('front.maire');
    Route::get('/mairie/mandatures', [MairieController::class, 'anciensMaires'])->name('front.mandature');
    Route::get('/mairie/organigramme', [MairieController::class, 'organigramme'])->name('front.organigramme');


    Route::get('/commune/presentation', [CommuneController::class, 'presentation'])->name('commune.presentation');
    Route::get('/commune/historique', [CommuneController::class, 'historique'])->name('commune.historique');
    Route::get('/commune/arrondissement', [CommuneController::class, 'arrondissement'])->name('commune.arrondissement');
    Route::get('/commune/projets', [CommuneController::class, 'projet'])->name('commune.projet');

    Route::get('/documentation', [CitoyenController::class, 'document'])->name('document.index');
    Route::get('/citoyen/contact', [CitoyenController::class, 'contact'])->name('citoyen.contact');
    Route::get('/citoyen/requete', [CitoyenController::class, 'requete'])->name('citoyen.requete');
    Route::post('/citoyen/requete', [CitoyenController::class, 'store'])->name('citoyen.store');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['prefix' => 'admin','middleware' => 'redirectAdmin'], function() {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('admin.login.post');
});

Route::group(['middleware' =>['auth', 'verified', 'can:manage-news'], 'prefix' => 'admin', 'as' => 'admin.'], function(){
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

    Route::resource('evenements', EventController::class);

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

    Route::get('setting', [SettingController::class, 'index'])->name('setting.index');

    Route::put('general-setting-update', [SettingController::class, 'generalSettingUpdate'])->name('general-setting.update');
    Route::put('email-setting-update', [SettingController::class, 'emailConfigSettingUpdate'])->name('email-setting.update');
    Route::put('logo-setting-update', [SettingController::class, 'logoSettingUpdate'])->name('logo-setting.update');
});



require __DIR__.'/auth.php';
