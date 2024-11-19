@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Form Edit Aset</h2>
    <div class="row ">
        <div class="col-8"></div>
        <div class="col-4"><a href="{{ route('asset.show') }}" class="btn btn-outline-success">Kembali</a></div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="post" action="{{route('asset.update', $asset->id)}}">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="nama">Nama Aset:</label>
                    <input type="text" class="form-control" id="nama" name="nama_aset" value="{{ $asset->nama_aset }}">
                </div>
                <div class="form-group mb-3">
                    <label for="kategori">Kategori:</label>
                    <select class="form-select" name="kategori">
                        <option value="data" {{ $asset->kategori === 'data' ? 'selected' : '' }}>Data</option>
                        <option value="software" {{ $asset->kategori === 'software' ? 'selected' : '' }}>Software</option>
                        <option value="network" {{ $asset->kategori === 'network' ? 'selected' : '' }}>Network</option>
                        <option value="hardware" {{ $asset->kategori === 'hardware' ? 'selected' : '' }}>Hardware</option>
                        <option value="sumber daya manusia" {{ $asset->kategori === 'sumber daya manusia' ? 'selected' : '' }}>Sumber Daya Manusia</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="risiko">Risiko Terkait:</label>
                    <select class="form-select" name="risiko_terkait">
                        <option value="0" {{ $selectedRisk == 0 ? 'selected' : '' }}>Tidak ada risiko</option> <!-- Tambahkan opsi ini -->
                        @foreach ($options2 as $option)
                            <option value="{{ $option->id }}" {{ $option->id == $selectedRisk ? 'selected' : '' }}>{{ $option->nama_risiko }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <button type="submit" class="btn btn-primary float-right">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
