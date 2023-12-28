@extends('layouts.main_dashboard')


@section('title')
    Dashboard
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="mt-3">
        <h2>Aktifitas</h2>
        <hr>
        <table id="datatable" class="table table-hover table-bordered">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Aktifitas</th>
                    <th>Waktu</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($aktifitas as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->aktifitas }}</td>
                        <td>{{ $data->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
