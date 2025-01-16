<?php

use Illuminate\Support\Facades\Route;

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



Auth::routes([
    'register' =>false,
    'reset' => false,
    'verify' => false,
]);

/*front */
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/kontak', [App\Http\Controllers\KontakController::class, 'index'])->name('kontak');
Route::get('/struktur_organisasi', [App\Http\Controllers\StrukturController::class, 'index'])->name('struktur');
Route::get('/sakip', [App\Http\Controllers\SakipController::class, 'index'])->name('sakip');
Route::get('/aplikasi', [App\Http\Controllers\HomeController::class, 'aplikasi'])->name('aplikasi');
Route::get('/produk_hukum', [App\Http\Controllers\ProdukHukumFrontController::class, 'index'])->name('produk_hukum');
Route::get('/dasarhukum', [App\Http\Controllers\HomeController::class, 'dasar'])->name('dasarhukum');
Route::get('/informasi/berita',[App\Http\Controllers\InformasiFrontController::class, 'show_all'])->name('berita.show_all');
Route::get('/informasi/pengumuman',[App\Http\Controllers\InformasiFrontController::class, 'show_pengumuman_all'])->name('pengumuman.show_all');
Route::get('/informasi/berita/{slug}',[App\Http\Controllers\InformasiFrontController::class, 'show'])->name('berita.show');
Route::get('/informasi/pengumuman/{slug}',[App\Http\Controllers\InformasiFrontController::class, 'show_pengumuman'])->name('pengumuman.show');
Route::get('/informasi/pinned/{slug}',[App\Http\Controllers\InformasiFrontController::class, 'show_pinned'])->name('pinned.show');
Route::get('/bumdesa', [App\Http\Controllers\BumdesController::class, 'index'])->name('bumdesa');


/*back */
Route::get('/back', [App\Http\Controllers\HomeCMSController::class, 'index'],['middleware' => 'auth'])->name('cmshome.index');
Route::group(['prefix' => 'back','middleware' => 'auth'], function() {
    Route::resource('users', App\Http\Controllers\AuthUserController::class);
    Route::resource('limit_nominal', App\Http\Controllers\LimitNominalController::class);
    Route::resource('pengurus_cabor', App\Http\Controllers\PengurusCaborController::class);
    Route::resource('pelatih_cabor', App\Http\Controllers\PelatihController::class);
    Route::resource('atlit_cabor', App\Http\Controllers\AtlitController::class);
    Route::resource('prestasi_cabor', App\Http\Controllers\PrestasiController::class);
    Route::get('get-kegiatan', [App\Http\Controllers\PerencanaanController::class,'getKegiatan'])->name('get.kegiatan');
    Route::get('get-rekening/{kode_kegiatan}', [App\Http\Controllers\PerencanaanController::class,'getRekening']);
    Route::get('get-belanja/{kode_rekening}', [App\Http\Controllers\PerencanaanController::class,'getBelanja']);
    Route::get('get-barang/{kode_belanja}', [App\Http\Controllers\PerencanaanController::class,'getBarang']);
    Route::get('get-harga/{kode_barang}', [App\Http\Controllers\PerencanaanController::class,'getHarga']);
    Route::get('get-budget-limit/{year}', [App\Http\Controllers\PerencanaanController::class,'getBudgetLimit']);
    Route::get('/perencanaan/detail/{id}', [App\Http\Controllers\PerencanaanController::class,'getDetail'])->name('perencanaan.detail');
    Route::get('verifikasi-perencanaan', [App\Http\Controllers\PerencanaanController::class,'verifikasi'])->name('perencanaan.verifikasi');
    Route::post('/perencanaan/setuju/{id}', [App\Http\Controllers\PerencanaanController::class, 'setuju'])->name('perencanaan.setuju');
    Route::post('/perencanaan/tolak/{id}', [App\Http\Controllers\PerencanaanController::class, 'tolak'])->name('perencanaan.tolak');
    Route::resource('perencanaan', App\Http\Controllers\PerencanaanController::class);
    Route::get('belanja/{year}/{month}',[App\Http\Controllers\BelanjaBarjasController::class,'show'])->name('belanja2.show');
    Route::resource('belanja', App\Http\Controllers\BelanjaBarjasController::class);
    Route::resource('informasi', App\Http\Controllers\InformasiController::class);

});

