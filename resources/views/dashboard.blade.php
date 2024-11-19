// jumlah Aset
// jumlah risiko
// jumlah User

//pie chart risiko per kategori level
//diagram 2 garis jumlah penilaian dan jumlah mitigasi per bulan
//cia diagram 5 bar chart bertimpa

@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Dashboard</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Jumlah Assessment Activity berdasarkan Nilai Risiko</div>
                <div class="card-body">
                    <canvas id="pieChartAssessment" width="300" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Jumlah Monitoring Unit berdasarkan Activity <br> &nbsp</div>
                 
                <div class="card-body">
                    <canvas id="pieChartMonitoring" width="300" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Jumlah Recommendation berdasarkan Jenis Risiko</div>
                <div class="card-body">
                    <canvas id="pieChartRecommendation" width="300" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('pieChartAssessment').getContext('2d');
    var data = {
        labels: @json($labels),
        datasets: [{
            data: @json($data),
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            label: ' Jumlah Activity nya ada '
        }]
    };

    var pieChart = new Chart(ctx, {
        type: 'pie',
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            title: {
                display: true,
                text: 'Judul Body Chart',
                fontSize: 16,
                fontColor: 'black'
            }
        }
    });

    var ctxM = document.getElementById('pieChartMonitoring').getContext('2d');
    var data = {
        labels: @json($labelsM),
        datasets: [{
            data: @json($dataM),
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            label: ' Jumlah Activity nya ada '
        }]
    };

    var pieChartM = new Chart(ctxM, {
        type: 'pie',
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: false,

        }
    });

    var ctxR = document.getElementById('pieChartRecommendation').getContext('2d');
    var data = {
        labels: @json($labelsR),
        datasets: [{
            data: @json($dataR),
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            label: ' Jumlah Jenis Risiko nya ada '
        }]
    };

    var pieChartR = new Chart(ctxR, {
        type: 'pie',
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: false,

        }
    });
</script>
@endsection
