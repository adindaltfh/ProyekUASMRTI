@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Form Edit CIA Aset</h2>
    <div class="row">
        <div class="col-8"></div>
        <div class="col-4"><a href="{{ route('cia.show') }}" class="btn btn-outline-success">Kembali</a></div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="post" action="{{ route('cia.update', $cia->id) }}">
                @csrf
                @method('PUT')
                
                <div class="form-group mb-3">
                    <label for="kategori_aset_id">Kategori Aset:</label>
                    <select class="form-control" id="kategori_aset_id" name="kategori_aset_id" required>
                        <option value="" disabled>Pilih Kategori Aset</option>
                        @foreach($kategoriAsetOptions as $kategori)
                            <option value="{{ $kategori }}" 
                                {{ in_array($kategori, $usedKategoriAset) && $kategori != $cia->kategori_aset_id ? 'disabled' : '' }}
                                {{ $cia->kategori_aset_id === $kategori ? 'selected' : '' }}>
                                {{ $kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Input C, I, A dalam satu baris -->
                <div class="d-flex gap-3 mb-3">
                    @foreach(['c' => 'C', 'i' => 'I', 'a' => 'A'] as $item => $label)
                        <div class="flex-fill">
                            <label for="{{ $item }}">{{ $label }} (1-9):</label>
                            <input type="number" class="form-control cia-input" id="{{ $item }}" name="{{ $item }}" 
                                   value="{{ $cia->$item }}" min="1" max="9" required placeholder="1-9">
                        </div>
                    @endforeach
                </div>

                <div class="form-group mb-3">
                    <label for="aset_value">Nilai Aset:</label>
                    <input type="number" class="form-control" id="aset_value" name="aset_value" value="{{ $cia->aset_value }}" readonly>
                </div>
                
                <button type="submit" class="btn btn-primary">Update</button>
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
