@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Edit Mitigasi</h2>
    <div class="row ">
        <div class="col-8"></div>
        <div class="col-4"><a href="{{ route('mitigasi.show') }}" class="btn btn-outline-success">Kembali</a></div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="post" action="{{ route('mitigasi.update', $mitigasi->id) }}">
                @csrf
                @method('PUT')
                
                <!-- Field Tanggal -->
                <div class="form-group mb-3">
                    <label for="tanggal">Tanggal:</label>
                    <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', $mitigasi->tanggal) }}">
                </div>

                <!-- Field Nama Aset -->
                <div class="form-group mb-3">
                    <label for="asset_id">Nama Aset:</label>
                    <select class="form-select" name="asset_id">
                    <option value="">Tidak Ada Aset</option>
                        @foreach ($assets as $asset)
                            <option value="{{ $asset->id }}" {{ $mitigasi->asset_id == $asset->id ? 'selected' : '' }}>
                                {{ $asset->nama_aset }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Field Risiko -->
                <div class="form-group mb-3">
                    <label for="risk_id">Risiko:</label>
                    <select class="form-select" name="risk_id">
                        @foreach ($risks as $risk)
                            <option value="{{ $risk->id }}" {{ $mitigasi->risk_id == $risk->id ? 'selected' : '' }}>
                                {{ $risk->nama_risiko }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Field Klausul dengan Select2 -->
                <div class="form-group mb-3">
                    <label for="klausul">Klausul:</label>
                    <select class="form-select klausul-select2" name="klausul">
                        <option value="A.5.1.1" {{ $mitigasi->klausul == 'A.5.1.1' ? 'selected' : '' }}>A.5.1.1 Kebijakan keamanan informasi</option>
                        <option value="A.5.1.2" {{ $mitigasi->klausul == 'A.5.1.2' ? 'selected' : '' }}>A.5.1.2 Tinjauan kebijakan keamanan informasi</option>
                        <option value="A.6.1.1" {{ $mitigasi->klausul == 'A.6.1.1' ? 'selected' : '' }}>A.6.1.1 Peran dan tanggung jawab keamanan informasi</option>
                        <option value="A.6.1.2" {{ $mitigasi->klausul == 'A.6.1.2' ? 'selected' : '' }}>A.6.1.2 Pemisahan tugas</option>
                        <option value="A.6.1.3" {{ $mitigasi->klausul == 'A.6.1.3' ? 'selected' : '' }}>A.6.1.3 Kontak dengan otoritas</option>
                        <option value="A.6.1.4" {{ $mitigasi->klausul == 'A.6.1.4' ? 'selected' : '' }}>A.6.1.4 Kontak dengan kelompok khusus</option>
                        <option value="A.6.1.5" {{ $mitigasi->klausul == 'A.6.1.5' ? 'selected' : '' }}>A.6.1.5 Keamanan informasi dalam pengelolaan proyek</option>
                        <option value="A.6.2.1" {{ $mitigasi->klausul == 'A.6.2.1' ? 'selected' : '' }}>A.6.2.1 Mobilitas perangkat dan komunikasi</option>
                        <option value="A.7.1.1" {{ $mitigasi->klausul == 'A.7.1.1' ? 'selected' : '' }}>A.7.1.1 Pemeriksaan latar belakang</option>
                        <option value="A.7.2.1" {{ $mitigasi->klausul == 'A.7.2.1' ? 'selected' : '' }}>A.7.2.1 Kesadaran, pendidikan, dan pelatihan keamanan informasi</option>
                        <option value="A.7.2.2" {{ $mitigasi->klausul == 'A.7.2.2' ? 'selected' : '' }}>A.7.2.2 Tanggung jawab keamanan informasi</option>
                        <option value="A.7.3.1" {{ $mitigasi->klausul == 'A.7.3.1' ? 'selected' : '' }}>A.7.3.1 Penghentian atau perubahan pekerjaan</option>
                        <option value="A.8.1.1" {{ $mitigasi->klausul == 'A.8.1.1' ? 'selected' : '' }}>A.8.1.1 Daftar aset</option>
                        <option value="A.8.1.2" {{ $mitigasi->klausul == 'A.8.1.2' ? 'selected' : '' }}>A.8.1.2 Kepemilikan aset</option>
                        <option value="A.8.1.3" {{ $mitigasi->klausul == 'A.8.1.3' ? 'selected' : '' }}>A.8.1.3 Pengembalian aset</option>
                        <option value="A.8.2.1" {{ $mitigasi->klausul == 'A.8.2.1' ? 'selected' : '' }}>A.8.2.1 Klasifikasi informasi</option>
                        <option value="A.8.2.2" {{ $mitigasi->klausul == 'A.8.2.2' ? 'selected' : '' }}>A.8.2.2 Labeling informasi</option>
                        <option value="A.8.2.3" {{ $mitigasi->klausul == 'A.8.2.3' ? 'selected' : '' }}>A.8.2.3 Penanganan media</option>
                        <option value="A.8.3.1" {{ $mitigasi->klausul == 'A.8.3.1' ? 'selected' : '' }}>A.8.3.1 Pengelolaan media yang dapat dilepas</option>
                        <option value="A.8.3.2" {{ $mitigasi->klausul == 'A.8.3.2' ? 'selected' : '' }}>A.8.3.2 Pembuangan media</option>
                        <option value="A.8.3.3" {{ $mitigasi->klausul == 'A.8.3.3' ? 'selected' : '' }}>A.8.3.3 Transfer media fisik</option>
                        <option value="A.9.1.1" {{ $mitigasi->klausul == 'A.9.1.1' ? 'selected' : '' }}>A.9.1.1 Kebijakan kontrol akses</option>
                        <option value="A.9.1.2" {{ $mitigasi->klausul == 'A.9.1.2' ? 'selected' : '' }}>A.9.1.2 Akses jaringan dan layanan jaringan</option>
                        <option value="A.9.2.1" {{ $mitigasi->klausul == 'A.9.2.1' ? 'selected' : '' }}>A.9.2.1 Registrasi pengguna</option>
                        <option value="A.9.2.2" {{ $mitigasi->klausul == 'A.9.2.2' ? 'selected' : '' }}>A.9.2.2 Pengelolaan hak akses</option>
                        <option value="A.9.2.3" {{ $mitigasi->klausul == 'A.9.2.3' ? 'selected' : '' }}>A.9.2.3 Hak istimewa pengguna</option>
                        <option value="A.9.2.4" {{ $mitigasi->klausul == 'A.9.2.4' ? 'selected' : '' }}>A.9.2.4 Manajemen kata sandi pengguna</option>
                        <option value="A.9.2.5" {{ $mitigasi->klausul == 'A.9.2.5' ? 'selected' : '' }}>A.9.2.5 Peninjauan hak akses</option>
                        <option value="A.9.3.1" {{ $mitigasi->klausul == 'A.9.3.1' ? 'selected' : '' }}>A.9.3.1 Kebijakan penggunaan perangkat</option>
                        <option value="A.9.3.2" {{ $mitigasi->klausul == 'A.9.3.2' ? 'selected' : '' }}>A.9.3.2 Penggunaan perangkat yang tidak diperbolehkan</option>
                        <option value="A.9.4.1" {{ $mitigasi->klausul == 'A.9.4.1' ? 'selected' : '' }}>A.9.4.1 Akses untuk pengguna</option>
                        <option value="A.9.4.2" {{ $mitigasi->klausul == 'A.9.4.2' ? 'selected' : '' }}>A.9.4.2 Akses untuk layanan pihak ketiga</option>
                    </select>
                </div>

                <!-- Field Rencana Mitigasi -->
                <div class="form-group mb-3">
                    <label for="mitigasi_risiko">Mitigasi Risiko:</label>
                    <input type="text" name="mitigasi_risiko" class="form-control" value="{{ old('mitigasi_risiko', $mitigasi->mitigasi_risiko) }}">
                </div>


                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
