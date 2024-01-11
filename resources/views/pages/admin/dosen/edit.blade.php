@extends('layouts.main')

@section('title', 'Edit dosen')

@section('content')
<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible show fade">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                        @foreach ($errors->all() as $error )
                        {{ $error }}
                        @endforeach
                    </div>
                </div>
                @endif
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Edit dosen {{ $dosen->nama }}</h4>
                        <a href="{{ route('dosen.index') }}" class="btn btn-primary">Kembali</a>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('dosen.update', $dosen->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <div class="input-group">

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama dosen</label>
                                <input type="text" id="nama" name="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="{{ __('Nama dosen') }}" value="{{ $dosen->nama }}">
                            </div>
                            <div class="d-flex">
                                <div class="form-group">
                                    <label for="nip">NIP</label>
                                    <input type="text" id="nip" name="nip" class="form-control @error('nip') is-invalid @enderror" placeholder="{{ __('NIP dosen') }}" value="{{ $dosen->nip }}">
                                </div>
                                <div class="form-group ml-4">
                                    <label for="no_telp">No. Telp</label>
                                    <input type="text" id="no_telp" name="no_telp" class="form-control @error('no_telp') is-invalid @enderror" placeholder="{{ __('No. TElp dosen') }}" value="{{ $dosen->no_telp }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Textarea</label>
                                <textarea id="alamat" name="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="{{ __('Alamat') }}">{{ $dosen->alamat }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="mapel_id">Mata Pelajaran</label>
                                <select id="mapel_id" name="mapel_id" class="select2bs4 form-control @error('mapel_id') is-invalid @enderror">
                                    <option value="">-- Pilih Mapel --</option>
                                    @foreach ($mapel as $data )
                                    <option value="{{ $data->id }}" @if ($dosen->mapel_id == $data->id)
                                        selected
                                        @endif
                                        >{{ $data->nama_mapel }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp; Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
