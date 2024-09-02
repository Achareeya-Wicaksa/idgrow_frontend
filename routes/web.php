<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

Route::view('/login', 'auth.login')->name('login');
Route::redirect('/', '/barang');
Route::redirect('/dashboard', '/barang');
Route::post('/login', function (Request $request) {
    $response = Http::post(env('API_URL') . '/login', [
        'email' => $request->email,
        'password' => $request->password,
    ]);

    if ($response->successful()) {
        $token = $response->json()['token'];
        Session::put('access_token', $token);
        return redirect('/barang');
    }

    return back()->withErrors(['email' => 'Invalid credentials']);
});

Route::middleware(['auth', 'add_api_token'])->group(function () {
    Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
    Route::post('/barang', [BarangController::class, 'store']);
    Route::get('/barang/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
    Route::put('/barang/{id}', [BarangController::class, 'update']);
    Route::delete('/barang/{id}', [BarangController::class, 'destroy']);
});
Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');

require __DIR__.'/auth.php';
