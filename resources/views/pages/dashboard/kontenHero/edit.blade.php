@extends('layouts.main_dashboard')

@section('title')
    Konten Hero
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('hero') }}">Konten Hero</a></li>
            <li class="breadcrumb-item"><a
                    href="{{ route('hero.edit', [$gambarHeroById->id_gambar_hero, $teksHeroById->id_teks_hero]) }}">Edit</a>
            </li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="row p-3">
        <div class="">
            <a href="{{ route('hero') }}" class="btn btn-primary btn-custom"><i class="fa-solid fa-arrow-left"></i>
                Kembali</a>
        </div>
    </div>

    <div class="row card p-4 mt-2">
        <form action="{{ route('hero') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row-container" data-row="1">
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="file_gambar_hero">Gambar Hero</label>
                    </div>
                    <div class="col-lg-4">
                        <input type="file" name="file_gambar_hero" id="file_gambar_hero_1"
                            class="form-control @error('file_gambar_hero') is-invalid @enderror"
                            value="{{ old('file_gambar_hero') }}" required>
                        @error('file_gambar_hero')
                            <i class="text-danger">{{ $message }}</i>
                        @enderror
                        <div class="mt-4">
                            <img id="gambar_preview_1" src="#" alt="Preview"
                                style="display: none; max-width: 100%; max-height: 200px;">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="status_gambar_hero">Status gambar hero</label>
                    </div>
                    <div class="col-lg-10">
                        <select name="status_gambar_hero[1]" id="status_gambar_hero_1"
                            class="form-control @error('status_gambar_hero') is-invalid @enderror" required>
                            <option value="1" {{ old('status_gambar_hero') == '1' ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('status_gambar_hero') == '0' ? 'selected' : '' }}>Tidak</option>
                        </select>
                        @error('status_gambar_hero')
                            <i class="text-danger">{{ $message }}</i>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="judul_teks_hero">Judul Hero</label>
                    </div>
                    <div class="col-lg-10">
                        <input type="text" name="judul_teks_hero" id="judul_teks_hero_1"
                            class="form-control @error('judul_teks_hero') is-invalid @enderror"
                            value="{{ old('judul_teks_hero') }}" placeholder="judul" required>
                        @error('judul_teks_hero')
                            <i class="text-danger">{{ $message }}</i>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="deskripsi_teks_hero">Deskripsi Hero</label>
                    </div>
                    <div class="col-lg-10">
                        <textarea name="deskripsi_teks_hero" id="deskripsi_teks_hero_1" cols="30" rows="5"
                            class="form-control @error('deskripsi_teks_hero') is-invalid @enderror" placeholder="deskripsi" required>{{ old('deskripsi_teks_hero') }}</textarea>
                        @error('deskripsi_teks_hero')
                            <i class="text-danger">{{ $message }}</i>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end mt-5 gap-3">
                <button type="submit" class="btn btn-success m-2">Simpan</button>
            </div>
        </form>
    </div>
@endsection
