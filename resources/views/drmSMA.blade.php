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
    <!-- filepath: d:\laragon\www\coba\resources\views\drmSMK.blade.php -->
    <div class="main-content p-4">
    <div class="dashboard-header">
        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="User Icon">
        <div>
            <h2 class="mb-0">Data Rekap Murid SMA</h2>
            <small class="text-muted">Silakan pilih menu data SMA di bawah ini.</small>
        </div>
    </div>

    <!-- Filter Form -->
    <div class="card mt-4">
        <div class="card-header">
            <h5 class="mb-0">Filter Data</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ url()->current() }}" class="row g-3">
                <div class="col-md-4">
                    <label for="jenjang" class="form-label">Jenjang</label>
                    <select class="form-select" id="jenjang" name="jenjang">
                        <option value="">Semua Jenjang</option>
                        @foreach($jenjangOptions as $option)
                            <option value="{{ $option }}" {{ request('jenjang') == $option ? 'selected' : '' }}>{{ $option }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status">
                        <option value="">Semua Status</option>
                        @foreach($statusOptions as $option)
                            <option value="{{ $option }}" {{ request('status') == $option ? 'selected' : '' }}>{{ $option }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">Filter</button>
                    <a href="{{ url()->current() }}" class="btn btn-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle" style="background-color: #e3f2fd;">
            <thead class="table-dark">
                <tr class="text-center align-middle">
                    <th>No</th>
                    <th>NPSN</th>
                    <th>Nama Sekolah</th>
                    <th>Jenjang</th>
                    <th>Status</th>
                    <th>Siswa Tkt X L</th>
                    <th>Siswa Tkt X P</th>
                    <th>Siswa Tkt XI L</th>
                    <th>Siswa Tkt XI P</th>
                    <th>Siswa Tkt XII L</th>
                    <th>Siswa Tkt XII P</th>
                    <th>Siswa Tkt XIII L</th>
                    <th>Siswa Tkt XIII P</th>
                    <th>Siswa Penerima KIP L</th>
                    <th>Siswa Penerima KIP P</th>
                    <th>Siswa Dari Dalam Kabupaten</th>
                    <th>Siswa Dari Luar Kabupaten</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($drm_sma as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->npsn }}</td>
                <td>{{ $item->nama_sekolah }}</td>
                <td>{{ $item->jenjang }}</td>
                <td>{{ $item->status }}</td>
                <td>{{ $item->siswa_tkt_x_l }}</td>
                <td>{{ $item->siswa_tkt_x_p }}</td>
                <td>{{ $item->siswa_tkt_xi_l }}</td>
                <td>{{ $item->siswa_tkt_xi_p }}</td>
                <td>{{ $item->siswa_tkt_xii_l }}</td>
                <td>{{ $item->siswa_tkt_xii_p }}</td>
                <td>{{ $item->siswa_tkt_xiii_l }}</td>
                <td>{{ $item->siswa_tkt_xiii_p }}</td>
                <td>{{ $item->siswa_penerima_kip_l }}</td>
                <td>{{ $item->siswa_penerima_kip_p }}</td>
                <td>{{ $item->siswa_dari_dalam_kab }}</td>
                <td>{{ $item->siswa_dari_luar_kab }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
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