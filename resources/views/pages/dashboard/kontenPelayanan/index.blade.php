@extends('layouts.main_dashboard')

@section('title')
    Konten Pelayanan
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('pelayanan') }}">Konten Pelayanan</a></li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="row p-3">
        <div class="d-flex justify-content-end">
            <a href="{{ route('pelayanan.create') }}" class="btn btn-primary btn-custom"><i class="fa-solid fa-plus"></i>
                Tambah</a>
        </div>
    </div>
    <p>Halaman Kelola Data Konten Pelayanan</p>
    <div class="row card p-3 mt-2 table-responsive">
        <table class="table table-bordered table-hover" id="datatable">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Aktor</th>
                    <th class="text-center">Judul</th>
                    <th class="text-center">Deskripsi Judul</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">___Opsi___</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pelayanan as $data)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $data['aktor'] }}</td>
                        <td class="text-center">{{ $data['judul_pelayanan'] }}</td>
                        <td class="text-center">{{ $data['deskripsi_judul_pelayanan'] }}</td>
                        <td class="text-center">
                            @if ($data['status_pelayanan'] == 1)
                                <span class="badge badge-success">Aktif</span>
                            @else
                                <span class="badge badge-danger">Tidak</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modalShow{{ $data['id_pelayanan'] }}">
                                <i class="fa-solid fa-eye"></i>
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="modalShow{{ $data['id_pelayanan'] }}" tabindex="-1"
                                aria-labelledby="modalShowLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-success text-white">

                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-lg-12">
                                                <h2 class="text-center">{{ $data['judul_pelayanan'] }}</h2>
                                                <p class="text-justify">{{ $data['deskripsi_judul_pelayanan'] }}</p>

                                            </div>
                                            <div class="row d-flex justify-content-center">
                                                @foreach ($cardPelayanan as $item)
                                                    <div class="col-4">
                                                        @if ($item->id_pelayanan == $data['id_pelayanan'])
                                                            <div class="card shadow">
                                                                <img src="{{ $item->file_gambar_card_pelayanan }}"
                                                                    alt="{{ $item->judul_card_pelayanan }}"
                                                                    class="img-card-top" style="all: initial; width:100%;">
                                                                <div class="card-body">
                                                                    <h5 class="text-center">
                                                                        {{ $item->judul_card_pelayanan }}</h5>

                                                                    <p class="text-justify">
                                                                        {{ $item->deskripsi_judul_card_pelayanan }}</p>
                                                                    <p class="text-justify">
                                                                        {{ $item->deskripsi_card_pelayanan }}</p>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success"
                                                data-bs-dismiss="modal">Close</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('pelayanan.edit', [$data['id_pelayanan'], $data['id_card_pelayanan']]) }}"
                                class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="{{ route('pelayanan.delete', [$data['id_pelayanan'], $data['id_card_pelayanan']]) }}"
                                onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                                class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
