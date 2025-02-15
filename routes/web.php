<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\FormationObjectifController;
use App\Http\Controllers\ImagePreuveController;
use App\Http\Controllers\ObjectifController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectObjectifController;
use App\Http\Controllers\ReclamationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SuivrePointageController;
use App\Http\Controllers\TacheController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VenteObjectifController;

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->name('verification.send');
Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])->name('verification.notice');

Route::get('/send-test-email', function () {
    $details = [
        'title' => 'Test Email from Laravel',
        'body' => 'This is a test email.'
    ];

    Mail::raw('This is a test email.', function ($message) {
        $message->to('test@example.com') // Replace with a valid email address
                ->subject('Test Email')
                ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
    });

    return 'Test email sent!';
});

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Route pour afficher le tableau de bord
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('check.clocked.in'); 
   
    //Route::get('/dashboard', [FormationController::class, 'index'])->name('dashboard');
    // Routes pour la gestion du profil utilisateur
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes pour la gestion des projets
    Route::get('/project', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');

    Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');

    Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');

    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');




    //Route::get('/users', [RegisteredUserController::class, 'index'])->name('users.index');

// Formulaire pour ajouter un nouvel utilisateur
//Route::get('/users/create', [RegisteredUserController::class, 'create'])->name('users.create');

// Enregistrer un nouvel utilisateur
//Route::post('/users', [RegisteredUserController::class, 'store'])->name('users.store');

// Afficher les détails d’un utilisateur spécifique
//Route::get('/users/{id}', [RegisteredUserController::class, 'show'])->name('users.show');

// Formulaire pour modifier un utilisateur spécifique
//Route::get('/users/{id}/edit', [RegisteredUserController::class, 'edit'])->name('users.edit');

// Mettre à jour un utilisateur spécifique
//Route::put('/users/{id}', [RegisteredUserController::class, 'update'])->name('users.update');

// Supprimer un utilisateur spécifique
//Route::delete('/users/{id}', [RegisteredUserController::class, 'destroy'])->name('users.destroy');

Route::get('/taches', [TacheController::class, 'index'])->name('taches.index');


Route::resource('taches', TacheController::class);
Route::resource('formations', FormationController::class);
Route::post('/formations/store', [FormationController::class, 'store'])->name('formations.store');


Route::resource('vente_objectifs', VenteObjectifController::class);
Route::middleware(['auth'])->group(function () {
    Route::get('/suivre-pointage', [SuivrePointageController::class, 'index'])->name('suivre_pointage.index');
    Route::post('/suivre-pointage/pointer', [SuivrePointageController::class, 'pointer'])->name('suivre_pointage.pointer');
});
Route::resource('objectifs', ObjectifController::class);
Route::resource('reclamations', ReclamationController::class);
Route::resource('users', UserController::class);
Route::resource('roles', RoleController::class);
Route::post('/suivre-pointage/pointer', [SuivrePointageController::class, 'pointer'])->name('suivre_pointage.pointer');

Route::middleware(['auth', 'check.clocked.in'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard'); 

});
Route::resource('image_preuve', ImagePreuveController::class);
Route::get('/image_preuve/{id}/download', [ImagePreuveController::class, 'download'])->name('image_preuve.download');
Route::get('/test-404', function () {
    abort(404);
});
Route::get('/login-history', [AuthenticatedSessionController::class, 'showLoginHistory'])->name('login.history');
});

// Handle registration

require __DIR__.'/auth.php';
