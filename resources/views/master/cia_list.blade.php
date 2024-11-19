@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Analisis CIA Aset</h2>
    <div class="row">
        <div class="text-center col-3">
            <a href="{{ route('cia.add') }}" class="btn btn-outline-success mb-2">Tambah CIA</a>
        </div>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <table class="table" style="width: 90%; margin: 0 auto;">
        <thead>
            <tr>
                <th style="width: 5%;">No.</th>
                <th style="width: 30%;">Kategori Aset</th>
                <th style="width: 10%;">C</th>
                <th style="width: 10%;">I</th>
                <th style="width: 10%;">A</th>
                <th style="width: 20%;">Nilai Aset</th>
                <th style="width: 15%;">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cia as $key => $cia)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $cia->kategori_aset_id }}</td>
                <td>{{ $cia->c }}</td>
                <td>{{ $cia->i }}</td>
                <td>{{ $cia->a }}</td>
                <td>{{ $cia->aset_value }}</td>
                <td>
                    <a href="{{ route('cia.edit', $cia->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('cia.destroy', $cia->id) }}" method="post" style="display:inline-block;">
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
