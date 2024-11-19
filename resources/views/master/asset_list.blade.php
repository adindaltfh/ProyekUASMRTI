@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Aset</h2>
    <div class="row">
        <div class="text-center col-3">
            <a href="{{ route('asset.add') }}" class="btn btn-outline-success mb-2">Tambah Aset</a>
        </div>
        <div class="col-6"></div>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <table class="table" style="table-layout: fixed; width: 90%; margin: 0 auto;">
        <thead>
            <tr>
                <th style="width: 5%;">No.</th>
                <th style="width: 22%;">Kategori</th>
                <th style="width: 29%;">Aset</th>
                <th style="width: 29%;">Risiko Terkait</th>
                <th style="width: 15%;">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($assets as $key => $asset)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $asset->kategori }}</td>
                <td>{{ $asset->nama_aset }}</td>
                <td>{{ $asset->risk ? $asset->risk->nama_risiko : 'Tidak ada risiko' }}</td>
                <td>
                    <a href="{{ route('asset.edit', $asset->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('asset.destroy', $asset->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger delete-btn">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Tambahkan script JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var deleteButtons = document.querySelectorAll('.delete-btn');

        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                var confirmation = confirm('Apakah Anda yakin ingin menghapus aset ini?');

                if (confirmation) {
                    // Jika dikonfirmasi, kirim formulir delete
                    this.closest('form').submit();
                }
            });
        });
    });
</script>
@endsection
