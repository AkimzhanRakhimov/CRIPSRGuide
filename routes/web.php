<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CRISPRController;


Route::get('/', function () {
    $guides = session('guides', []);  // забираем данные из сессии
    return view('home', compact('guides'));
});

Route::post('/design', [CRISPRController::class, 'design'])->name('design');
Route::get('/about', [AboutController::class, 'index']);
Route::get('/download', [CRISPRController::class, 'download'])->name('download');
