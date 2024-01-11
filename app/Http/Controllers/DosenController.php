<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mapel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mapel = Mapel::orderBy('nama_mapel', 'asc')->get();
        $dosen = Dosen::orderBy('nama', 'asc')->get();
        return view('pages.admin.dosen.index', compact('dosen', 'mapel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'nama' => 'required',
            'nip' => 'required|unique:dosens',
            'no_telp' => 'required',
            'alamat' => 'required',
            'mapel_id' => 'required',
        ], [
            'nip.unique' => 'NIP sudah terdaftar',
        ]);


        $dosen = new Dosen;
        $dosen->nama = $request->nama;
        $dosen->nip = $request->nip;
        $dosen->no_telp = $request->no_telp;
        $dosen->alamat = $request->alamat;
        $dosen->mapel_id = $request->mapel_id;
        $dosen->save();


        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = Crypt::decrypt($id);
        $dosen = Dosen::findOrFail($id);

        return view('pages.admin.dosen.profile', compact('dosen'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $mapel = Mapel::all();
        $dosen = Dosen::findOrFail($id);

        return view('pages.admin.dosen.edit', compact('dosen', 'mapel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nip' => 'required|unique:dosens'
        ], [
            'nip.unique' => 'NIP sudah terdaftar',
        ]);

        $dosen = Dosen::find($id);
        $dosen->nama = $request->input('nama');
        $dosen->nip = $request->input('nip');
        $dosen->no_telp = $request->input('no_telp');
        $dosen->alamat = $request->input('alamat');
        $dosen->mapel_id = $request->input('mapel_id');


        $dosen->update();

        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dosen = Dosen::find($id);
        $dosen->delete();

        // Hapus data user
        if($user = User::where('id', $dosen->user_id)->first()){
            $user->delete();
        }

        return back()->with('success', 'Data mapel berhasil dihapus!');
    }
}
