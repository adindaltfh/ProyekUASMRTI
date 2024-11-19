<!doctype html>
<html lang="en">
  <head>
    <title>Monitoring Risk</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    
    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  </head>

  <style>
        body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        overflow: auto; /* prevent scrollbar flash */
        }

        #wrapper {
        display: flex;
        }

        .content-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            }

        #sidebar {
        width: 220px;
        background-color: #015eb6;
        color: white;
        height: 100vh;
        overflow-y: auto;
        overflow-x: hidden;
        position: fixed; 
        }

        #sidebar::-webkit-scrollbar {
        width: 6px; /* Lebar scrollbar */
        }

        #sidebar::-webkit-scrollbar-thumb {
        background-color: transparent; /* Warna thumb scrollbar (anda dapat mengganti dengan warna yang diinginkan) */
        }

        .container {
            justify-content: center;
            align-items: center;
            overflow-y: auto;
            overflow-x: hidden;
            margin-left: 17%;
            }

            .content-container {
                max-width: 1100px;
                width: 100%;
            }

        .sidebar-header {
        padding: 20px;
        text-align: center;
        background-color: #015eb6;
        margin-bottom: 30px
        }

        .sidebar-header h3 {
        color: white;
        font-size: 24px;
        margin-bottom: 0;
        }

        .nav-link {
        text-decoration: none;
        color: white;
        padding: 10px;
        display: block;
        margin-bottom: 5px;
        }

        .active{
        background-color: #15528e;
        }

        .navbar-nav .active:hover{
        background-color: #125497;
        color: white;
        }

        .nav-item .active:hover{
        background-color: #0c4176;
        color: white;
        }

        .nav-item:hover{
        background-color: #15528e;
        color: white;
        }

        .navbar-nav a:hover {
        color: white; /* Set the same color or a different color for the hover state */
        }

        .navbar-nav .nav-item{
        margin-bottom: 5px;
        padding-left: 20px;
        }

        .content-header {
        padding: 20px;
        background-color: #015eb6;
        color: white;
        }

        table {
        width: 100%;
        margin-top: 20px;
        }

        th, td {
        padding: 15px;
        text-align: left;
        }

        th {
        background-color: #111;
        color: white;
        }

        tbody tr:nth-child(even) {
        background-color: #f2f2f2;
        }

        .fas{
        padding-right: 20px;
        }

        .icon-user::before, .icon-asset::before, .icon-risk::before {
        content: "\f007"; /* kode ikon FontAwesome atau ikon lain sesuai navbar */
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        color: #333;
        }

        .progress-bar {
        color: white;
        font-size: 0.8em;
        text-align: center;
        }

        .notification {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 1050; /* Pastikan berada di atas elemen lain */
            width: 260px;
        }

        .progress-bar.bg-primary { background-color: #007bff; } /* Admin */
        .progress-bar.bg-secondary { background-color: #6c757d; } /* User */
        .progress-bar[data-category="data"] { background-color: #ff6384; }
        .progress-bar[data-category="software"] { background-color: #36a2eb; }
        .progress-bar[data-category="hardware"] { background-color: #ffce56; }
        .progress-bar[data-category="network"] { background-color: #4bc0c0; }
        .progress-bar[data-category="sumber_daya_manusia"] { background-color: #9966ff; }


  </style>
  <body>
    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar">
            <div class="sidebar-header">
                <h3>Monitoring Risk</h3>
            </div>
            <ul class="navbar-nav">
                @auth
                    @if(auth()->user()->role == 'admin')
                        <li class="nav-item {{ $activePage == 'dashboard' ? 'active' : '' }}">
                            <a href="{{ route('dashboard.show') }}" class="nav-link">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item {{ $activePage == 'user' ? 'active' : '' }}">
                            <a href="{{ route('user.show') }}" class="nav-link">
                                <i class="fas fa-user"></i> User
                            </a>
                        </li>
                        <li class="nav-item {{ $activePage == 'asset' ? 'active' : '' }}">
                            <a href="{{ route('asset.show') }}" class="nav-link">
                                <i class="fas fa-tasks"></i> Aset
                            </a>
                        </li>
                        <li class="nav-item {{ $activePage == 'risk' ? 'active' : '' }}">
                            <a href="{{ route('risk.show') }}" class="nav-link">
                                <i class="fas fa-exclamation-triangle"></i> Risiko
                            </a>
                        </li>
                        <li class="nav-item {{ $activePage == 'riskvalue' ? 'active' : '' }}">
                            <a href="{{ route('riskvalue.show') }}" class="nav-link">
                                <i class="fas fa-balance-scale"></i> Nilai Risiko
                            </a>
                        </li>
                        <li class="nav-item {{ $activePage == 'cia' ? 'active' : '' }}">
                            <a href="{{ route('cia.show') }}" class="nav-link">
                                <i class="fas fa-sitemap"></i> Analisis CIA Aset
                            </a>
                        </li>
                        <li class="nav-item {{ $activePage == 'assessment' ? 'active' : '' }}">
                            <a href="{{ route('assessment.show') }}" class="nav-link">
                                <i class="fas fa-clipboard-check"></i> Penilaian Risiko
                            </a>
                        </li>
                        <li class="nav-item {{ $activePage == 'mitigasi' ? 'active' : '' }}">
                            <a href="{{ route('mitigasi.show') }}" class="nav-link">
                                <i class="fas fa-lightbulb"></i> Mitigasi
                            </a>
                        </li>
                    @endif

                    @if(auth()->user()->role == 'user')
                        <li class="nav-item {{ $activePage == 'dashboard' ? 'active' : '' }}">
                            <a href="{{ route('dashboard.show') }}" class="nav-link">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item {{ $activePage == 'asset' ? 'active' : '' }}">
                            <a href="{{ route('asset.show') }}" class="nav-link">
                                <i class="fas fa-tasks"></i> Aset
                            </a>
                        </li>
                        <li class="nav-item {{ $activePage == 'risk' ? 'active' : '' }}">
                            <a href="{{ route('risk.show') }}" class="nav-link">
                                <i class="fas fa-exclamation-triangle"></i> Risiko
                            </a>
                        </li>
                        <li class="nav-item {{ $activePage == 'assessment' ? 'active' : '' }}">
                            <a href="{{ route('assessment.show') }}" class="nav-link">
                                <i class="fas fa-clipboard-check"></i> Penilaian Risiko
                            </a>
                        </li>
                        <li class="nav-item {{ $activePage == 'mitigasi' ? 'active' : '' }}">
                            <a href="{{ route('mitigasi.show') }}" class="nav-link">
                                <i class="fas fa-lightbulb"></i> Mitigasi
                            </a>
                        </li>
                    @endif

                    <!-- Tombol Logout -->
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link" style="padding-right: 100px;">
                                <i class="fas fa-sign-out-alt"></i> Logout                   
                            </button>
                        </form>
                    </li>
                @else
                    <!-- Tampilkan link login jika belum login -->
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </a>
                    </li>
                @endauth
            </ul>
        </div>

    {{-- <main class="container"> --}}
        @yield('content')
    {{-- </main> --}}

    
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
    
        // $(document).ready(function() {
        //     // Event listener untuk perubahan pada select asset
        //     $('#assetSelect').change(function() {
        //         updateDampakCheckboxes();
        //     });
    
        //     // Fungsi untuk memperbarui checkbox dampak berdasarkan nilai risiko yang dipilih
        //     function updateDampakCheckboxes() {
        //         var selectedasset = $('#assetSelect').val();
    
        //         // Kirim request AJAX untuk mendapatkan dampak berdasarkan nilai risiko dan asset
        //         $.ajax({
        //             url: '{{ route("assessment.get-dampak") }}',
        //             type: 'POST',
        //             data: {
        //                 _token: '{{ csrf_token() }}',
        //                 asset_id: selectedasset
        //             },
        //             success: function(response) {
        //                 // Tampilkan checkbox dampak yang baru
        //                 $('#dampakContainer').html(response);
        //             },
        //             error: function(error) {
        //                 // console.log(error);
        //             }
        //         });
        //     }
    
        //     // Panggil fungsi pertama kali halaman dimuat
        //     updateDampakCheckboxes();
        // });

        function getImpacts() {
            var assetId = $('#asset_id').val();

            $.ajax({
                url: "{{ route('assessment.get-dampak') }}",
                method: 'GET',
                data: {
                    asset_id: assetId,
                },
                success: function(response) {
                    var impactsList = '';

                    $.each(response.impacts, function(index, impact) {
                        impactsList += '<input type="checkbox" name="impact_ids[]" value="' + impact.id + '">' + '&nbsp' + impact.nama_dampak + '<br>';
                    });

                    $('#impacts-list').html(impactsList);
                },
            });
        }
    </script>

</body>
</html>

