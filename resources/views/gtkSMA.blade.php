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
    <!-- filepath: d:\laragon\www\coba\resources\views\gtkSMK.blade.php -->
    <div class="main-content p-4">
    <div class="dashboard-header">
        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="User Icon">
        <div>
            <h2 class="mb-0">Data GTK SMA</h2>
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
                    <th>Guru PNS</th>
                    <th>Guru GTY</th>
                    <th>Guru GTT</th>
                    <th>Guru P3K</th>
                    <th>Guru S1-S3</th>
                    <th>Guru S1&gt;</th>
                    <th>Guru Sertifikasi</th>
                    <th>Guru Belum Sertifikasi</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($gtk_sma as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->npsn }}</td>
                <td>{{ $item->nama_sekolah }}</td>
                <td>{{ $item->jenjang }}</td>
                <td>{{ $item->status }}</td>
                <td>{{ $item->guru_pns }}</td>
                <td>{{ $item->guru_gty }}</td>
                <td>{{ $item->guru_gtt }}</td>
                <td>{{ $item->guru_p3k }}</td>
                <td>{{ $item->guru_s1_s3 }}</td>
                <td>{{ $item->guru_s1_lebih }}</td>
                <td>{{ $item->guru_sertifikasi }}</td>
                <td>{{ $item->guru_belum_sertifikasi }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
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