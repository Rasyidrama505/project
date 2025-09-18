<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="sidebar" id="sidebar">
    <div class="logo">DataPen</div>
    <a href="/dashboard" class="active">Dashboard</a>
    <div class="dropdown">
        <a href="#" class="dropdown-toggle" id="dataSekolahBtn">Data Sekolah</a>
        <div class="dropdown-menu" id="dataSekolahDropdown" style="display:none; background:#34495e;">
            <a href="/sma" class="dropdown-item">SMA</a>
            <a href="/smk" class="dropdown-item">SMK</a>
            <a href="/slb" class="dropdown-item">SLB</a>
        </div>
    </div>
    <a href="/login">Logout</a>
</div>
    <div class="main-content p-4">
    <div class="dashboard-header">
        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="User Icon">
        <div>
            <h2 class="mb-0">Selamat Datang di Dashboard Data Pendidikan DI Yogyakarta</h2>
            <small class="text-muted">Kelola data sekolah Anda dengan mudah dan cepat.</small>
        </div>
    </div>
    <!-- Chart Section: Indikator Utama -->
    <div class="row mb-4">
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-white">APK SMA/SEDERAJAT</div>
                <div class="card-body">
                    <canvas id="apkChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-header bg-success text-white">APM SMA/SEDERAJAT</div>
                <div class="card-body">
                    <canvas id="apmChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-header bg-warning text-white">APS Usia 16-18</div>
                <div class="card-body">
                    <canvas id="apsChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-header bg-danger text-white">Angka Putus Sekolah</div>
                <div class="card-body">
                    <canvas id="putusChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- Chart Section: SMA, SMK, SLB -->
    <div class="chart-row">
        <div class="chart-col">
            <div class="card">
                <div class="card-header bg-success text-white">Nilai Rerata Rapor Pendidikan SMA</div>
                <div class="card-body">
                    <canvas id="smaChart"></canvas>
                </div>
            </div>
        </div>
        <div class="chart-col">
            <div class="card">
                <div class="card-header bg-warning text-white">Nilai Rerata Rapor Pendidikan SMK</div>
                <div class="card-body">
                    <canvas id="smkChart"></canvas>
                </div>
            </div>
        </div>
        <div class="chart-col">
            <div class="card">
                <div class="card-header bg-info text-white">Nilai Rerata Rapor Pendidikan SLB</div>
                <div class="card-body">
                    <canvas id="slbChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- Tambahkan konten dashboard lain di sini -->
</div>
        <!-- Tambahkan konten dashboard lain di sini -->
    </div>
    <script>
    // Dropdown Data Sekolah
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

    // Chart Indikator Utama (masing-masing chart)
    new Chart(document.getElementById('apkChart').getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: ['APK SMA/SEDERAJAT'],
            datasets: [{
                data: [92, 8], // contoh data: 92% APK, 8% sisanya
                backgroundColor: ['#007bff', '#e0eafc']
            }]
        },
        options: { responsive: true, plugins: { legend: { display: false } } }
    });
    new Chart(document.getElementById('apmChart').getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: ['APM SMA/SEDERAJAT'],
            datasets: [{
                data: [89, 11],
                backgroundColor: ['#28a745', '#e0eafc']
            }]
        },
        options: { responsive: true, plugins: { legend: { display: false } } }
    });
    new Chart(document.getElementById('apsChart').getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: ['APS Usia 16-18'],
            datasets: [{
                data: [85, 15],
                backgroundColor: ['#ffc107', '#e0eafc']
            }]
        },
        options: { responsive: true, plugins: { legend: { display: false } } }
    });
    new Chart(document.getElementById('putusChart').getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: ['Angka Putus Sekolah'],
            datasets: [{
                data: [3, 97],
                backgroundColor: ['#dc3545', '#e0eafc']
            }]
        },
        options: { responsive: true, plugins: { legend: { display: false } } }
    });

    // Chart SMA, SMK, SLB
    const smaCtx = document.getElementById('smaChart').getContext('2d');
    new Chart(smaCtx, {
        type: 'radar',
        data: {
            labels: [
                'Literasi Membaca', 'Literasi Numerasi', 
                'Iklim Keamanan', 'Iklim Kebhinekaan', 'Iklim Inklusivitas'
            ],
            datasets: [{
                label: 'SMA',
                data: [80, 78, 85, 90, 88],
                backgroundColor: 'rgba(40,167,69,0.2)',
                borderColor: '#28a745'
            }]
        },
        options: { responsive: true }
    });

    const smkCtx = document.getElementById('smkChart').getContext('2d');
    new Chart(smkCtx, {
        type: 'radar',
        data: {
            labels: [
                'Literasi Membaca', 'Literasi Numerasi', 
                'Iklim Keamanan', 'Iklim Kebhinekaan', 'Iklim Inklusivitas'
            ],
            datasets: [{
                label: 'SMK',
                data: [75, 74, 80, 85, 82],
                backgroundColor: 'rgba(255,193,7,0.2)',
                borderColor: '#ffc107'
            }]
        },
        options: { responsive: true }
    });

    const slbCtx = document.getElementById('slbChart').getContext('2d');
    new Chart(slbCtx, {
        type: 'radar',
        data: {
            labels: [
                'Literasi Membaca', 'Literasi Numerasi', 
                'Iklim Keamanan', 'Iklim Kebhinekaan', 'Iklim Inklusivitas'
            ],
            datasets: [{
                label: 'SLB',
                data: [70, 68, 78, 80, 76],
                backgroundColor: 'rgba(23,162,184,0.2)',
                borderColor: '#17a2b8'
            }]
        },
        options: { responsive: true }
    });
</script>
</body>
</html>