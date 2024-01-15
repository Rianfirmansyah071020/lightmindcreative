@extends('layouts.main_dashboard')

@section('title')
    Konten Pelayanan
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('pelayanan') }}">Konten Pelayanan</a></li>
            <li class="breadcrumb-item"><a href="{{ route('pelayanan.create') }}">Create</a></li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="row p-3">
        <div class="">
            <a href="{{ route('pelayanan') }}" class="btn btn-primary btn-custom"><i class="fa-solid fa-arrow-left"></i>
                Kembali</a>
        </div>
    </div>

    <div class="row card p-4 mt-2">
        <form action="{{ route('pelayanan') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <div class="col-lg-2">
                    <label for="judul_pelayanan">Judul Pelayanan</label>
                </div>
                <div class="col-lg-10">
                    <input type="text" name="judul_pelayanan" id="judul_pelayanan"
                        class="form-control @error('judul_pelayanan') is-invalid @enderror"
                        value="{{ old('judul_pelayanan') }}" placeholder="judul" required>
                    @error('judul_pelayanan')
                        <i class="text-danger">{{ $message }}</i>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-2">
                    <label for="deskripsi_judul_pelayanan">Deskripsi Judul</label>
                </div>
                <div class="col-lg-10">
                    <textarea name="deskripsi_judul_pelayanan" id="deskripsi_judul_pelayanan" cols="30" rows="5"
                        class="form-control @error('deskripsi_judul_pelayanan') is-invalid @enderror" placeholder="deskripsi" required>{{ old('deskripsi_judul_pelayanan') }}</textarea>
                    @error('deskripsi_judul_pelayanan')
                        <i class="text-danger">{{ $message }}</i>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-2">
                    <label for="status_pelayanan">Status pelayanan</label>
                </div>
                <div class="col-lg-10">
                    <select name="status_pelayanan" id="status_pelayanan"
                        class="form-control @error('status_pelayanan') is-invalid @enderror" required>
                        <option value="1" {{ old('status_pelayanan') == '1' ? 'selected' : '' }}>Aktif
                        </option>
                        <option value="0" {{ old('status_pelayanan') == '0' ? 'selected' : '' }}>Tidak
                        </option>
                    </select>
                    @error('status_pelayanan')
                        <i class="text-danger">{{ $message }}</i>
                    @enderror
                </div>
            </div>

            <div id="row-container" data-row="1">
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="file_gambar_card_pelayanan_1">Gambar Card Pelayanan</label>
                    </div>
                    <div class="col-lg-4">
                        <input type="file" name="file_gambar_card_pelayanan[]" id="file_gambar_card_pelayanan_1"
                            class="form-control file-input" required>
                        <div class="mt-4">
                            <img class="gambar-preview" src="#" alt="Preview"
                                style="display: none; max-width: 100%; max-height: 200px;">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="judul_card_pelayanan">Judul Card Pelayanan</label>
                    </div>
                    <div class="col-lg-10">
                        <input type="text" name="judul_card_pelayanan[]" id="judul_card_pelayanan"
                            class="form-control @error('judul_card_pelayanan') is-invalid @enderror"
                            value="{{ old('judul_card_pelayanan') }}" placeholder="judul" required>
                        @error('judul_card_pelayanan')
                            <i class="text-danger">{{ $message }}</i>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="deskripsi_judul_card_pelayanan"> Deskripsi Judul Card Pelayanan</label>
                    </div>
                    <div class="col-lg-10">
                        <textarea name="deskripsi_judul_card_pelayanan[]" id="deskripsi_judul_card_pelayanan" cols="30" rows="5"
                            class="form-control @error('deskripsi_judul_card_pelayanan') is-invalid @enderror" placeholder="deskripsi" required>{{ old('deskripsi_judul_card_pelayanan') }}</textarea>
                        @error('deskripsi_judul_card_pelayanan')
                            <i class="text-danger">{{ $message }}</i>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="deskripsi_card_pelayanan"> Deskripsi Card Pelayanan</label>
                    </div>
                    <div class="col-lg-10">
                        <textarea name="deskripsi_card_pelayanan[]" id="deskripsi_card_pelayanan" cols="30" rows="5"
                            class="form-control @error('deskripsi_card_pelayanan') is-invalid @enderror" placeholder="deskripsi" required>{{ old('deskripsi_card_pelayanan') }}</textarea>
                        @error('deskripsi_card_pelayanan')
                            <i class="text-danger">{{ $message }}</i>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <!-- Tombol "Hapus Baris" hanya ditampilkan pada baris kedua dan seterusnya -->
                    <a href="javascript:void(0);" class="btn btn-danger removeRow" style="display: none;">Hapus Baris</a>
                </div>
            </div>

            <div class="d-flex justify-content-end mt-5 gap-3">
                <a href="javascript:void(0);" class="btn btn-info m-2" id="addRow">Tambah Baris</a>
                <button type="submit" class="btn btn-success m-2">Simpan</button>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            // Inisialisasi nomor baris
            let rowNum = 1;

            // Tambahkan baris input saat tombol "Tambah Baris" diklik
            $("#addRow").on("click", function() {
                rowNum++; // Tambahkan nomor baris
                let newRow = $("#row-container").clone(); // Salin baris input yang ada
                newRow.attr("data-row", rowNum); // Setel atribut data-row dengan nomor baris baru
                newRow.find(":input").val(""); // Setel nilai input menjadi kosong
                newRow.find(".gambar-preview").attr("src", "")
                    .hide(); // Setel gambar preview menjadi kosong dan sembunyikan
                newRow.find("input[type=file]").attr("id", "file_gambar_card_pelayanan_" +
                    rowNum); // Ubah ID input file
                newRow.find("input[type=text]").attr("id", "judul_card_pelayanan_" +
                    rowNum); // Ubah ID input text
                newRow.find("textarea").attr("id", "deskripsi_judul_card_pelayanan_" +
                    rowNum); // Ubah ID textarea

                // Tampilkan tombol "Hapus Baris" kecuali untuk baris pertama
                if (rowNum > 1) {
                    newRow.find(".removeRow").show();
                } else {
                    newRow.find(".removeRow").hide();
                }

                newRow.find(".removeRow").on("click", function() {
                    removeRow(this); // Panggil fungsi untuk menghapus baris
                });

                // Masukkan baris baru sebelum tombol "Tambah Baris"
                newRow.insertBefore($("#addRow").parent());

            });

            // Hapus baris saat tombol "Hapus Baris" pada baris tertentu diklik
            $(".removeRow").on("click", function() {
                removeRow(this); // Panggil fungsi untuk menghapus baris
            });

            // Fungsi untuk menghapus baris dengan penanganan jumlah minimum baris
            function removeRow(button) {
                let totalRows = $("#row-container").parent().children(".row").length; // Hitung total baris

                if (totalRows > 1) {
                    $(button).closest("#row-container").remove(); // Hapus baris jika lebih dari satu baris
                } else {
                    alert("Baris ini tidak dapat dihapus karena jumlah baris hanya satu.");
                }
            }
        });
    </script>
@endsection
