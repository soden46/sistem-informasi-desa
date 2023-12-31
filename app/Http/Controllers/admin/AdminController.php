<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DataKematian;
use App\Models\MutasiKeluar;
use App\Models\MutasiMAsuk;
use App\Models\Penduduk;
use App\Models\ProfilDesa;
use App\Models\SuratKetKelahiran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view('AdminDashboard.index', [
            'title' => 'Dashboard',
            'jumlahLahir' => SuratKetKelahiran::all()->count(),
            'jumlahMasyarakat' => Penduduk::where('sts_penduduk', 'Hidup')->count(),
            'jumlahMati' => DataKematian::all()->count(),
            'jumlahMM' => MutasiMAsuk::all()->count(),
            'jumlahMK' => MutasiKeluar::all()->count(),
        ]);
    }
}
