<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body class="bg-light">

<div class="sidebar" id="sidebar">
    <div class="logo">SIDIK DIY</div>
    <a href="/dashboard" class="active"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
    <div class="dropdown">
        <a href="#" class="dropdown-toggle" id="dataSekolahBtn"><i class="bi bi-building me-2"></i>Data Sekolah</a>
        <div class="dropdown-menu" id="dataSekolahDropdown" style="display:none; background:#34495e;">
            <a href="/sma" class="dropdown-item">SMA</a>
            <a href="/smk" class="dropdown-item">SMK</a>
            <a href="/slb" class="dropdown-item">SLB</a>
        </div>
    </div>
    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="bi bi-box-arrow-right me-2"></i>Logout
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>

<div class="main-content p-4">
    
    <div class="dashboard-header d-flex align-items-center mb-4">
        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="User Icon" class="me-3" style="width: 50px; height: 50px;">
        <div>
            <h2 class="mb-0">Selamat Datang di Dashboard</h2>
            <small class="text-muted">Analisis dan kelola data pendidikan DI Yogyakarta dengan mudah. Update per: {{ date('l, j F Y') }}</small>
        </div>
    </div>
    
    <div class="row mb-4">
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="summary-card">
                <div class="card-body">
                    <div class="icon-circle">
                        <i class="bi bi-buildings-fill"></i>
                    </div>
                    <div class="info">
                        <h3 class="h3">{{ number_format($totalSekolah2020 ?? 0, 0, ',', '.') }}</h3>
                        <p>Total Sekolah</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="summary-card">
                <div class="card-body">
                    <div class="icon-circle">
                        <i class="bi bi-person-badge-fill"></i>
                    </div>
                    <div class="info">
                        <h3 class="h3">{{ number_format($totalMurid2020 ?? 0, 0, ',', '.') }}</h3>
                        <p>Total Peserta Didik</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="summary-card">
                <div class="card-body">
                    <div class="icon-circle">
                        <i class="bi bi-mortarboard-fill"></i>
                    </div>
                    <div class="info">
                        <h3 class="h3">{{ number_format($totalGuru2020 ?? 0, 0, ',', '.') }}</h3>
                        <p>Total Guru</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-8 mb-4">
            <div class="card h-100">
                <div class="card-header bg-dark text-white">Rekapitulasi Data Pendidikan Tahunan</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped text-center">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-start">Indikator</th>
                                    <th>2020</th>
                                    <th>2021</th>
                                    <th>2022</th>
                                    <th>2023</th>
                                    <th>2024</th>
                                    <th>2025</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="total-indicator">
                                    <td class="text-start">Total Sekolah</td>
                                    <td>{{ number_format($totalSekolah2020 ?? 0) }}</td>
                                    <td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>
                                </tr>
                                <tr>
                                    <td class="text-start sub-indicator">SMA</td>
                                    <td>{{ number_format($totalSekolahSma ?? 0) }}</td>
                                    <td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>
                                </tr>
                                <tr>
                                    <td class="text-start sub-indicator">SMK</td>
                                    <td>{{ number_format($totalSekolahSmk ?? 0) }}</td>
                                    <td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>
                                </tr>
                                <tr>
                                    <td class="text-start sub-indicator">SLB</td>
                                    <td>{{ number_format($totalSekolahSlb ?? 0) }}</td>
                                    <td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>
                                </tr>

                                <tr class="total-indicator">
                                    <td class="text-start">Total Murid</td>
                                    <td>{{ number_format($totalMurid2020 ?? 0) }}</td>
                                    <td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>
                                </tr>
                                <tr>
                                    <td class="text-start sub-indicator">SMA</td>
                                    <td>{{ number_format($totalMuridSma ?? 0) }}</td>
                                    <td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>
                                </tr>
                                <tr>
                                    <td class="text-start sub-indicator">SMK</td>
                                    <td>{{ number_format($totalMuridSmk ?? 0) }}</td>
                                    <td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>
                                </tr>
                                <tr>
                                    <td class="text-start sub-indicator">SLB</td>
                                    <td>{{ number_format($totalMuridSlb ?? 0) }}</td>
                                    <td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>
                                </tr>

                                <tr class="total-indicator">
                                    <td class="text-start">Total Guru</td>
                                    <td>{{ number_format($totalGuru2020 ?? 0) }}</td>
                                    <td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>
                                </tr>
                                <tr>
                                    <td class="text-start sub-indicator">SMA</td>
                                    <td>{{ number_format($totalGuruSma ?? 0) }}</td>
                                    <td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>
                                </tr>
                                <tr>
                                    <td class="text-start sub-indicator">SMK</td>
                                    <td>{{ number_format($totalGuruSmk ?? 0) }}</td>
                                    <td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>
                                </tr>
                                <tr>
                                    <td class="text-start sub-indicator">SLB</td>
                                    <td>{{ number_format($totalGuruSlb ?? 0) }}</td>
                                    <td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-header text-white" style="background-color: #00796b;">SMA/SMK/SLB di Daerah Istimewa Yogyakarta</div>
                <div class="card-body d-flex justify-content-center align-items-center">
                    <canvas id="sekolahKabupatenChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-header bg-danger text-white">Total Sekolah Tahunan</div>
                <div class="card-body">
                    <canvas id="totalSekolahChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-white">Total Murid Tahunan</div>
                <div class="card-body">
                    <canvas id="totalMuridChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-header bg-success text-white">Total Guru Tahunan</div>
                <div class="card-body">
                    <canvas id="totalGuruChart"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    // ===== Sidebar Dropdown =====
    const btn = document.getElementById('dataSekolahBtn');
    const dropdown = document.getElementById('dataSekolahDropdown');
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
    });
    document.addEventListener('click', function(e) {
        if (!btn.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.style.display = 'none';
        }
    });
    
    // ===== DATA DAN LOGIKA GRAFIK SEKOLAH PER KABUPATEN (DOUGHNUT) =====
    const sekolahKabupatenLabels = @json($labelsKabupaten);
    const sekolahKabupatenData = @json($dataKabupaten);

    new Chart(document.getElementById('sekolahKabupatenChart'), {
        type: 'doughnut',
        data: {
            labels: sekolahKabupatenLabels,
            datasets: [{
                label: 'Jumlah Sekolah',
                data: sekolahKabupatenData,
                backgroundColor: [
                    '#5DADE2', '#2C3E50', '#F5B041', '#A569BD', '#58D68D'
                ],
                borderColor: '#ffffff',
                borderWidth: 2,
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { boxWidth: 15, padding: 15 }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.label || '';
                            if (label) { label += ': '; }
                            if (context.parsed !== null) {
                                label += new Intl.NumberFormat('id-ID').format(context.parsed);
                            }
                            return label;
                        }
                    }
                }
            }
        }
    });


    // ===== DATA DAN LOGIKA GRAFIK PERTUMBUHAN TAHUNAN (BAR) =====
    const totalSekolah2020 = {{ $totalSekolah2020 ?? 0 }}; 
    const totalMurid2020 = {{ $totalMurid2020 ?? 0 }};
    const totalGuru2020 = {{ $totalGuru2020 ?? 0 }};

    const growthLabels = ['2020', '2021', '2022', '2023', '2024', '2025'];

    // Chart Total Sekolah
    new Chart(document.getElementById('totalSekolahChart'), {
        type: 'bar',
        data: {
            labels: growthLabels,
            datasets: [{
                label: 'Jumlah Sekolah',
                data: [totalSekolah2020, 0, 0, 0, 0, 0],
                backgroundColor: 'rgba(220, 53, 69, 0.8)',
                borderColor: '#dc3545',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });

    // Chart Total Murid
    new Chart(document.getElementById('totalMuridChart'), {
        type: 'bar',
        data: {
            labels: growthLabels,
            datasets: [{
                label: 'Jumlah Murid',
                data: [totalMurid2020, 0, 0, 0, 0, 0],
                backgroundColor: 'rgba(13, 110, 253, 0.8)',
                borderColor: '#0d6efd',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });

    // Chart Total Guru
    new Chart(document.getElementById('totalGuruChart'), {
        type: 'bar',
        data: {
            labels: growthLabels,
            datasets: [{
                label: 'Jumlah Guru',
                data: [totalGuru2020, 0, 0, 0, 0, 0],
                backgroundColor: 'rgba(25, 135, 84, 0.8)',
                borderColor: '#198754',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });

</script>

</body>
</html>