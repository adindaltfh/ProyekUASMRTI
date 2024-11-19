@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Form Input Nilai Risiko</h2>
    <div class="row ">
        <div class="col-8"></div>
        <div class="col-4"><a href="{{ route('riskvalue.show') }}" class="btn btn-outline-success">Kembali</a></div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="post" action="{{ route('riskvalue.store') }}">
                @csrf

                <!-- Nama Risiko -->
                <div class="form-group mb-3">
                    <label for="risk_id">Nama Risiko:</label>
                    <select class="form-control" id="risk_id" name="risk_id">
                        @foreach ($risk as $risk)
                            <option value="{{ $risk->id }}">{{ $risk->nama_risiko }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Nilai Risiko -->
                <div class="form-group mb-3">
                    <label for="nilai_risiko">Nilai Risiko:</label>
                    <input type="number" class="form-control" id="nilai_risiko" name="nilai_risiko" min="1" max="10" placeholder="Pilih nilai 1-10" oninput="updateLevel()">
                </div>

                <!-- Level Risiko -->
                <div class="form-group mb-3">
                    <label for="level">Level:</label>
                    <input type="text" class="form-control" id="level" name="level" placeholder="Level" readonly>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
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
</script>

@endsection
