@extends('layouts.main_dashboard')

@section('title')
    Konten Tentang
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('tentang') }}">Konten Tentang</a></li>
            <li class="breadcrumb-item"><a
                    href="{{ route('tentang.edit', [$tentang->id_tentang, $gambar_tentang->id_gambar_tentang]) }}">Tentang</a>
            </li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="row p-3">
        <div class="">
            <a href="{{ route('tentang') }}" class="btn btn-primary btn-custom"><i class="fa-solid fa-arrow-left"></i>
                Kembali</a>
        </div>
    </div>

    <div class="row card p-4 mt-2">
        <form action="{{ route('tentang.update', [$tentang->id_tentang, $gambar_tentang->id_gambar_tentang]) }}"
            method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group row">
                <div class="col-lg-2">
                    <label for="judul_tentang">Judul Tentang</label>
                </div>
                <div class="col-lg-10">
                    <input type="text" name="judul_tentang" id="judul_tentang"
                        class="form-control @error('judul_tentang') is-invalid @enderror"
                        value="{{ $tentang->judul_tentang ?? old('judul_tentang') }}" placeholder="judul" required>
                    @error('judul_tentang')
                        <i class="text-danger">{{ $message }}</i>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-2">
                    <label for="deskripsi_judul_tentang">Deskripsi Judul</label>
                </div>
                <div class="col-lg-10">
                    <textarea name="deskripsi_judul_tentang" id="deskripsi_judul_tentang" cols="30" rows="5"
                        class="form-control @error('deskripsi_judul_tentang') is-invalid @enderror" placeholder="deskripsi" required>{{ $tentang->deskripsi_judul_tentang ?? old('deskripsi_judul_tentang') }}</textarea>
                    @error('deskripsi_judul_tentang')
                        <i class="text-danger">{{ $message }}</i>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-2">
                    <label for="deskripsi_tentang">Deskripsi Tentang</label>
                </div>
                <div class="col-lg-10">
                    <textarea name="deskripsi_tentang" id="deskripsi_tentang" cols="30" rows="5"
                        class="form-control @error('deskripsi_tentang') is-invalid @enderror" placeholder="deskripsi" required>{{ $tentang->deskripsi_tentang ?? old('deskripsi_tentang') }}</textarea>
                    @error('deskripsi_tentang')
                        <i class="text-danger">{{ $message }}</i>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-2">
                    <label for="status_tentang">Status tentang</label>
                </div>
                <div class="col-lg-10">
                    <select name="status_tentang" id="status_tentang"
                        class="form-control @error('status_tentang') is-invalid @enderror" required>
                        <option value="1" {{ $tentang->status_tentang == '1' ? 'selected' : '' }}>Aktif
                        </option>
                        <option value="0" {{ $tentang->status_tentang == '0' ? 'selected' : '' }}>Tidak
                        </option>
                    </select>
                    @error('status_tentang')
                        <i class="text-danger">{{ $message }}</i>
                    @enderror
                </div>
            </div>

            <div id="row-container" data-row="1">
                @foreach ($gambar_tentang_all as $item)
                    <div class="form-group row">
                        <div class="col-lg-2">
                            <label for="file_gambar_tentang_1">Gambar Tentang</label>
                        </div>
                        <div class="col-lg-4">
                            <input type="hidden" name="id_gambar_tentang[]" value="{{ $item->id_gambar_tentang }}">
                            <input type="file" name="file_gambar_tentang[]" id="file_gambar_tentang_1"
                                class="form-control file-input">
                            <p>Gambar Lama</p>
                            <img src="{{ asset($item->file_gambar_tentang) }}" alt=""
                                style="max-width: 100%; max-height: 200px;">
                            <div class="mt-4">
                                <p>Gambar Baru</p>
                                <img class="gambar-preview" src="#" alt="Preview"
                                    style="display: none; max-width: 100%; max-height: 200px;">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-end mt-5 gap-3">
                <button type="submit" class="btn btn-success m-2">Simpan</button>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $("#addRow").click(function() {
                var lastRow = $("#row-container .form-group.row:last");
                var newRow = lastRow.clone();
                var newRowNumber = parseInt(lastRow.find('input[type="file"]').attr("id").split("_")
                    .pop()) + 1;

                newRow.find('input[type="file"]').attr('id', 'file_gambar_tentang_' + newRowNumber);
                newRow.find('.gambar-preview').attr('id', 'gambar_preview_' + newRowNumber).attr('src', '')
                    .hide();

                newRow.find('input[type="file"]').val('');
                newRow.find('.file-input').on('change', function() {
                    readURL(this);
                });

                newRow.find(".removeRow").on("click", function() {
                    newRow.remove();
                });

                $("#row-container").append(newRow);
            });

            function readURL(input) {
                var rowContainer = $(input).closest(".form-group.row");
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        rowContainer.find('.gambar-preview').attr('src', e.target.result).show();
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $(document).on("change", ".file-input", function() {
                readURL(this);
            });

            $(".removeRow").on("click", function() {
                var rowContainer = $(this).closest(".form-group.row");
                if ($("#row-container .form-group.row").length > 1) {
                    rowContainer.remove();
                } else {
                    alert("Minimal harus ada satu baris input.");
                }
            });
        });
    </script>
@endsection
