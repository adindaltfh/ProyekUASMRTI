@extends('layouts.main')

@section('content')
<div class="container mt-5 d-flex justify-content-center">
    <div class="col-md-8 col-lg-6 position-relative">
        <h2 class="text-center mb-4">Form Input Penilaian Risiko</h2>
        
        <!-- Tombol Kembali di sebelah kanan -->
        <div class="row mb-3">
            <div class="col-8"></div>
            <div class="col-4 text-end">
                <a href="{{ route('assessment.show') }}" class="btn btn-outline-success">Kembali</a>
            </div>
        </div>

        <form method="post" action="{{ route('assessment.store') }}">
            @csrf

            <!-- Tanggal -->
            <div class="form-group mb-3">
                <label for="tanggal_evaluasi">Tanggal:</label>
                <input type="date" name="tanggal_evaluasi" class="form-control" required>
            </div>

            <!-- User/Audit -->
            <div class="form-group mb-3">
                <label for="user_id">User:</label>
                
                @if ($currentUser->role === 'admin')
                    <!-- Dropdown untuk admin -->
                    <select class="form-select" name="user_id" required>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                @else
                    <!-- Input readonly untuk non-admin -->
                    <input type="text" class="form-control" value="{{ $currentUser->name }}" readonly>
                    <input type="hidden" name="user_id" value="{{ $currentUser->id }}">
                @endif
            </div>


            <!-- Nama Risiko -->
            <div class="form-group mb-3">
                <label for="risk_id">Nama Risiko:</label>
                <select class="form-select" name="risk_id" required>
                    @foreach ($risks as $risk)
                        <option value="{{ $risk->id }}">{{ $risk->nama_risiko }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Kolom Severity, Occurrence, dan Detection dalam satu baris -->
            <div class="d-flex gap-3 mb-3">
                <div class="flex-fill">
                    <label>Sev:</label>
                    <input type="number" id="severity" name="severity" min="1" max="10" class="form-control" required placeholder="Pilih Nilai 1-10">
                </div>
                <div class="flex-fill">
                    <label>Occ:</label>
                    <input type="number" id="occurrence" name="occurrence" min="1" max="10" class="form-control" required placeholder=" Pilih Nilai 1-10">
                </div>
                <div class="flex-fill">
                    <label>Dec:</label>
                    <input type="number" id="detection" name="detection" min="1" max="10" class="form-control" required placeholder="Pilih Nilai 1-10">
                </div>
            </div>

            <!-- RPN dan Level Risiko -->
            <div class="d-flex gap-3 mb-3">
                <div class="flex-fill">
                    <label for="rpn">RPN:</label>
                    <input type="text" id="rpn" name="rpn" class="form-control" readonly>
                </div>
                <div class="flex-fill">
                    <label for="level">Level:</label>
                    <input type="text" id="level" name="level" class="form-control" readonly>
                </div>
            </div>

            <!-- Tombol Submit di bagian bawah, rata kiri -->
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>
</div>

<script>
    // Function to calculate RPN and determine level
    function calculateRPN() {
        const severity = parseInt(document.getElementById('severity').value) || 0;
        const occurrence = parseInt(document.getElementById('occurrence').value) || 0;
        const detection = parseInt(document.getElementById('detection').value) || 0;

        // Calculate RPN
        const rpn = severity * occurrence * detection;
        document.getElementById('rpn').value = rpn;

        // Determine Level based on RPN value
        let level = '';
        if (rpn >= 0 && rpn <= 19) {
            level = 'Very Low';
        } else if (rpn >= 20 && rpn <= 79) {
            level = 'Low';
        } else if (rpn >= 80 && rpn <= 119) {
            level = 'Medium';
        } else if (rpn >= 120 && rpn <= 199) {
            level = 'High';
        } else {
            level = 'Very High';
        }
        document.getElementById('level').value = level;
    }

    // Attach event listeners to recalculate RPN and Level whenever inputs change
    document.getElementById('severity').addEventListener('input', calculateRPN);
    document.getElementById('occurrence').addEventListener('input', calculateRPN);
    document.getElementById('detection').addEventListener('input', calculateRPN);
</script>
@endsection
