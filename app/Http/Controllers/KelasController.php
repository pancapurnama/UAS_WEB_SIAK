<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = Kelas::orderBy('nama_kelas', 'asc')->get();
        $dosen = Dosen::orderBy('nama', 'asc')->get();
        return view('pages.admin.kelas.index', compact('kelas', 'dosen'));
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
            'nama_kelas' => 'required|unique:kelas',
            'dosen_id' => 'required'
        ], [
            'nama_kelas.unique' => 'Nama Kelas sudah ada',
        ]);

        Kelas::create($request->all());

        return redirect()->route('kelas.index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $id = Crypt::decrypt($id);
        $kelas = Kelas::findOrFail($id);
        $dosen = Dosen::all();
        return view('pages.admin.kelas.edit', compact('kelas', 'dosen'));
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
            'dosen_id' => 'required|unique:kelas'
        ], [
            'dosen_id.unique' => 'dosen sudah memiliki kelas'
        ]);

        $data = $request->all();
        $kelas = Kelas::findOrFail($id);
        $kelas->update($data);

        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kelas::find($id)->delete();
        return back()->with('success', 'Data kelas berhasil dihapus!');
    }
}
