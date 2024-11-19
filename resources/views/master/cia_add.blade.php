@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Form Input CIA Aset</h2>
    <div class="row">
        <div class="col-8"></div>
        <div class="col-4"><a href="{{ route('cia.show') }}" class="btn btn-outline-success">Kembali</a></div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="post" action="{{ route('cia.store') }}">
                @csrf
                <div class="form-group mb-3">
                    <label for="kategori_aset_id">Kategori Aset:</label>
                    <select class="form-control" id="kategori_aset_id" name="kategori_aset_id" required>
                        <option value="" disabled selected>Pilih Kategori Aset</option>
                        @foreach($kategoriAsetOptions as $kategori)
                            <option value="{{ $kategori }}" {{ in_array($kategori, $usedKategoriAset) ? 'disabled' : '' }}>
                                {{ $kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Input C, I, A dalam satu baris -->
                <div class="d-flex gap-3 mb-3">
                    @foreach(['c' => 'C', 'i' => 'I', 'a' => 'A'] as $item => $label)
                        <div class="flex-fill">
                            <label for="{{ $item }}">{{ $label }} :</label>
                            <input type="number" class="form-control cia-input" id="{{ $item }}" name="{{ $item }}" min="1" max="9" required placeholder="Pilih Nilai 1-9">
                        </div>
                    @endforeach
                </div>

                <div class="form-group mb-3">
                    <label for="aset_value">Nilai Aset:</label>
                    <input type="number" class="form-control" id="aset_value" name="aset_value" readonly>
                </div>
                
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

<script>
    // Fungsi untuk menghitung nilai aset
    function calculateAsetValue() {
        const c = parseInt(document.getElementById('c').value) || 0;
        const i = parseInt(document.getElementById('i').value) || 0;
        const a = parseInt(document.getElementById('a').value) || 0;
        const asetValue = c + i + a;
        document.getElementById('aset_value').value = asetValue;
    }

    // Event listener untuk perhitungan otomatis
    document.querySelectorAll('.cia-input').forEach(input => {
        input.addEventListener('input', calculateAsetValue);
    });
</script>
@endsection
