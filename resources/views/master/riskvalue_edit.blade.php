@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Form Edit Nilai Risiko</h2>
    <div class="row ">
        <div class="col-8"></div>
        <div class="col-4"><a href="{{ route('riskvalue.show') }}" class="btn btn-outline-success">Kembali</a></div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="post" action="{{ route('riskvalue.update', $riskvalue->id) }}">
                @csrf
                @method('PUT')
                
                <div class="form-group mb-3">
                    <label for="nama_risiko">Nama Risiko:</label>
                    <select class="form-control" id="nama_risiko" name="risk_id">
                        @foreach ($risk as $risk)
                            <option value="{{ $risk->id }}" {{ $riskvalue->risk_id == $risk->id ? 'selected' : '' }}>
                                {{ $risk->nama_risiko }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="nilai_risiko">Nilai Risiko:</label>
                    <input type="number" class="form-control" id="nilai_risiko" name="nilai_risiko" min="1" max="10" value="{{ $riskvalue->nilai_risiko }}" required oninput="updateLevel()">
                </div>

                <div class="form-group mb-3">
                    <label for="level">Level:</label>
                    <input type="text" class="form-control" id="level" name="level" value="{{ $riskvalue->level }}" readonly>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>

<script>
    function updateLevel() {
        const nilaiRisiko = document.getElementById('nilai_risiko').value;
        const levelInput = document.getElementById('level');

        if (nilaiRisiko >= 1 && nilaiRisiko <= 4) {
            levelInput.value = 'low';
        } else if (nilaiRisiko >= 5 && nilaiRisiko <= 7) {
            levelInput.value = 'medium';
        } else if (nilaiRisiko >= 8 && nilaiRisiko <= 10) {
            levelInput.value = 'high';
        } else {
            levelInput.value = ''; // Kosongkan jika tidak dalam range
        }
    }

    // Panggil fungsi untuk mengisi level saat halaman dimuat
    document.addEventListener('DOMContentLoaded', updateLevel);
</script>
@endsection
