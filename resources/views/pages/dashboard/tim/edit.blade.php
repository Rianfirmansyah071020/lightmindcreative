@extends('layouts.main_dashboard')

@section('title')
    Tim
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('tim') }}">Tim</a></li>
            <li class="breadcrumb-item"><a href="{{ route('tim.edit', [$dataTim->id_tim, $dataUser->id_user]) }}">Edit</a>
            </li>
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

    <div class="row card p-4 mt-2">
        <form action="{{ route('tim') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row-container" data-row="1">
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="nama_tim">Nama</label>
                    </div>
                    <div class="col-lg-8">
                        <input type="text" name="nama_tim" id="nama_tim"
                            class="form-control @error('nama_tim') is-invalid @enderror"
                            value="{{ $dataTim->nama_tim ?? old('nama_tim') }}" placeholder="nama " required>
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
                            @checked($dataTim->jenis_kelamin_tim == 'L')> laki-Laki <br>
                        <input type="radio" name="jenis_kelamin_tim" id="P" value="P"
                            @checked($dataTim->jenis_kelamin_tim == 'P')> Perempuan
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="alamat_tim">Alamat</label>
                    </div>
                    <div class="col-lg-10">
                        <textarea name="alamat_tim" id="alamat_tim" cols="30" rows="5"
                            class="form-control @error('alamat_tim') is-invalid @enderror" placeholder="alamat" required>{{ $dataTim->alamat_tim ?? old('alamat_tim') }}</textarea>
                        @error('alamat_tim')
                            <i class="text-danger">{{ $message }}</i>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="nomor_hp_tim">Nomor Hp</label>
                    </div>
                    <div class="col-lg-5">
                        <input type="text" name="nomor_hp_tim" id="nomor_hp_tim"
                            class="form-control @error('nomor_hp_tim') is-invalid @enderror"
                            value="{{ $dataTim->nomor_hp_tim ?? old('nomor_hp_tim') }}" placeholder="nomor hp " required>
                        @error('nomor_hp_tim')
                            <i class="text-danger">{{ $message }}</i>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="status_tim">Status</label>
                    </div>
                    <div class="col-lg-10">
                        <input type="radio" name="status_tim" id="1" value="1" @checked($dataTim->status_tim == 1)>
                        Aktif <br>
                        <input type="radio" name="status_tim" id="0" value="0" @checked($dataTim->status_tim == 0)>
                        Tidak
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="id_bidang_tim">Bidang</label>
                    </div>
                    <div class="col-lg-10">
                        <select name="id_bidang_tim" id="id_bidang_tim"
                            class="form-control select2 @error('id_bidang_tim') is-invalid @enderror" required
                            style="height: 40px;">
                            <option value="">Pilih</option>
                            @foreach ($bidang as $data)
                                <option value="{{ $data->id_bidang_tim }}" @selected($dataTim->id_bidang_tim ?? old('id_bidang_tim') == $data->id_bidang_tim)>
                                    {{ $data->nama_bidang_tim }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="file_gambar_tim">Gambar Baru</label>
                    </div>
                    <div class="col-lg-4">
                        <input type="file" name="file_gambar_tim" id="file_gambar_tim"
                            class="form-control @error('file_gambar_tim') is-invalid @enderror"
                            value="{{ old('file_gambar_tim') }}" required>
                        @error('file_gambar_tim')
                            <i class="text-danger">{{ $message }}</i>
                        @enderror
                        <div class="mt-4">
                            <img id="gambar_preview" src="#" alt="Preview"
                                style="display: none; max-width: 100%; max-height: 200px;">
                        </div>
                        <div class="mt-4">
                            <p>Gambar lama</p>
                            <img src="{{ asset($dataTim->file_gambar_tim) }}" alt="Preview"
                                style=" max-width: 100%; max-height: 200px;">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="email">Email Akun</label>
                    </div>
                    <div class="col-lg-5">
                        <input type="email" name="email" id="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ $dataUser->email ?? old('email') }}" placeholder="email " required>
                        @error('email')
                            <i class="text-danger">{{ $message }}</i>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="password">Password Akun Baru</label>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" name="password" id="password"
                            class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}"
                            placeholder="password " required>
                        @error('password')
                            <i class="text-danger">{{ $message }}</i>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="level_user">Level Akun</label>
                    </div>
                    <div class="col-lg-10">
                        <input type="radio" name="level_user" id="1" value="1"
                            @checked($dataUser->level_user == 1)>
                        Admin <br>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="status_user">Status Akun</label>
                    </div>
                    <div class="col-lg-10">
                        <input type="radio" name="status_user" id="1" value="1"
                            @checked($dataUser->status_user == 1)>
                        Aktif <br>
                        <input type="radio" name="status_user" id="0" value="0"
                            @checked($dataUser->status_user == 0)>
                        Tidak
                    </div>
                </div>


            </div>
            <div class="d-flex justify-content-end mt-5 gap-3">
                <button type="submit" class="btn btn-success m-2">Simpan</button>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            console.log("ready");
            $('.select2').select2();
        })
    </script>

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

    {{-- <script>
        $(document).ready(function() {
            // Add Row
            $("#addRow").click(function() {
                var lastRow = $(".row-container:last");
                var newRow = lastRow.clone();
                var newRowNumber = parseInt(lastRow.attr("data-row")) + 1;

                // Update attributes and values
                newRow.attr("data-row", newRowNumber);
                newRow.find("input, textarea").val("");

                // Clear the radio button selection in the new row
                newRow.find("input[type='radio']").prop('checked', false);

                // Clear the gambar_preview for the new row
                newRow.find("#gambar_preview").attr('src', '').hide();

                // Clear the input file for the new row
                newRow.find("#file_gambar_tim").val('');

                // Reset the <select> options for the new row
                // newRow.find("select").val('');
                // newRow.find("select option:first").prop("selected",
                //     true); // Set the first option as selected

                // Append the new row
                lastRow.after(newRow);

                updateRemoveButtonVisibility(); // Update remove button visibility
            });

            // Remove Row
            $(document).on("click", ".removeRow", function() {
                var rowContainer = $(this).closest(".row-container");

                if ($(".row-container").length > 1) {
                    rowContainer.remove();
                    updateRemoveButtonVisibility(); // Update remove button visibility
                } else {
                    alert("Minimal harus ada satu baris input.");
                }
            });

            // Function to update remove button visibility
            function updateRemoveButtonVisibility() {
                $(".removeRow").toggle($(".row-container").length > 1);
            }
        });
    </script> --}}
@endsection
