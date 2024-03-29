<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TranslateController;

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
    return view('start', ['languages' => TranslateController::$languages, 'input' => '', 'searchCategory' => '', 'toLanguage' => 'enUS']);
});

Route::get('/imprint', function () {
    return view('imprint');
});

Route::middleware('auth')->group(function () {
    Route::get('/importtranslations', [TranslateController::class, 'importTranslations']);
});

Route::get('/translate', function () {
    return redirect('/');
});
Route::post('/translate', [TranslateController::class, 'translate']);

if (App::environment(['local']) === true) {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    require __DIR__ . '/auth.php';
}
