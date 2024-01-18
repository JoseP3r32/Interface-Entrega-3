<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmotionController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MoodController;
use App\Http\Controllers\Auth\ActiveUserController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/admin', function () {
        $users = App\Models\User::all();
        return view('admin', ['users' => $users]);
    });

    Route::get('/listar-moods', [MenuController::class, 'showMoods'])->name('listar.moods');
    Route::get('/listar-emotions', [MenuController::class, 'showEmotions'])->name('listar.emotions');
    Route::get('/listar-events', [MenuController::class, 'showEvents'])->name('listar.events');

    

    Route::post('/activate/{userId}', [ActiveUserController::class, 'activateUser'])->name('activate.user');
    Route::post('/deactivate/{userId}', [ActiveUserController::class, 'deactivateUser'])->name('deactivate.user');

    Route::get('/usuarios/{id}/editar', [UserController::class, 'edit'])->name('usuarios.editar');
    Route::put('/usuarios/{id}', [UserController::class, 'update'])->name('usuarios.actualizar');


    Route::get('/emotions/create', [EmotionController::class, 'create'])->name('emotions.create');
    Route::post('/emotions', [EmotionController::class, 'store'])->name('emotions.store');
    
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');

    Route::get('/moods/create', [MoodController::class, 'create'])->name('moods.create');
    Route::post('/moods', [MoodController::class, 'store'])->name('moods.store');

    Route::get('/emotions/{id}/edit', [EmotionController::class, 'edit'])->name('emotions.edit');
    Route::put('/emotion/{id}', [EmotionController::class, 'update'])->name('emotions.update');
    Route::post('/eliminar-emocion', [EmotionController::class, 'deleteEmotion'])->name('emotion.delete');

    Route::get('/events/{id}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/event/{id}', [EventController::class, 'update'])->name('events.update');
    Route::post('/eliminar-evento', [EventController::class, 'deleteEvent'])->name('event.delete');

    Route::get('/moods/{id}/edit', [MoodController::class, 'edit'])->name('moods.edit');
    Route::put('/mood/{id}', [MoodController::class, 'update'])->name('moods.update');
    Route::post('/eliminar-mood', [MoodController::class, 'deleteMood'])->name('mood.delete');

    
    Route::get('/listar-elementos', [MenuController::class, 'showAllElement'])->name('listar.elementos');
    Route::get('/generate-pdf', [PDFController::class, 'generatePDF'])->name('generate.pdf');
    


    


    Route::post('/eliminar', function (Request $request) {
        $user = App\Models\User::find($request->input('iduser'));
        $user->deleted = 1;

        try {
            $user->save();
        } catch (\Exception $e) {
            return redirect()->route('admin')->with('error', 'Error al guardar el usuario: ' . $e->getMessage());
        }

        $users = App\Models\User::all();
        return view('admin', ['users' => $users]);
    });

    Route::get('/adminDashboard', [UserController::class, 'index'])->name('admin');
});

require __DIR__ . '/auth.php';
