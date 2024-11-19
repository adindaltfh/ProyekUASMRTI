@extends('layouts.main')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">Form Edit Risiko</h2>
        <div class="row ">
            <div class="col-8"></div>
            <div class="col-4"><a href="{{ route('risk.show') }}" class="btn btn-outline-success">Kembali</a></div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="post" action="{{ route('risk.update', $risk->id) }}">
                    @csrf
                    @method('PUT') {{-- karena Anda menggunakan metode update, gunakan method('PUT') --}}
                    <div class="form-group mb-3">
                        <label for="nama_risiko">Nama Risiko:</label>
                        <input type="text" class="form-control" id="nama_risiko" name="nama_risiko" value="{{ $risk->nama_risiko }}" placeholder="Masukkan Nama Risiko">
                    </div>
                    <div class="form-group mb-3">
                        <label for="dampak">Dampak:</label>
                        <input type="text" class="form-control" id="dampak" name="dampak" value="{{ $risk->dampak }}" placeholder="Masukkan Dampak">
                    </div>

                    <div class="form-group mb-3">
                        <label for="kategori_aset">Kategori Aset:</label>
                        <select class="form-control" id="kategori_aset" name="kategori_aset">
                            <option value="">Pilih Kategori Aset</option>
                            @foreach ($kategoriAsetOptions as $option)
                                <option value="{{ $option }}" {{ $risk->kategori_aset == $option ? 'selected' : '' }}>
                                    {{ $option }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group mb-3">
                        <label for="current_control">Kontrol Saat Ini:</label>
                        <input type="text" class="form-control" id="current_control" name="current_control" value="{{ $risk->current_control }}" placeholder="Masukkan Kontrol Saat Ini">
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>

@endsection