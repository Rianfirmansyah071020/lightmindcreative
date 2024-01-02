@extends('layouts.main_dashboard')

@section('title')
    Konten Hero
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('hero') }}">Konten Hero</a></li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="row p-3">
        <div class="d-flex justify-content-end">
            <a href="{{ route('hero.create') }}" class="btn btn-primary btn-custom"><i class="fa-solid fa-plus"></i>
                Tambah</a>
        </div>
    </div>
    <p>Halaman Kelola Data Konten Hero</p>
    <div class="row card p-3 mt-2 table-responsive">
        <table class="table table-bordered table-hover" id="datatable">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Aktor</th>
                    <th class="text-center">Status Gambar</th>
                    <th class="text-center">Judul Teks Hero</th>
                    <th class="text-center">Deskripsi Teks Hero</th>
                    <th class="text-center">___Opsi___</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hero as $data)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $data['aktor'] }}</td>
                        <td class="text-center">
                            @if ($data['status_gambar_hero'] == 1)
                                <span class="badge badge-success">Aktif</span>
                            @else
                                <span class="badge badge-danger">Tidak</span>
                            @endif
                        </td>
                        <td class="text-center">{{ $data['judul_teks_hero'] }}</td>
                        <td class="text-center">{{ $data['deskripsi_teks_hero'] }}</td>
                        <td class="text-center">
                            <a href="{{ route('hero.edit', [$data['id_gambar_hero'], $data['id_teks_hero']]) }}"
                                class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="{{ route('hero.delete', [$data['id_gambar_hero'], $data['id_teks_hero']]) }}"
                                onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                                class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
