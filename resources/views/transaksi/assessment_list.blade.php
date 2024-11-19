@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Penilaian Risiko</h2>
    <div class="row">
        <div class="text-center col-3"><a href="{{ route('assessment.add') }}" class="btn btn-outline-success mb-2">Tambah Penilaian</a></div>
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
                <th style="width: 9%;">Tanggal</th>
                <th style="width: 13%;">User</th>
                <th style="width: 20%;">Nama Risiko</th>
                <th style="width: 7%;">Sev</th>
                <th style="width: 7%;">Occ</th>
                <th style="width: 7%;">Dec</th>
                <th style="width: 8%;">RPN</th>
                <th style="width: 10%;">Level</th>
                <th style="width: 15%;">Action</th>
            </tr>
        </thead>
        <tbody>
    @foreach ($assessment as $key => $assessment)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ \Carbon\Carbon::parse($assessment->tanggal_evaluasi)->format('d/m/y') }}</td>
            <td>{{ $assessment->user ? $assessment->user->name : 'Tidak ada user' }}</td> <!-- Periksa apakah ada user -->
            <td>{{ $assessment->risk->nama_risiko }}</td>
            <td>{{ $assessment->severity }}</td>
            <td>{{ $assessment->occurrence }}</td>
            <td>{{ $assessment->detection }}</td>
            <td>{{ $assessment->rpn }}</td>
            <td>{{ $assessment->level }}</td>
            <td>
                <a href="{{ route('assessment.edit', $assessment->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('assessment.destroy', $assessment->id) }}" method="post" style="display:inline-block;">
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
