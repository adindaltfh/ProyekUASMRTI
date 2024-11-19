@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Form Input Mitigasi</h2>
    <div class="row ">
        <div class="col-8"></div>
        <div class="col-4"><a href="{{ route('mitigasi.show') }}" class="btn btn-outline-success">Kembali</a></div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="post" action="{{ route('mitigasi.store') }}">
                @csrf
                
                <!-- Field Tanggal -->
                <div class="form-group mb-3">
                    <label for="tanggal">Tanggal:</label>
                    <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal') }}">
                </div>

                <!-- Field Nama Aset -->
                <div class="form-group mb-3">
                    <label for="asset_id">Nama Aset:</label>
                    <select class="form-select" name="asset_id">
                    <option value="none">Tidak Ada Aset</option>
                        @foreach ($assets as $asset)
                            <option value="{{ $asset->id }}">{{ $asset->nama_aset }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Field Risiko -->
                <div class="form-group mb-3">
                    <label for="risk_id">Risiko:</label>
                    <select class="form-select" name="risk_id">
                        @foreach ($risks as $risk)
                            <option value="{{ $risk->id }}">{{ $risk->nama_risiko }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Field Klausul dengan Select2 -->
                <div class="form-group mb-3">
                    <label for="klausul">Klausul:</label>
                    <select class="form-select klausul-select2" name="klausul">
                        <!-- A.5 Kebijakan Keamanan Informasi -->
                        <option value="A.5.1.1">A.5.1.1 Kebijakan keamanan informasi</option>
                        <option value="A.5.1.2">A.5.1.2 Tinjauan kebijakan keamanan informasi</option>
                        
                        <!-- A.6 Organisasi Keamanan Informasi -->
                        <option value="A.6.1.1">A.6.1.1 Peran dan tanggung jawab keamanan informasi</option>
                        <option value="A.6.1.2">A.6.1.2 Pemisahan tugas</option>
                        <option value="A.6.1.3">A.6.1.3 Kontak dengan otoritas</option>
                        <option value="A.6.1.4">A.6.1.4 Kontak dengan kelompok khusus</option>
                        <option value="A.6.1.5">A.6.1.5 Keamanan informasi dalam pengelolaan proyek</option>
                        <option value="A.6.2.1">A.6.2.1 Mobilitas perangkat dan komunikasi</option>
                        
                        <!-- A.7 Keamanan Sumber Daya Manusia -->
                        <option value="A.7.1.1">A.7.1.1 Pemeriksaan latar belakang</option>
                        <option value="A.7.2.1">A.7.2.1 Kesadaran, pendidikan, dan pelatihan keamanan informasi</option>
                        <option value="A.7.2.2">A.7.2.2 Tanggung jawab keamanan informasi</option>
                        <option value="A.7.3.1">A.7.3.1 Penghentian atau perubahan pekerjaan</option>
                        
                        <!-- A.8 Manajemen Aset -->
                        <option value="A.8.1.1">A.8.1.1 Daftar aset</option>
                        <option value="A.8.1.2">A.8.1.2 Kepemilikan aset</option>
                        <option value="A.8.1.3">A.8.1.3 Pengembalian aset</option>
                        <option value="A.8.2.1">A.8.2.1 Klasifikasi informasi</option>
                        <option value="A.8.2.2">A.8.2.2 Labeling informasi</option>
                        <option value="A.8.2.3">A.8.2.3 Penanganan media</option>
                        <option value="A.8.3.1">A.8.3.1 Pengelolaan media yang dapat dilepas</option>
                        <option value="A.8.3.2">A.8.3.2 Pembuangan media</option>
                        <option value="A.8.3.3">A.8.3.3 Transfer media fisik</option>
                        
                        <!-- A.9 Kontrol Akses -->
                        <option value="A.9.1.1">A.9.1.1 Kebijakan kontrol akses</option>
                        <option value="A.9.1.2">A.9.1.2 Akses jaringan dan layanan jaringan</option>
                        <option value="A.9.2.1">A.9.2.1 Registrasi pengguna</option>
                        <option value="A.9.2.2">A.9.2.2 Pengelolaan hak akses</option>
                        <option value="A.9.2.3">A.9.2.3 Hak istimewa pengguna</option>
                        <option value="A.9.2.4">A.9.2.4 Manajemen kata sandi pengguna</option>
                        <option value="A.9.2.5">A.9.2.5 Tinjauan hak akses pengguna</option>
                        <option value="A.9.3.1">A.9.3.1 Penggunaan akses sistem dan aplikasi</option>
                        <option value="A.9.4.1">A.9.4.1 Pembatasan akses informasi</option>
                        <option value="A.9.4.2">A.9.4.2 Pengendalian akses jaringan</option>
                        <option value="A.9.4.3">A.9.4.3 Kontrol akses aplikasi</option>
                        <option value="A.9.4.4">A.9.4.4 Perlindungan informasi rahasia dalam sistem</option>
                        <option value="A.9.4.5">A.9.4.5 Kontrol akses ke kode sumber program</option>
                        
                        <!-- A.10 Kriptografi -->
                        <option value="A.10.1.1">A.10.1.1 Kebijakan penggunaan kriptografi</option>
                        <option value="A.10.1.2">A.10.1.2 Pengelolaan kunci kriptografi</option>
                        
                        <!-- A.11 Keamanan Fisik dan Lingkungan -->
                        <option value="A.11.1.1">A.11.1.1 Area keamanan fisik</option>
                        <option value="A.11.1.2">A.11.1.2 Pengendalian pintu masuk yang aman</option>
                        <option value="A.11.1.3">A.11.1.3 Perlindungan terhadap ancaman lingkungan dan kecelakaan</option>
                        <option value="A.11.1.4">A.11.1.4 Pengaturan tempat kerja dan peralatan</option>
                        <option value="A.11.1.5">A.11.1.5 Bekerja di luar lokasi</option>
                        <option value="A.11.2.1">A.11.2.1 Tempat kerja yang aman</option>
                        <option value="A.11.2.2">A.11.2.2 Peralatan penempatan dan keamanan</option>
                        <option value="A.11.2.3">A.11.2.3 Pengelolaan peralatan yang disewa</option>
                        <option value="A.11.2.4">A.11.2.4 Penggunaan peralatan di luar lokasi</option>
                        
                        <!-- A.12 Operasi Keamanan -->
                        <option value="A.12.1.1">A.12.1.1 Prosedur operasi dan tanggung jawab</option>
                        <option value="A.12.1.2">A.12.1.2 Pengelolaan kapasitas</option>
                        <option value="A.12.1.3">A.12.1.3 Pemisahan lingkungan pengembangan, pengujian, dan produksi</option>
                        <option value="A.12.2.1">A.12.2.1 Pengendalian terhadap malware</option>
                        <option value="A.12.3.1">A.12.3.1 Pencadangan informasi</option>
                        <option value="A.12.4.1">A.12.4.1 Logging dan pemantauan peristiwa</option>
                        <option value="A.12.4.2">A.12.4.2 Perlindungan log informasi</option>
                        <option value="A.12.4.3">A.12.4.3 Log administrator dan operator</option>
                        <option value="A.12.4.4">A.12.4.4 Waktu sinkronisasi</option>
                        <option value="A.12.5.1">A.12.5.1 Instalasi perangkat lunak</option>
                        <option value="A.12.6.1">A.12.6.1 Pengelolaan kelemahan teknis</option>
                        
                        <!-- A.13 Keamanan Komunikasi -->
                        <option value="A.13.1.1">A.13.1.1 Pengendalian jaringan</option>
                        <option value="A.13.1.2">A.13.1.2 Keamanan layanan jaringan</option>
                        <option value="A.13.1.3">A.13.1.3 Perlindungan informasi dalam jaringan</option>
                        <option value="A.13.2.1">A.13.2.1 Kebijakan pertukaran informasi</option>
                        <option value="A.13.2.2">A.13.2.2 Perjanjian pertukaran informasi</option>
                        <option value="A.13.2.3">A.13.2.3 Pengiriman informasi secara aman</option>
                        <option value="A.13.2.4">A.13.2.4 Keamanan komunikasi elektronik</option>
                        
                        <!-- A.14 Akuisisi, Pengembangan, dan Pemeliharaan Sistem -->
                        <option value="A.14.1.1">A.14.1.1 Analisis kebutuhan keamanan informasi</option>
                        <option value="A.14.1.2">A.14.1.2 Spesifikasi persyaratan keamanan informasi</option>
                        <option value="A.14.2.1">A.14.2.1 Pengamanan pada aplikasi</option>
                    </select>

                </div>

                <!-- Field Mitigasi Risiko -->
                <div class="form-group mb-3">
                    <label for="mitigasi_risiko">Mitigasi Risiko:</label>
                    <input type="text" class="form-control" id="mitigasi_risiko" name="mitigasi_risiko" placeholder="Deskripsi mitigasi risiko">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

<!-- Script untuk mengaktifkan Select2 -->
<script>
    $(document).ready(function() {
        $('.klausul-select2').select2({
            placeholder: "Pilih atau cari klausul",
            allowClear: true
        });
    });
</script>
@endsection
