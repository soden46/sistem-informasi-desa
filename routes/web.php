<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\DataKeluargaController;
use App\Http\Controllers\admin\DataKKController;
use App\Http\Controllers\admin\MasyarakatController;
use App\Http\Controllers\admin\MutasiKeluarController;
use App\Http\Controllers\admin\MutasiMAsukController;
use App\Http\Controllers\admin\SuratKetKelahiranController;
use App\Http\Controllers\admin\SuratKetKematianController;
use App\Http\Controllers\admin\SuratKetBedaNamaController;
use App\Http\Controllers\admin\SuratKetStatusController;
use App\Http\Controllers\admin\SuratKetBiasaController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\warga\WargaController;
use App\Http\Controllers\warga\WargaMutasiKeluarController;
use App\Http\Controllers\warga\WArgaMutasiMAsukController;
use App\Http\Controllers\warga\WargaMyAccountController;
use App\Http\Controllers\warga\WargaSuratKetKelahiranController;
use App\Http\Controllers\warga\WargaSuratKetKematianController;
use App\Http\Controllers\warga\WargaSuratKetBedaNamaController;
use App\Http\Controllers\warga\WargaSuratKetStatusController;
use App\Http\Controllers\warga\WargaSuratKetBiasaController;
use Illuminate\Support\Facades\Auth;
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

// Auth::routes();
// Login
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::get('/register', [LoginController::class, 'index'])->name('register')->middleware('guest');
Route::post('/register', [LoginController::class, 'store'])->name('register')->middleware('guest');
Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/authenticate', [LoginController::class, 'authenticate']);
Route::get('/logout', [LoginController::class, 'logout'])->name('guest');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

