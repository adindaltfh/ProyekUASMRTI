@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Dashboard</h2>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="row mb-4" style="width: 99.9%;">
        <!-- Kartu Jumlah User -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Jumlah User</span>
                    <i class="fas fa-user" style="margin-right: -15px;"></i>
                </div>
                <div class="card-body">
                    <h3>{{ $totalUsers }}</h3>
                    <div class="progress">
                        <div class="progress-bar bg-primary" role="progressbar" 
                             style="width: {{ $totalUsers > 0 ? ($adminCount / $totalUsers * 100) : 0 }}%;" 
                             title="Admin: {{ $adminCount }}">
                            {{ $adminCount }}
                        </div>
                        <div class="progress-bar bg-success" role="progressbar" 
                             style="width: {{ $totalUsers > 0 ? ($userCount / $totalUsers * 100) : 0 }}%;" 
                             title="User: {{ $userCount }}">
                            {{ $userCount }}
                        </div>
                    </div>
                    <!-- Legend for User Categories -->
                    <div class="mt-2">
                        <span class="badge bg-primary">Admin</span>
                        <span class="badge bg-success">User</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kartu Jumlah Asset -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Jumlah Aset</span>
                    <i class="fas fa-tasks" style="margin-right: -15px;"></i>
                </div>
                <div class="card-body">
                    <h3>{{ $totalAssets }}</h3>
                    <div class="progress">
                        @foreach($assetCategories as $category => $count)
                            @php
                                $colorClass = match($category) {
                                    'data' => 'bg-primary',
                                    'software' => 'bg-success',
                                    'hardware' => 'bg-danger',
                                    'network' => 'bg-warning',
                                    'sumber_daya_manusia' => 'bg-secondary',
                                    default => 'bg-dark'
                                };
                            @endphp
                            <div class="progress-bar {{ $colorClass }}" role="progressbar" 
                                 style="width: {{ $totalAssets > 0 ? ($count / $totalAssets * 100) : 0 }}%;" 
                                 title="{{ ucfirst($category) }}: {{ $count }}">
                                {{ $count }}
                            </div>
                        @endforeach
                    </div>
                    <!-- Legend for Asset Categories -->
                    <div class="mt-2">
                        <span class="badge bg-primary">Data</span>
                        <span class="badge bg-success">Software</span>
                        <span class="badge bg-danger">Hardware</span>
                        <span class="badge bg-warning">Network</span>
                        <span class="badge bg-secondary">SDM</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kartu Jumlah Risiko -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Jumlah Risiko</span>
                    <i class="fas fa-exclamation-triangle" style="margin-right: -15px;"></i>
                </div>
                <div class="card-body">
                    <h3>{{ $totalRisks }}</h3>
                    <div class="progress">
                        @foreach($riskCategories as $category => $count)
                            @php
                                $colorClass = match($category) {
                                    'data' => 'bg-primary',
                                    'software' => 'bg-success',
                                    'hardware' => 'bg-danger',
                                    'network' => 'bg-warning',
                                    'sumber_daya_manusia' => 'bg-secondary',
                                    default => 'bg-dark'
                                };
                            @endphp
                            <div class="progress-bar {{ $colorClass }}" role="progressbar" 
                                 style="width: {{ $totalRisks > 0 ? ($count / $totalRisks * 100) : 0 }}%;" 
                                 title="{{ ucfirst($category) }}: {{ $count }}">
                                {{ $count }}
                            </div>
                        @endforeach
                    </div>
                    <!-- Legend for Risk Categories -->
                    <div class="mt-2">
                    <span class="badge bg-primary">Data</span>
                        <span class="badge bg-success">Software</span>
                        <span class="badge bg-danger">Hardware</span>
                        <span class="badge bg-warning">Network</span>
                        <span class="badge bg-secondary">SDM</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-5" style="width: 99.9%;">
        <!-- Grafik Level Risiko -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-header text-center d-flex justify-content-between align-items-center">
                <span>Level Risiko</span>
                <i class="fas fa-balance-scale" style="margin-right: -18px;"></i>    
                </div>
                <div class="card-body d-flex justify-content-center">
                    <canvas id="riskCategoryChart" width="100" height="185"></canvas>
                </div>
            </div>
        </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-header text-center d-flex justify-content-between align-items-center">
                <span>Penilaian CIA Aset</span>
                <i class="fas fa-sitemap" style="margin-right: -18px;"></i>
            </div>
            <div class="card-body d-flex justify-content-center">
                <canvas id="ciaCategoryChart" width="100" height="185"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
    <div class="card">
                <div class="card-header text-center">
                    Jumlah Mitigasi dan Penilaian Risiko per Bulan
                </div>
                <div class="card-body">
                    <div class="mb-3 text-end">
                        <select id="yearDropdown" class="form-select form-select-sm w-auto d-inline-block">
                        @foreach($years as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>

                    <canvas id="mitigationAssessmentChart" width="400" height="110"></canvas>
                </div>
                </div>
            </div>
    </div>
</div>

</div>

<script>
    const ctx = document.getElementById('riskCategoryChart').getContext('2d');
    const riskCategoryChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: @json($riskLevelCategories->pluck('level')),
            datasets: [{
                data: @json($riskLevelCategories->pluck('count')),
                backgroundColor: [
                    '#4bc0c0', // Low risk color
                    '#ff9f40', // Medium risk color
                    '#ff6384', // High risk color
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false, // Allow custom height and width
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    });

    const ctxCIA = document.getElementById('ciaCategoryChart').getContext('2d');
    const ciaCategoryChart = new Chart(ctxCIA, {
        type: 'bar',
        data: {
            labels: ['Data', 'Software', 'Hardware', 'Network', 'SDM'], // Sesuaikan nama kategori aset sesuai data Anda
            datasets: [
                {
                    label: 'C',
                    data: @json($ciaCategories->pluck('c')), // Data untuk nilai C
                    backgroundColor: '#4bc0c0'
                },
                {
                    label: 'I',
                    data: @json($ciaCategories->pluck('i')), // Data untuk nilai I
                    backgroundColor: '#ff9f40'
                },
                {
                    label: 'A',
                    data: @json($ciaCategories->pluck('a')), // Data untuk nilai A
                    backgroundColor: '#ff6384'
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    stacked: true,
                    grid: {
                    display: false // Menghilangkan grid pada sumbu x
                }
                },
                y: {
                    stacked: true,
                    ticks: {
                        beginAtZero: true,
                        max: 100
                    },
                    grid: {
                    display: false // Menghilangkan grid pada sumbu x
                }
                }
            },
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
    const yearDropdown = document.getElementById('yearDropdown');
    
    yearDropdown.addEventListener('change', function() {
        loadChartData(this.value);
    });

    function loadChartData(year) {
        fetch(`/dashboard/data-chart?year=${year}`)
            .then(response => response.json())
            .then(data => {
        console.log(data); // Cek data di console
        createChart(data.mitigationData, data.assessmentData, year);
    })
    .catch(error => console.error('Error fetching data:', error));
    if (window.mitigationAssessmentChart) {
        window.mitigationAssessmentChart.destroy();
    }
    }

    loadChartData(yearDropdown.value);

    function createChart(mitigationData, assessmentData, year) {
    const ctx = document.getElementById('mitigationAssessmentChart').getContext('2d');

    // Buat chart baru
    window.mitigationAssessmentChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [
                {
                    label: 'Mitigasi Risiko',
                    data: mitigationData,
                    borderColor: '#4bc0c0',
                    fill: false
                },
                {
                    label: 'Penilaian Risiko',
                    data: assessmentData,
                    borderColor: '#ff6384',
                    fill: false
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    }
                },
                y: { 
                    ticks: {
                    beginAtZero: true,
                    stepSize: 1 // Atur stepSize menjadi 1 untuk menampilkan label 1, 2, 3, dst.
                }
                }
            }
        }
    });
}

});
</script>
@endsection