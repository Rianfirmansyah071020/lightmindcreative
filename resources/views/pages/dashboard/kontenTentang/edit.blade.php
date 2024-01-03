@extends('layouts.main_dashboard')

@section('title')
    Konten Hero
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('hero') }}">Konten Hero</a></li>
            <li class="breadcrumb-item"><a
                    href="{{ route('hero.edit', [$gambarHeroById->id_gambar_hero, $teksHeroById->id_teks_hero]) }}">Edit</a>
            </li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="row p-3">
        <div class="">
            <a href="{{ route('hero') }}" class="btn btn-primary btn-custom"><i class="fa-solid fa-arrow-left"></i>
                Kembali</a>
        </div>
    </div>

    <div class="row card p-4 mt-2">
        <form action="{{ route('hero.update', [$gambarHeroById->id_gambar_hero, $teksHeroById->id_teks_hero]) }}"
            method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row-container" data-row="1">
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="file_gambar_hero">Gambar Hero Baru</label>
                    </div>
                    <div class="col-lg-4">
                        <input type="file" name="file_gambar_hero" id="file_gambar_hero_1"
                            class="form-control @error('file_gambar_hero') is-invalid @enderror"
                            value="{{ $gambarHeroById->file_gambar_hero ?? old('file_gambar_hero') }}">
                        @error('file_gambar_hero')
                            <i class="text-danger">{{ $message }}</i>
                        @enderror
                        <div class="mt-4">
                            <img id="gambar_preview_1" src="#" alt="Preview"
                                style="display: none; max-width: 100%; max-height: 200px;">
                        </div>

                        <div class="mt-4">
                            <p>Gambar Hero Lama</p>
                            <img src="{{ asset($gambarHeroById->file_gambar_hero) }}" alt="" style="width: 200px;">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="status_gambar_hero">Status gambar hero</label>
                    </div>
                    <div class="col-lg-10">
                        <select name="status_gambar_hero" id="status_gambar_hero_1"
                            class="form-control @error('status_gambar_hero') is-invalid @enderror" required>
                            <option value="1" {{ $gambarHeroById->status_gambar_hero == 1 ? 'selected' : '' }}>
                                Aktif</option>
                            <option value="0" {{ $gambarHeroById->status_gambar_hero == 0 ? 'selected' : '' }}>
                                Tidak</option>
                        </select>
                        @error('status_gambar_hero')
                            <i class="text-danger">{{ $message }}</i>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="judul_teks_hero">Judul Hero</label>
                    </div>
                    <div class="col-lg-10">
                        <input type="text" name="judul_teks_hero" id="judul_teks_hero_1"
                            class="form-control @error('judul_teks_hero') is-invalid @enderror"
                            value="{{ $teksHeroById->judul_teks_hero ?? old('judul_teks_hero') }}" placeholder="judul"
                            required>
                        @error('judul_teks_hero')
                            <i class="text-danger">{{ $message }}</i>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="deskripsi_teks_hero">Deskripsi Hero</label>
                    </div>
                    <div class="col-lg-10">
                        <textarea name="deskripsi_teks_hero" id="deskripsi_teks_hero_1" cols="30" rows="5"
                            class="form-control @error('deskripsi_teks_hero') is-invalid @enderror" placeholder="deskripsi" required>{{ $teksHeroById->deskripsi_teks_hero ?? old('deskripsi_teks_hero') }}</textarea>
                        @error('deskripsi_teks_hero')
                            <i class="text-danger">{{ $message }}</i>
                        @enderror
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
            // Add Row
            $("#addRow").click(function() {
                var lastRow = $(".row-container:last");
                var newRow = lastRow.clone();
                var newRowNumber = parseInt(lastRow.attr("data-row")) + 1;

                // Update attributes and values
                newRow.attr("data-row", newRowNumber);
                newRow.find("input, textarea").val("");

                // Generate unique IDs for new row elements
                var fileInputId = "file_gambar_hero_" + newRowNumber;
                var previewImageId = "gambar_preview_" + newRowNumber;
                var statusSelectId = "status_gambar_hero_" + newRowNumber;
                var judulId = "judul_teks_hero_" + newRowNumber;
                var deskripsiId = "deskripsi_teks_hero_" + newRowNumber;

                // Set new IDs for the file input, preview image, and status select
                newRow.find("#file_gambar_hero_1").attr('id', fileInputId);
                newRow.find("#gambar_preview_1").attr('id', previewImageId);
                newRow.find("#status_gambar_hero_1").attr('name', 'status_gambar_hero[' + newRowNumber +
                    ']').attr('id', statusSelectId);
                newRow.find("#judul_teks_hero_1").attr('id', judulId);
                newRow.find("#deskripsi_teks_hero_1").attr('id', deskripsiId);

                // Clear the status select in the new row
                newRow.find("#" + statusSelectId).val('');

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
