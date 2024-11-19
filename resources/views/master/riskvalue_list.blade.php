@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Nilai Risiko</h2>
    <div class="row">
        <div class="text-center col-3">
            <a href="{{ route('riskvalue.add') }}" class="btn btn-outline-success mb-2">Tambah Nilai Risiko</a>
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
                <th style="width: 35%;">Risiko</th>
                <th style="width: 20%;">Nilai Risiko</th>
                <th style="width: 25%;">Level</th>
                <th style="width: 15%;">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($riskvalues as $key => $riskvalue)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $riskvalue->risk->nama_risiko ?? '-' }}</td>
                <td>{{ $riskvalue->nilai_risiko }}</td>
                <td>{{ ucfirst($riskvalue->level) }}</td>
                <td>
                    <a href="{{ route('riskvalue.edit', $riskvalue->id) }}" class="btn btn-warning" style="display:inline-block;">Edit</a>
                    <form action="{{ route('riskvalue.destroy', $riskvalue->id) }}" method="post" style="display:inline-block;">
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

<!-- Script Konfirmasi Hapus -->
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

