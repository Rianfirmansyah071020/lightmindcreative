@extends('layouts.main_dashboard')

@section('title')
    Bidang
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('bidang') }}">Bidang</a></li>
            <li class="breadcrumb-item"><a href="{{ route('bidang.edit', $data->id_bidang_tim) }}">Edit</a></li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="row p-3">
        <div class="">
            <a href="{{ route('bidang') }}" class="btn btn-primary btn-custom"><i class="fa-solid fa-arrow-left"></i>
                Kembali</a>
        </div>
    </div>
    <div class="row card p-4 mt-2">
        <form action="{{ route('bidang.update', $data->id_bidang_tim) }}" method="post">
            @csrf
            @method('PUT')
            <div class="row-container" data-row="1">
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="nama_bidang_tim">Nama Bidang</label>
                    </div>
                    <div class="col-lg-8">
                        <input type="text" name="nama_bidang_tim" id="nama_bidang_tim"
                            class="form-control @error('nama_bidang_tim') is-invalid @enderror"
                            value="{{ $data->nama_bidang_tim ?? old('nama_bidang_tim') }}" placeholder="nama bidang"
                            required>
                        @error('nama_bidang_tim')
                            <i class="text-danger">{{ $message }}</i>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="nama_bidang_tim">Deskripsi Bidang</label>
                    </div>
                    <div class="col-lg-10">
                        <textarea name="deskripsi_bidang_tim" id="deskripsi_bidang_tim" cols="30" rows="5"
                            class="form-control @error('deskripsi_bidang_tim') is-invalid @enderror" placeholder="deskripsi bidang" required>{{ $data->deskripsi_bidang_tim ?? old('deskripsi_bidang_tim') }}</textarea>
                        @error('deskripsi_bidang_tim')
                            <i class="text-danger">{{ $message }}</i>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end mt-5 gap-3">
                <button type="submit" class="btn btn-success m-2">Update</button>
            </div>
        </form>
    </div>
@endsection
