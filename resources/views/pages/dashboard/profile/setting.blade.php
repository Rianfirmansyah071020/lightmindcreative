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
        <div class="col-lg-7 card col-12 p-4">
            <form action="{{ route('SettingProfile', [$timById->id_tim, $akunById->id_user]) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row-container" data-row="1">
                    <div class="form-group row">
                        <div class="col-lg-2">
                            <label for="nama_tim">Nama</label>
                        </div>
                        <div class="col-lg-10">
                            <input type="text" name="nama_tim" id="nama_tim"
                                class="form-control @error('nama_tim') is-invalid @enderror"
                                value="{{ $timById->nama_tim ?? old('nama_tim') }}" placeholder="nama " required>
                            @error('nama_tim')
                                <i class="text-danger">{{ $message }}</i>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-2">
                            <label for="jenis_kelamin_tim">Jenis Kelamin</label>
                        </div>
                        <div class="col-lg-10">
                            <input type="radio" name="jenis_kelamin_tim" id="L" value="L"
                                @checked($timById->jenis_kelamin_tim == 'L')> laki-Laki <br>
                            <input type="radio" name="jenis_kelamin_tim" id="P" value="P"
                                @checked($timById->jenis_kelamin_tim == 'P')> Perempuan
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-2">
                            <label for="alamat_tim">Alamat</label>
                        </div>
                        <div class="col-lg-10">
                            <textarea name="alamat_tim" id="alamat_tim" cols="30" rows="5"
                                class="form-control @error('alamat_tim') is-invalid @enderror" placeholder="alamat" required>{{ $timById->alamat_tim ?? old('alamat_tim') }}</textarea>
                            @error('alamat_tim')
                                <i class="text-danger">{{ $message }}</i>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-2">
                            <label for="nomor_hp_tim">Nomor Hp</label>
                        </div>
                        <div class="col-lg-10">
                            <input type="text" name="nomor_hp_tim" id="nomor_hp_tim"
                                class="form-control @error('nomor_hp_tim') is-invalid @enderror"
                                value="{{ $timById->nomor_hp_tim ?? old('nomor_hp_tim') }}" placeholder="nomor hp "
                                required>
                            @error('nomor_hp_tim')
                                <i class="text-danger">{{ $message }}</i>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-2">
                            <label for="id_bidang_tim">Bidang</label>
                        </div>
                        <div class="col-lg-10">
                            <select name="id_bidang_tim" id="id_bidang_tim"
                                class="form-control js-example-basic-single @error('id_bidang_tim') is-invalid @enderror"
                                required style="height: 40px;">
                                <option value="">Pilih</option>
                                @foreach ($bidang as $data)
                                    <option value="{{ $data->id_bidang_tim }}" @selected($timById->id_bidang_tim == $data->id_bidang_tim)>
                                        {{ $data->nama_bidang_tim }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-2">
                            <label for="file_gambar_tim">Gambar Baru</label>
                        </div>
                        <div class="col-lg-10">
                            <input type="file" name="file_gambar_tim" id="file_gambar_tim"
                                class="form-control  @error('file_gambar_tim') is-invalid @enderror"
                                value="{{ old('file_gambar_tim') }}">
                            @error('file_gambar_tim')
                                <i class="text-danger">{{ $message }}</i>
                            @enderror
                            <div class="mt-4">
                                <img id="gambar_preview" src="#" alt="Preview"
                                    style="display: none; max-width: 100%; max-height: 200px;">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-2">
                            <label for="email">Email Akun</label>
                        </div>
                        <div class="col-lg-10">
                            <input type="email" name="email" id="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ $akunById->email ?? old('email') }}" placeholder="email " required>
                            @error('email')
                                <i class="text-danger">{{ $message }}</i>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-2">
                            <label for="password">Password Akun Baru</label>
                        </div>
                        <div class="col-lg-10">
                            <input type="text" name="password" id="password"
                                class="form-control @error('password') is-invalid @enderror"
                                value="{{ old('password') }}" placeholder="password ">
                            @error('password')
                                <i class="text-danger">{{ $message }}</i>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-5 gap-3">
                    <button type="submit" class="btn btn-success m-2">Simpan</button>
                </div>
            </form>

            <script>
                $(document).ready(function() {
                    // Add change event listener to the file input
                    $('#file_gambar_tim').change(function() {
                        readURL(this);
                    });

                    // Function to display the preview image
                    function readURL(input) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();

                            reader.onload = function(e) {
                                $('#gambar_preview').attr('src', e.target.result).show();
                            };

                            reader.readAsDataURL(input.files[0]);
                        }
                    }
                });
            </script>
        </div>
    </div>
@endsection
