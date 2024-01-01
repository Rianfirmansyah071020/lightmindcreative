@extends('layouts.main_dashboard')

@section('title')
    Profile
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('profile') }}">Profile</a></li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="row p-3">
        <div class="">
            <a href="{{ route('dashboard') }}" class="btn btn-primary btn-custom"><i class="fa-solid fa-arrow-left"></i>
                Kembali</a>
        </div>
    </div>

    <div class="row gap-2">
        <div class="col-lg-4 col-12 card p-1">
            <div class="card-body">
                <img src="{{ asset($timById->file_gambar_tim) }}" alt="{{ $timById->nama_tim }}" style="width: 95%;">
            </div>
        </div>
        <div class="col-lg-7 card col-12 p-3">
            <table class="table table-bordered">
                <tr>
                    <td class="text-start">Nama</td>
                    <td class="text-start"> {{ $timById->nama_tim }}</td>
                </tr>
                <tr>
                    <td class="text-start">Jenis Kelamin</td>
                    <td class="text-start"> {{ $timById->jenis_kelamin_tim }}</td>
                </tr>
                <tr>
                    <td class="text-start">Alamat</td>
                    <td class="text-start"> {{ $timById->alamat_tim }}</td>
                </tr>
                <tr>
                    <td class="text-start">Bidang</td>
                    <td class="text-start"> {{ $timById->nama_bidang_tim }}</td>
                </tr>
                <tr>
                    <td class="text-start">Deskripsi Bidang</td>
                    <td class="text-start"> {{ $timById->deskripsi_bidang_tim }}</td>
                    </td>
                </tr>
                <tr>
                    <td class="text-start">Email</td>
                    <td class="text-start"> {{ $akunById->email }}</td>
                </tr>
                <tr>
                    <td class="text-start">Level Akun</td>
                    <td class="text-start"> {{ $akunById->level_user }}</td>
                </tr>
            </table>
            <div class="mt-5 d-flex justify-content-end ">
                <a href="{{ route('setting') }}" class="btn btn-success">Setting <i class="fa-solid fa-gear"></i></a>
            </div>
        </div>
    </div>
@endsection
