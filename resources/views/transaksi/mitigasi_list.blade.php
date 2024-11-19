@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Mitigasi Risiko</h2>
    <div class="row ">
        <div class="text-center col-3"><a href="{{ route('mitigasi.add') }}" class="btn btn-outline-success mb-2">Tambah Mitigasi</a></div>
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
            <th style="width: 15%;">Aset</th>
            <th style="width: 15%;">Risiko</th>
            <th style="width: 8%;">Klausul</th>
            <th style="width: 34%;">Mitigasi Risiko</th>
            <th style="width: 15%;">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($mitigasiRisiko as $key => $mitigasi)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ \Carbon\Carbon::parse($mitigasi->tanggal)->format('d/m/y') }}</td>
            <td>{{ $mitigasi->asset_id ? $mitigasi->asset->nama_aset : 'Tidak Ada Aset' }}</td>
            <td>{{ $mitigasi->risk->nama_risiko }}</td>
            <td>{{ $mitigasi->klausul }}</td>
            <td style="word-wrap: break-word; overflow-wrap: break-word; white-space: normal; max-width: 200px;">
                {{ $mitigasi->mitigasi_risiko }}
            </td>
            <td>
                <a href="{{ route('mitigasi.edit', $mitigasi->id) }}" class="btn btn-warning" style="display:inline-block;">Edit</a>
                <form action="{{ route('mitigasi.destroy', $mitigasi->id) }}" method="post" style="display:inline-block;">
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
