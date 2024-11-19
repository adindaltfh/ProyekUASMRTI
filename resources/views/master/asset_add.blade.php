@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Form Input Aset</h2>
    <div class="row ">
        <div class="col-8"></div>
        <div class="col-4"><a href="{{ route('asset.show') }}" class="btn btn-outline-success">Kembali</a></div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="post" action="{{route('asset.store')}}">
                @csrf
                <div class="form-group mb-3">
                    <label for="nama">Nama Asset:</label>
                    <input type="text" class="form-control" id="nama" name="nama_aset" placeholder="Masukkan Nama Asset">
                </div>
                <div class="form-group mb-3">
                    <label for="kategori">Kategori:</label>
                    <select class="form-select" name="kategori">
                        <option value="data">Data</option>
                        <option value="software">Software</option>
                        <option value="network">Network</option>
                        <option value="hardware">Hardware</option>
                        <option value="sumber daya manusia">Sumber Daya Manusia</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="risiko">Risiko Terkait:</label>
                    <select class="form-select" name="risiko_terkait">
                        @foreach ($options2 as $option)
                            <option value="{{ $option->id }}">{{ $option->nama_risiko }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
