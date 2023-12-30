@extends('layouts.main_dashboard')

@section('title')
    Tim
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('tim') }}">Tim</a></li>
            <li class="breadcrumb-item"><a href="{{ route('tim.create') }}">Create</a></li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="row p-3">
        <div class="">
            <a href="{{ route('tim') }}" class="btn btn-primary btn-custom"><i class="fa-solid fa-arrow-left"></i>
                Kembali</a>
        </div>
    </div>
@endsection