// Route Akun Admin/Staff
Route::middleware(['auth', 'role:staff'])->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin', 'index')->name('admin');
    });

    Route::controller(MasyarakatController::class)->group(function () {
        Route::get('/data-penduduk', 'index')->name('data-penduduk')->middleware('auth');
        Route::post('/data-penduduk/store', 'store')->name('data-penduduk/store')->middleware('auth');
        Route::post('/data-penduduk/{nik}', 'update')->name('data-penduduk/update')->middleware('auth');
        Route::delete('/data-penduduk/{nik}', 'destroy')->name('data-penduduk')->middleware('auth');
        Route::post('/data-penduduk/store/excel', 'storeExcel')->name('data-penduduk/store/excel')->middleware('auth');
    });

    Route::controller(DataKKController::class)->group(function () {
        Route::get('/data-kk', 'index')->name('data-kk')->middleware('auth');
        Route::post('/data-kk/store', 'store')->name('data-kk/store')->middleware('auth');
        Route::post('/data-kk/{nik}', 'update')->name('data-kk/update')->middleware('auth');
        Route::get('/getSts/{nik}', 'getSts');
        Route::delete('/data-kk/{nik}', 'destroy')->name('data-kk')->middleware('auth');
    });

    Route::controller(DataKeluargaController::class)->group(
        function () {
            Route::get('/data-keluarga/{no_kk}', 'index')->name('data-keluarga')->middleware('auth');
            Route::get('/data-keluarga/{no_kk}', 'index')->name('data-keluarga/cari')->middleware('auth');
            Route::post('/data-keluarga/store', 'store')->name('data-keluarga/store')->middleware('auth');
            Route::post('/data-keluarga/{nik}', 'update')->name('data-keluarga')->middleware('auth');
            Route::delete('/data-keluarga/{nik}', 'destroy')->name('data-keluarga')->middleware('auth');
        }
    );

    Route::controller(SuratKetKelahiranController::class)->group(
        function () {
            Route::get('/surat-keterangan-kelahiran', 'index')->name('surat-keterangan-kelahiran')->middleware('auth');
            Route::post('/surat-keterangan-kelahiran/save', 'save')->name('surat-keterangan-kelahiran/save')->middleware('auth');
            Route::post('/surat-keterangan-kelahiran/{nik_bayi}', 'update')->name('surat-keterangan-kelahiran')->middleware('auth');
            Route::delete('/surat-keterangan-kelahiran/{nik_bayi}', 'destroy')->name('surat-keterangan-kelahiran')->middleware('auth');
            Route::get('/surat-keterangan-kelahiran/pdf/{nik_bayi}', 'pdf')->name('surat-keterangan-kelahiran/pdf')->middleware('auth');
            Route::get('/surat-keterangan-kelahiran/pdflurah/{nik_bayi}', 'pdflurah')->name('surat-keterangan-kelahiran/pdflurah')->middleware('auth');
            Route::post('/surat-keterangan-kelahiran/lampiran/store/{nik_bayi}', 'lampiranStore')->name('surat-keterangan-kelahiran/lampiran/store')->middleware('auth');
            Route::get('/surat-keterangan-kelahiran/lampiran/edit/{nik_bayi}', 'lampiranEdit')->name('surat-keterangan-kelahiran/lampiran/edit')->middleware('auth');
            Route::get('/surat-keterangan-kelahiran/lampiran/update/{nik_bayi}', 'lampiranUpdate')->name('surat-keterangan-kelahiran/lampiran/update')->middleware('auth');
            Route::get('/surat-keterangan-kelahiran/lampiran/destroy/{nik_bayi}', 'lampiranDestroy')->name('surat-keterangan-kelahiran/lampiran/destroy')->middleware('auth');
            Route::get('/surat-keterangan-kelahiran/lampiran/show/{nik_bayi}', 'showLampiran')->name('surat-keterangan-kelahiran/lampiran/show')->middleware('auth');
        }
    );

    Route::controller(SuratKetKematianController::class)->group(
        function () {
            Route::get('/surat-keterangan-kematian', 'index')->name('surat-keterangan-kematian')->middleware('auth');
            Route::post('/surat-keterangan-kematian/save', 'store')->name('surat-keterangan-kematian/save')->middleware('auth');
            Route::post('/surat-keterangan-kematian/{nik_mati}', 'update')->name('surat-keterangan-kematian')->middleware('auth');
            Route::delete('/surat-keterangan-kematian/{nik_mati}', 'destroy')->name('surat-keterangan-kematian')->middleware('auth');
            Route::get('/surat-keterangan-kematian/pdf/{nik_mati}', 'pdf')->name('surat-keterangan-kematian/pdf')->middleware('auth');
            Route::get('/surat-keterangan-kematian/pdflurah/{nik_mati}', 'pdflurah')->name('surat-keterangan-kematian/pdflurah')->middleware('auth');
            Route::post('/surat-keterangan-kematian/lampiran/store/{nik_mati}', 'lampiranStore')->name('surat-keterangan-kematian/lampiran/store')->middleware('auth');
            Route::get('/surat-keterangan-kematian/lampiran/edit/{nik_mati}', 'lampiranEdit')->name('surat-keterangan-kematian/lampiran/edit')->middleware('auth');
            Route::get('/surat-keterangan-kematian/lampiran/update/{nik_mati}', 'lampiranUpdate')->name('surat-keterangan-kematian/lampiran/update')->middleware('auth');
            Route::get('/surat-keterangan-kematian/lampiran/destroy/{nik_mati}', 'lampiranDestroy')->name('surat-keterangan-kematian/lampiran/destroy')->middleware('auth');
            Route::get('/surat-keterangan-kematian/lampiran/show/{nik_mati}', 'showLampiran')->name('surat-keterangan-kematian/lampiran/show')->middleware('auth');
        }
    );

    Route::controller(MutasiMAsukController::class)->group(
        function () {
            Route::get('/data-mutasi-masuk', 'index')->name('data-mutasi-masuk')->middleware('auth');
            Route::post('/data-mutasi-masuk/store', 'store')->name('data-mutasi-masuk/store')->middleware('auth');
            Route::post('/data-mutasi-masuk/update/{nik_mm}', 'update')->name('data-mutasi-masuk/update')->middleware('auth');
            Route::delete('/data-mutasi-masuk/delete/{nik_mm}', 'destroy')->name('data-mutasi-masuk/delete')->middleware('auth');
            Route::get('/data-mutasi-masuk/pdf/{nik_mm}', 'pdf')->name('data-mutasi-masuk/pdf')->middleware('auth');
            Route::post('/data-mutasi-masuk/lampiran/store/{nik_mm}', 'lampiranStore')->name('data-mutasi-masuk/lampiran/store')->middleware('auth');
            Route::get('/data-mutasi-masuk/lampiran/edit/{nik_mm}', 'lampiranEdit')->name('data-mutasi-masuk/lampiran/edit')->middleware('auth');
            Route::get('/data-mutasi-masuk/lampiran/update/{nik_mm}', 'lampiranUpdate')->name('data-mutasi-masuk/lampiran/update')->middleware('auth');
            Route::get('/data-mutasi-masuk/lampiran/destroy/{nik_mm}', 'lampiranDestroy')->name('data-mutasi-masuk/lampiran/destroy')->middleware('auth');
            Route::get('/data-mutasi-masuk/lampiran/show/{nik_mm}', 'showLampiran')->name('data-mutasi-masuk/lampiran/show')->middleware('auth');
            // Route Depend Penduduk Pada Form Tambah Data
            Route::get('getPelapor/{nik_pelapor}', function ($nik_pelapor) {
                $nama_pelapor = App\Models\Penduduk::where('nik', $nik_pelapor)->get();
                return response()->json($nama_pelapor);
            });
        }
    );

    Route::controller(MutasiKeluarController::class)->group(
        function () {
            Route::get('/data-mutasi-keluar', 'index')->name('data-mutasi-keluar')->middleware('auth');
            Route::post('/data-mutasi-keluar/store', 'store')->name('data-mutasi-keluar/store')->middleware('auth');
            Route::post('/data-mutasi-keluar/update/{nik_mk}', 'update')->name('data-mutasi-keluar/update')->middleware('auth');
            Route::delete('/data-mutasi-keluar/delete/{nik_mk}', 'destroy')->name('data-mutasi-keluar/delete')->middleware('auth');
            Route::get('/data-mutasi-keluar/pdf/{nik_mk}', 'pdf')->name('data-mutasi-keluar/pdf')->middleware('auth');
            Route::post('/data-mutasi-keluar/lampiran/store/{nik_mk}', 'lampiranStore')->name('data-mutasi-keluar/lampiran/store')->middleware('auth');
            Route::get('/data-mutasi-keluar/lampiran/edit/{nik_mk}', 'lampiranEdit')->name('data-mutasi-keluar/lampiran/edit')->middleware('auth');
            Route::get('/data-mutasi-keluar/lampiran/update/{nik_mk}', 'lampiranUpdate')->name('data-mutasi-keluar/lampiran/update')->middleware('auth');
            Route::get('/data-mutasi-keluar/lampiran/destroy/{nik_mk}', 'lampiranDestroy')->name('data-mutasi-keluar/lampiran/destroy')->middleware('auth');
            Route::get('/data-mutasi-keluar/lampiran/show/{nik_mk}', 'showLampiran')->name('data-mutasi-keluar/lampiran/show')->middleware('auth');
        }
    );

    Route::controller(SuratKetBedaNamaController::class)->group(
        function () {
            Route::get('/surat-ket-beda-nama', 'index')->name('surat-ket-beda-nama')->middleware('auth');
            Route::post('/surat-ket-beda-nama/store', 'store')->name('surat-ket-beda-nama/store')->middleware('auth');
            Route::post('/surat-ket-beda-nama/verif/{nik}', 'update')->name('surat-ket-beda-nama/verif')->middleware('auth');
            Route::delete('/surat-ket-beda-nama/delete/{nik}', 'destroy')->name('surat-ket-beda-nama/delete')->middleware('auth');
            Route::get('/surat-keterangan-beda-nama/pdf/{nik}', 'pdf')->name('surat-keterangan-beda-nama/pdf')->middleware('auth');
            Route::get('/surat-keterangan-beda-nama/pdf/lurah/{nik}', 'pdflurah')->name('surat-keterangan-beda-nama/pdflurah')->middleware('auth');
            Route::post('/surat-keterangan-beda-nama/lampiran/store/{nik}', 'lampiranStore')->name('surat-keterangan-beda-nama/lampiran/store')->middleware('auth');
            Route::get('/surat-keterangan-beda-nama/lampiran/edit/{nik}', 'lampiranEdit')->name('surat-keterangan-beda-nama/lampiran/edit')->middleware('auth');
            Route::get('/surat-keterangan-beda-nama/lampiran/update/{nik}', 'lampiranUpdate')->name('surat-keterangan-beda-nama/lampiran/update')->middleware('auth');
            Route::get('/surat-keterangan-beda-nama/lampiran/destroy/{nik}', 'lampiranDestroy')->name('surat-keterangan-beda-nama/lampiran/destroy')->middleware('auth');
            Route::get('/surat-keterangan-beda-nama/lampiran/show/{nik}', 'showLampiran')->name('surat-keterangan-beda-nama/lampiran/show')->middleware('auth');
        }
    );

    Route::controller(SuratKetStatusController::class)->group(
        function () {
            Route::get('/surat-keterangan-status', 'index')->name('surat-keterangan-status')->middleware('auth');
            Route::post('/surat-keterangan-status/store', 'store')->name('surat-keterangan-status/store')->middleware('auth');
            Route::post('/surat-keterangan-status/{nik}', 'update')->name('surat-keterangan-status/verif')->middleware('auth');
            Route::delete('/surat-keterangan-status/delete/{nik}', 'destroy')->name('surat-keterangan-status/delete')->middleware('auth');
            Route::get('/surat-keterangan-status/pdf/{nik}', 'pdf')->name('surat-keterangan-status/pdf')->middleware('auth');
            Route::get('/surat-keterangan-status/pdf/lurah/{nik}', 'pdflurah')->name('surat-keterangan-status/pdflurah')->middleware('auth');
            Route::post('/surat-keterangan-status/lampiran/store/{nik}', 'lampiranStore')->name('surat-keterangan-status/lampiran/store')->middleware('auth');
            Route::get('/surat-keterangan-status/lampiran/edit/{nik}', 'lampiranEdit')->name('surat-keterangan-status/lampiran/edit')->middleware('auth');
            Route::get('/surat-keterangan-status/lampiran/update/{nik}', 'lampiranUpdate')->name('surat-keterangan-status/lampiran/update')->middleware('auth');
            Route::get('/surat-keterangan-status/lampiran/destroy/{nik}', 'lampiranDestroy')->name('surat-keterangan-status/lampiran/destroy')->middleware('auth');
            Route::get('/surat-keterangan-status/lampiran/show/{nik}', 'showLampiran')->name('surat-keterangan-status/lampiran/show')->middleware('auth');
        }
    );

    Route::controller(SuratKetBiasaController::class)->group(
        function () {
            Route::get('/surat-keterangan-biasa', 'index')->name('surat-keterangan-biasa')->middleware('auth');
            Route::post('/surat-keterangan-biasa/store', 'store')->name('surat-keterangan-biasa/store')->middleware('auth');
            Route::post('/surat-keterangan-biasa/{nik}', 'update')->name('surat-keterangan-biasa/verif')->middleware('auth');
            Route::delete('/surat-keterangan-biasa/delete/{nik}', 'destroy')->name('surat-keterangan-status/delete')->middleware('auth');
            Route::get('/surat-keterangan-biasa/pdf/{nik}', 'pdf')->name('surat-keterangan-biasa/pdf')->middleware('auth');
            Route::get('/surat-keterangan-biasa/pdf/lurah/{nik}', 'pdflurah')->name('surat-keterangan-biasa/pdflurah')->middleware('auth');
            Route::post('/surat-keterangan-biasa/lampiran/store/{nik}', 'lampiranStore')->name('surat-keterangan-biasa/lampiran/store')->middleware('auth');
            Route::get('/surat-keterangan-biasa/lampiran/edit/{nik}', 'lampiranEdit')->name('surat-keterangan-biasa/lampiran/edit')->middleware('auth');
            Route::get('/surat-keterangan-biasa/lampiran/update/{nik}', 'lampiranUpdate')->name('surat-keterangan-biasa/lampiran/update')->middleware('auth');
            Route::get('/surat-keterangan-biasa/lampiran/destroy/{nik}', 'lampiranDestroy')->name('surat-keterangan-biasa/lampiran/destroy')->middleware('auth');
            Route::get('/surat-keterangan-biasa/lampiran/show/{nik}', 'showLampiran')->name('surat-keterangan-biasa/lampiran/show')->middleware('auth');
        }
    );

    Route::controller(UserController::class)->group(function () {
        Route::get('/myAcount', 'myAcount')->name('myAcount')->middleware('auth');
        Route::post('Update/Account/{id}', 'updateMyAcount')->name('Update/Account')->middleware('auth');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/other-account', 'index')->name('other-account')->middleware('auth');
        Route::post('/other-account/store', 'store')->name('other-account')->middleware('auth');
        Route::post('other-account/update/{id}', 'update')->name('other-account/update')->middleware('auth');
    });
});

