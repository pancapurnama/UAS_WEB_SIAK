<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Materi;
use App\Models\Siswa;
use App\Models\Tugas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function admin()
    {
        $siswa = Siswa::count();
        $dosen = Dosen::count();
        $kelas = Kelas::count();
        $mapel = Mapel::count();
        $siswaBaru = Siswa::orderByDesc('id')->take(5)->orderBy('id')->first();

        return view('pages.admin.dashboard', compact('siswa', 'dosen', 'kelas', 'mapel', 'siswaBaru'));
    }

    public function dosen()
    {
        $dosen = Dosen::where('user_id', Auth::user()->id)->first();
        $materi = Materi::where('dosen_id', $dosen->id)->count();
        $jadwal = Jadwal::where('mapel_id', $dosen->mapel_id)->get();
        $tugas = Tugas::where('dosen_id', $dosen->id)->count();
        $hari = Carbon::now()->locale('id')->isoFormat('dddd');
        return view('pages.dosen.dashboard', compact('dosen', 'materi', 'jadwal', 'hari', 'tugas'));
    }

    public function siswa()
    {
        $siswa = Siswa::where('npm', Auth::user()->npm)->first();
        $kelas = Kelas::findOrFail($siswa->kelas_id);
        $materi = Materi::where('kelas_id', $kelas->id)->limit(3)->get();
        $tugas = Tugas::where('kelas_id', $kelas->id)->limit(3)->get();
        $jadwal = Jadwal::where('kelas_id', $kelas->id)->get();
        $hari = Carbon::now()->locale('id')->isoFormat('dddd');
        return view('pages.siswa.dashboard', compact('materi', 'siswa', 'kelas', 'tugas', 'jadwal', 'hari'));
    }
}
