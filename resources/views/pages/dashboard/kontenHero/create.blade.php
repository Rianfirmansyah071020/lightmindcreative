@extends('layouts.main_dashboard')

@section('title')
    Konten Hero
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('tentang') }}">Konten Hero</a></li>
            <li class="breadcrumb-item"><a href="{{ route('tentang.create') }}">Create</a></li>
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
        <form action="{{ route('tentang') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <div class="col-lg-2">
                    <label for="judul_tentang">Judul Tentang</label>
                </div>
                <div class="col-lg-10">
                    <input type="text" name="judul_tentang" id="judul_tentang"
                        class="form-control @error('judul_tentang') is-invalid @enderror" value="{{ old('judul_tentang') }}"
                        placeholder="judul" required>
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
                        class="form-control @error('deskripsi_judul_tentang') is-invalid @enderror" placeholder="deskripsi" required>{{ old('deskripsi_judul_tentang') }}</textarea>
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
                        class="form-control @error('deskripsi_tentang') is-invalid @enderror" placeholder="deskripsi" required>{{ old('deskripsi_tentang') }}</textarea>
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
                        <option value="1" {{ old('status_tentang') == '1' ? 'selected' : '' }}>Aktif
                        </option>
                        <option value="0" {{ old('status_tentang') == '0' ? 'selected' : '' }}>Tidak
                        </option>
                    </select>
                    @error('status_tentang')
                        <i class="text-danger">{{ $message }}</i>
                    @enderror
                </div>
            </div>
            <div class="row-container" data-row="1">
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="file_gambar_tentang">Gambar Tentang</label>
                    </div>
                    <div class="col-lg-4">
                        <input type="file" name="file_gambar_tentang[]" id="file_gambar_tentang_1"
                            class="form-control @error('file_gambar_tentang.1') is-invalid @enderror"
                            value="{{ old('file_gambar_tentang.1') }}" required>
                        @error('file_gambar_tentang.1')
                            <i class="text-danger">{{ $message }}</i>
                        @enderror
                        <div class="mt-4">
                            <img id="gambar_preview_1" src="#" alt="Preview"
                                style="display: none; max-width: 100%; max-height: 200px;">
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="javascript:void(0);" class="btn btn-danger removeRow">Hapus Baris</a>
                </div>
            </div>
            <div class="d-flex justify-content-end mt-5 gap-3">
                <a href="javascript:void(0);" class="btn btn-info m-2" id="addRow">Tambah Baris</a>
                <button type="submit" class="btn btn-success m-2">Simpan</button>
            </div>
        </form>

        <script>
            $(document).ready(function() {
                // Add Row
                $("#addRow").click(function() {
                    var lastRow = $(".row-container:last");
                    var newRow = lastRow.clone();
                    var newRowNumber = parseInt(lastRow.attr("data-row")) + 1;

                    // Update attributes and values
                    newRow.attr("data-row", newRowNumber);
                    newRow.find("input").val("");

                    // Generate unique IDs for new row elements
                    var fileInputId = "file_gambar_hero_" + newRowNumber;
                    var previewImageId = "gambar_preview_" + newRowNumber;

                    // Set new IDs for the file input, preview image, and status select
                    newRow.find("#file_gambar_hero_1").attr('id', fileInputId);
                    newRow.find("#gambar_preview_1").attr('id', previewImageId);

                    // Clear the status select in the new row


                    // Clear the gambar_preview for the new row
                    newRow.find("#" + previewImageId).attr('src', '').hide();

                    // Clear the input file for the new row
                    newRow.find("#" + fileInputId).val('');

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

                // Add change event listener to the file input in every row
                $(document).on("change", ".row-container input[type='file']", function() {
                    readURL(this);
                });

                // Function to display the preview image for each row
                function readURL(input) {
                    var rowContainer = $(input).closest(".row-container");

                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function(e) {
                            rowContainer.find('#gambar_preview_' + rowContainer.data("row")).attr('src', e.target
                                .result).show();
                        };

                        reader.readAsDataURL(input.files[0]);
                    }
                }
            });
        </script>
    @endsection
