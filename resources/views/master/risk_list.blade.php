@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Risiko</h2>
    <div class="row ">
        <div class="text-center col-3"><a href="{{ route('risk.add') }}" class="btn btn-outline-success mb-2">Tambah Risiko</a></div>
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
                <th style="width: 4%;">No.</th>
                <th style="width: 17%;">Risiko</th>
                <th style="width: 22%;">Dampak</th>
                <th style="width: 14%;">Kategori Aset</th>
                <th style="width: 26%;">Current Control</th>
                <th style="width: 15%;">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($risk as $key => $risk)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $risk->nama_risiko }}</td>
                <td>{{ $risk->dampak }}</td>
                <td>{{ $risk->kategori_aset }}</td>
                <td>{{ $risk->current_control }}</td>
                <td>
                    <a href="{{ route('risk.edit', $risk->id) }}" class="btn btn-warning" style="display:inline-block;">Edit</a>
                    <form action="{{ route('risk.destroy', $risk->id) }}" method="post" style="display:inline-block;">
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
                var confirmation = confirm('Apakah Anda yakin ingin menghapus data ini?');

                if (confirmation) {
                    // Jika dikonfirmasi, kirim formulir delete
                    this.closest('form').submit();
                }
            });
        });
    });
</script>
@endsection
