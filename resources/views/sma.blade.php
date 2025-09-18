<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data SMA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="bg-light">
    <div class="sidebar" id="sidebar">
    <div class="logo">DataPen</div>
    <a href="/dashboard">Dashboard</a>
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
                <h2 class="mb-0">Menu Data SMA</h2>
                <small class="text-muted">Silakan pilih menu data SMA di bawah ini.</small>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-3 mb-4">
                <div class="card menu-card text-center p-4">
                    <div class="menu-icon">🏫</div>
                    <h5 class="card-title mb-2">Data Identitas Sekolah</h5>
                    <a href="/disSMA" class="btn btn-outline-primary mt-2">Lihat Data</a>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card menu-card text-center p-4">
                    <div class="menu-icon">🏢</div>
                    <h5 class="card-title mb-2">Data Sarpras</h5>
                    <a href="/dasarSMA" class="btn btn-outline-primary mt-2">Lihat Data</a>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card menu-card text-center p-4">
                    <div class="menu-icon">👨‍🎓</div>
                    <h5 class="card-title mb-2">Data Rekap Murid</h5>
                    <a href="/drmSMA" class="btn btn-outline-primary mt-2">Lihat Data</a>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card menu-card text-center p-4">
                    <div class="menu-icon">👩‍🏫</div>
                    <h5 class="card-title mb-2">Data Rekap GTK</h5>
                    <a href="/gtkSMA" class="btn btn-outline-primary mt-2">Lihat Data</a>
                </div>
            </div>
        </div>
    </div>
    <script>
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
</script>
</body>
</html>