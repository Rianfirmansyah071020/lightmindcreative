@extends('layouts.main_dashboard')

@section('title')
    Bidang
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('bidang') }}">Bidang</a></li>
            <li class="breadcrumb-item"><a href="{{ route('bidang.create') }}">Create</a></li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="row p-3">
        <div class="">
            <a href="{{ route('bidang') }}" class="btn btn-primary btn-custom"><i class="fa-solid fa-arrow-left"></i>
                Kembali</a>
        </div>
    </div>
    <div class="row card p-4 mt-2">
        <form action="{{ route('bidang') }}" method="post">
            @csrf
            <div class="row-container" data-row="1">
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="nama_bidang_tim">Nama Bidang</label>
                    </div>
                    <div class="col-lg-8">
                        <input type="text" name="nama_bidang_tim[]" id="nama_bidang_tim"
                            class="form-control @error('nama_bidang_tim') is-invalid @enderror"
                            value="{{ old('nama_bidang_tim') }}" placeholder="nama bidang">
                        @error('nama_bidang_tim')
                            <i class="text-danger">{{ $message }}</i>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="nama_bidang_tim">Deskripsi Bidang</label>
                    </div>
                    <div class="col-lg-10">
                        <textarea name="deskripsi_bidang_tim[]" id="deskripsi_bidang_tim" cols="30" rows="5"
                            class="form-control @error('deskripsi_bidang_tim') is-invalid @enderror" placeholder="deskripsi bidang">{{ old('deskripsi_bidang_tim') }}</textarea>
                        @error('deskripsi_bidang_tim')
                            <i class="text-danger">{{ $message }}</i>
                        @enderror
                    </div>
                </div>
                <div class=" d-flex justify-content-end">
                    <a href="javascript:void(0);" class="btn btn-danger removeRow">Hapus Baris</a>
                </div>
            </div>
            <div class="d-flex justify-content-end mt-5 gap-3">
                <a href="javascript:void(0);" class="btn btn-info m-2" id="addRow">Tambah Baris</a>
                <button type="submit" class="btn btn-success m-2">Simpan</button>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            // Add Row
            $("#addRow").click(function() {
                var lastRow = $(".row-container:last");
                var newRow = lastRow.clone();
                var newRowNumber = parseInt(lastRow.attr("data-row")) + 1;

                // Update attributes and values
                newRow.attr("data-row", newRowNumber);
                newRow.find("input, textarea").val(""); // Clear input values
                newRow.find("[name='nama_bidang_tim[]']").attr("id", "nama_bidang_tim_" + newRowNumber);
                newRow.find("[name='deskripsi_bidang_tim[]']").attr("id", "deskripsi_bidang_tim_" +
                    newRowNumber);

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
    </script>
@endsection