// Route Akun Warga/Penduduk
Route::middleware(['auth', 'role:masyarakat'])->group(function () {
    Route::controller(WargaController::class)->group(function () {
        Route::get('/masyarakat', 'index')->name('masyarakat');
    });

    Route::controller(WargaSuratKetKelahiranController::class)->group(
        function () {
            Route::get('/warga/surat-keterangan-kelahiran', 'index')->name('warga/surat-keterangan-kelahiran');
            Route::post('/warga/surat-keterangan-kelahiran/store', 'store')->name('warga/surat-keterangan-kelahiran/store');
            Route::post('/warga/surat-keterangan-kelahiran/{nik_bayi}', 'update')->name('warga/surat-keterangan-kelahiran');
            Route::delete('/warga/surat-keterangan-kelahiran/{nik_bayi}', 'destroy')->name('warga/surat-keterangan-kelahiran');
        }
    );

    Route::controller(WargaSuratKetKematianController::class)->group(
        function () {
            Route::get('/warga/surat-keterangan-kematian', 'index')->name('warga/surat-keterangan-kematian');
            Route::post('/warga/surat-keterangan-kematian/save', 'store')->name('warga/surat-keterangan-kematian/save');
            Route::post('/warga/surat-keterangan-kematian/{nik_mati}', 'update')->name('warga/surat-keterangan-kematian');
            Route::delete('/warga/surat-keterangan-kematian/{nik_mati}', 'destroy')->name('warga/surat-keterangan-kematian');
            Route::get('/warga/surat-keterangan-kematian/pdf/lurah/{nik_mati}', 'pdflurah')->name('warga/surat-keterangan-kematian/pdflurah');
            Route::post('/warga/surat-keterangan-kematian/lampiran/store/{nik_mati}', 'lampiranStore')->name('warga/surat-keterangan-kematian/lampiran/store')->middleware('auth');
            Route::get('/warga/surat-keterangan-kematian/lampiran/edit/{nik_mati}', 'lampiranEdit')->name('warga/surat-keterangan-kematian/lampiran/edit')->middleware('auth');
            Route::get('/warga/surat-keterangan-kematian/lampiran/update/{nik_mati}', 'lampiranUpdate')->name('warga/surat-keterangan-kematian/lampiran/update')->middleware('auth');
            Route::get('/warga/surat-keterangan-kematian/lampiran/destroy/{nik_mati}', 'lampiranDestroy')->name('warga/surat-keterangan-kematian/lampiran/destroy')->middleware('auth');
            Route::get('/warga/surat-keterangan-kematian/lampiran/show/{nik_mati}', 'showLampiran')->name('warga/surat-keterangan-kematian/lampiran/show')->middleware('auth');
        }
    );

    Route::controller(WargaSuratKetBedaNamaController::class)->group(
        function () {
            Route::get('/warga/surat-ket-beda-nama', 'index')->name('warga/surat-ket-beda-nama');
            Route::post('/warga/surat-ket-beda-nama/store', 'store')->name('warga/surat-ket-beda-nama/store');
            Route::post('/warga/surat-ket-beda-nama/verif/{nik}', 'update')->name('warga/surat-ket-beda-nama/verif');
            Route::delete('/warga/surat-ket-beda-nama/delete/{nik}', 'destroy')->name('warga/surat-ket-beda-nama/delete');
            Route::get('/warga/surat-ket-beda-nama/pdf/{nik}', 'pdf')->name('warga/surat-ket-beda-nama/pdf');
            Route::get('/warga/surat-ket-beda-nama/pdf/lurah/{nik}', 'pdflurah')->name('warga/surat-ket-beda-nama/pdflurah');
            // Route Depend Penduduk Pada Form Tambah Data
            Route::get(
                'getNama/{nik_pelapor}',
                function ($nik_pelapor) {
                    $nama = App\Models\Penduduk::where('nik', $nik_pelapor)->get();
                    return response()->json($nama);
                }
            );
            Route::post('/warga/surat-ket-beda-nama/lampiran/store/{nik}', 'lampiranStore')->name('warga/surat-ket-beda-nama/lampiran/store')->middleware('auth');
            Route::get('/warga/surat-ket-beda-nama/lampiran/edit/{nik}', 'lampiranEdit')->name('warga/surat-ket-beda-nama/lampiran/edit')->middleware('auth');
            Route::get('/warga/surat-ket-beda-nama/lampiran/update/{nik}', 'lampiranUpdate')->name('warga/surat-ket-beda-nama/lampiran/update')->middleware('auth');
            Route::get('/warga/surat-ket-beda-nama/lampiran/destroy/{nik}', 'lampiranDestroy')->name('warga/surat-ket-beda-nama/lampiran/destroy')->middleware('auth');
            Route::get('/warga/surat-ket-beda-nama/lampiran/show/{nik}', 'showLampiran')->name('warga/surat-ket-beda-nama/lampiran/show')->middleware('auth');
        }
    );

    Route::controller(WargaSuratKetStatusController::class)->group(
        function () {
            Route::get('/warga/surat-keterangan-status', 'index')->name('warga/surat-keterangan-status');
            Route::post('/warga/surat-keterangan-status/store', 'store')->name('warga/surat-keterangan-status/store');
            Route::post('/warga/surat-keterangan-status/{nik}', 'update')->name('warga/surat-keterangan-status/verif');
            Route::delete('/warga/surat-keterangan-status/delete/{nik}', 'destroy')->name('warga/surat-keterangan-status/delete');
            Route::get('/warga/surat-keterangan-status/pdf/{nik}', 'pdf')->name('warga/surat-keterangan-status/pdf');
            Route::get('/warga/surat-keterangan-status/pdf/lurah/{nik}', 'pdflurah')->name('warga/surat-keterangan-status/pdflurah');
            Route::post('/warga/surat-keterangan-status/lampiran/store/{nik}', 'lampiranStore')->name('warga/surat-keterangan-status/lampiran/store')->middleware('auth');
            Route::get('/warga/surat-keterangan-status/lampiran/edit/{nik}', 'lampiranEdit')->name('warga/surat-keterangan-status/lampiran/edit')->middleware('auth');
            Route::get('/warga/surat-keterangan-status/lampiran/update/{nik}', 'lampiranUpdate')->name('warga/surat-keterangan-status/lampiran/update')->middleware('auth');
            Route::get('/warga/surat-keterangan-status/lampiran/destroy/{nik}', 'lampiranDestroy')->name('warga/surat-keterangan-status/lampiran/destroy')->middleware('auth');
            Route::get('/warga/surat-keterangan-status/lampiran/show/{nik}', 'showLampiran')->name('warga/surat-keterangan-status/lampiran/show')->middleware('auth');
        }
    );

    Route::controller(WargaSuratKetBiasaController::class)->group(
        function () {
            Route::get('/warga/surat-keterangan-biasa', 'index')->name('warga/surat-keterangan-biasa');
            Route::post('/warga/surat-keterangan-biasa/store', 'store')->name('warga/surat-keterangan-biasa/store');
            Route::post('/warga/surat-keterangan-biasa/{nik}', 'update')->name('warga/surat-keterangan-biasa/verif');
            Route::delete('/warga/surat-keterangan-biasa/delete/{nik}', 'destroy')->name('warga/surat-keterangan-status/delete');
            Route::get('/warga/surat-keterangan-biasa/pdf/{nik}', 'pdf')->name('warga/surat-keterangan-biasa/pdf');
            Route::get('/warga/surat-keterangan-biasa/pdf/lurah/{nik}', 'pdflurah')->name('warga/surat-keterangan-biasa/pdflurah');
            Route::post('/warga/surat-keterangan-biasa/lampiran/store/{nik}', 'lampiranStore')->name('warga/surat-keterangan-biasa/lampiran/store')->middleware('auth');
            Route::get('/warga/surat-keterangan-biasa/lampiran/edit/{nik}', 'lampiranEdit')->name('warga/surat-keterangan-biasa/lampiran/edit')->middleware('auth');
            Route::get('/warga/surat-keterangan-biasa/lampiran/update/{nik}', 'lampiranUpdate')->name('warga/surat-keterangan-biasa/lampiran/update')->middleware('auth');
            Route::get('/warga/surat-keterangan-biasa/lampiran/destroy/{nik}', 'lampiranDestroy')->name('/warga/surat-keterangan-biasa/lampiran/destroy')->middleware('auth');
            Route::get('/warga/surat-keterangan-biasa/lampiran/show/{nik}', 'showLampiran')->name('warga/surat-keterangan-biasa/lampiran/show')->middleware('auth');
        }
    );

    Route::controller(WargaMutasiKeluarController::class)->group(
        function () {
            Route::get('/warga/data-mutasi-keluar', 'index')->name('warga/data-mutasi-keluar');
            Route::post('/warga/data-mutasi-keluar/store', 'store')->name('warga/data-mutasi-keluar/store');
            Route::post('/warga/data-mutasi-keluar/{nik_mk}', 'update')->name('warga/data-mutasi-keluar/verif');
            Route::delete('/warga/data-mutasi-keluar/delete/{nik_mk}', 'destroy')->name('warga/data-mutasi-keluar/delete');
            Route::get('/warga/data-mutasi-keluar/pdf/{nik_mk}', 'pdf')->name('warga/data-mutasi-keluar/pdf');
            Route::get('/warga/data-mutasi-keluar/pdf/lurah/{nik_mk}', 'pdflurah')->name('warga/data-mutasi-keluar/pdflurah');
            Route::post('/warga/data-mutasi-keluar/lampiran/store/{nik_mk}', 'lampiranStore')->name('warga/data-mutasi-keluar/lampiran/store')->middleware('auth');
            Route::get('/warga/data-mutasi-keluar/lampiran/edit/{nik_mk}', 'lampiranEdit')->name('warga/data-mutasi-keluar/lampiran/edit')->middleware('auth');
            Route::get('/warga/data-mutasi-keluar/lampiran/update/{nik_mk}', 'lampiranUpdate')->name('warga/data-mutasi-keluar/lampiran/update')->middleware('auth');
            Route::get('/warga/data-mutasi-keluar/lampiran/destroy/{nik_mk}', 'lampiranDestroy')->name('warga/data-mutasi-keluar/lampiran/destroy')->middleware('auth');
            Route::get('/warga/data-mutasi-keluar/lampiran/show/{nik_mk}', 'showLampiran')->name('warga/data-mutasi-keluar/lampiran/show')->middleware('auth');
        }
    );

    Route::controller(WargaMutasiMasukController::class)->group(
        function () {
            Route::get('/warga/data-mutasi-masuk', 'index')->name('warga/data-mutasi-masuk');
            Route::post('/warga/data-mutasi-masuk/store', 'store')->name('warga/data-mutasi-masuk/store');
            Route::post('/warga/data-mutasi-masuk/{nik}', 'update')->name('warga/data-mutasi-masuk/verif');
            Route::delete('/warga/data-mutasi-masuk/delete/{nik_mm}', 'destroy')->name('warga/data-mutasi-masuk/delete');
            Route::get('/warga/data-mutasi-masuk/pdf/{nik_mm}', 'pdf')->name('warga/data-mutasi-masuk/pdf');
            Route::get('/warga/data-mutasi-masuk/pdf/lurah/{nik_mm}', 'pdflurah')->name('warga/data-mutasi-masuk/pdflurah');
            // Route Depend Penduduk Pada Form Tambah Data
            Route::get(
                'getPelapor/{id}',
                function ($id) {
                    $nama_pelapor = App\Models\Penduduk::where('nik', $id)->get();
                    return response()->json($nama_pelapor);
                }
            );
            Route::post('/warga/data-mutasi-masuk/lampiran/store/{nik_mm}', 'lampiranStore')->name('warga/data-mutasi-masuk/lampiran/store')->middleware('auth');
            Route::get('/warga/data-mutasi-masuk/lampiran/edit/{nik_mm}', 'lampiranEdit')->name('warga/data-mutasi-masuk/lampiran/edit')->middleware('auth');
            Route::get('/warga/data-mutasi-masuk/lampiran/update/{nik_mm}', 'lampiranUpdate')->name('warga/data-mutasi-masuk/lampiran/update')->middleware('auth');
            Route::get('/warga/data-mutasi-masuk/lampiran/destroy/{nik_mm}', 'lampiranDestroy')->name('warga/data-mutasi-masuk/lampiran/destroy')->middleware('auth');
            Route::get('/warga/data-mutasi-masuk/lampiran/show/{nik_mm}', 'showLampiran')->name('warga/data-mutasi-masuk/lampiran/show')->middleware('auth');
        }
    );

    Route::controller(WargaMyAccountController::class)->group(function () {
        Route::get('Warga/myAcount', 'myAcount')->name('Warga/myAcount')->middleware('auth');
        Route::post('Update/Account/{id}', 'updateMyAcount')->name('Warga/Update/Account')->middleware('auth');
    });
});
