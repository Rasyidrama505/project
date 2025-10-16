<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data GTK SLB</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="bg-light">

<div class="sidebar" id="sidebar">
    <div class="logo">SIDIK DIY</div>
    <a href="/dashboard"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
    <div class="dropdown">
        <a href="#" class="dropdown-toggle" id="dataSekolahBtn"><i class="bi bi-building me-2"></i>Data Sekolah</a>
        <div class="dropdown-menu" id="dataSekolahDropdown" style="display:none; background:#34495e;">
            <a href="/sma" class="dropdown-item">SMA</a>
            <a href="/smk" class="dropdown-item">SMK</a>
            <a href="/slb" class="dropdown-item">SLB</a>
        </div>
    </div>
    <a href="/login"><i class="bi bi-box-arrow-right me-2"></i>Logout</a>
</div>

<div class="main-content p-4">

    <div class="dashboard-header d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="User Icon" class="me-3" style="width: 50px; height: 50px;">
            <div>
                <h2 class="mb-0">Data Rekap GTK SLB Tahun 2025</h2>
                <small class="text-muted">Silakan pilih menu data SLB di bawah ini.</small>
            </div>
        </div>

        <a href="/slb" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

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

    <div class="card mt-4">
        <div class="card-header">
            <h5 class="mb-0">Rekapitulasi GTK (Guru dan Tenaga Kependidikan)</h5>
        </div>
        <div class="card-body">
            @php
                $pns = $gtk_slb->sum('guru_pns');
                $gty = $gtk_slb->sum('guru_gty');
                $gtt = $gtk_slb->sum('guru_gtt');
                $p3k = $gtk_slb->sum('guru_p3k');
                $total_guru = $pns + $gty + $gtt + $p3k;

                $s1_s3 = $gtk_slb->sum('guru_s1_s3');
                $kurang_s1 = $gtk_slb->sum('guru_s1_lebih');

                $sertifikasi = $gtk_slb->sum('guru_sertifikasi');
                $belum_sertifikasi = $gtk_slb->sum('guru_belum_sertifikasi');
            @endphp
            <div class="row">
                <div class="col-md-4">
                    <table class="table table-sm table-bordered text-center">
                        <thead class="table-light">
                            <tr><th colspan="2">Status Kepegawaian</th></tr>
                        </thead>
                        <tbody>
                            <tr><td class="text-start">PNS</td><td>{{ number_format($pns) }}</td></tr>
                            <tr><td class="text-start">GTY</td><td>{{ number_format($gty) }}</td></tr>
                            <tr><td class="text-start">GTT</td><td>{{ number_format($gtt) }}</td></tr>
                            <tr><td class="text-start">P3K</td><td>{{ number_format($p3k) }}</td></tr>
                            <tr class="table-light">
                                <td class="text-start"><strong>Total Guru</strong></td>
                                <td><strong>{{ number_format($total_guru) }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-4">
                    <table class="table table-sm table-bordered text-center">
                        <thead class="table-light">
                            <tr><th colspan="2">Kualifikasi Akademik</th></tr>
                        </thead>
                        <tbody>
                            <tr><td class="text-start">S1 - S3</td><td>{{ number_format($s1_s3) }}</td></tr>
                            <tr><td class="text-start">< S1</td><td>{{ number_format($kurang_s1) }}</td></tr>
                            <tr class="table-light">
                                <td class="text-start"><strong>Total</strong></td>
                                <td><strong>{{ number_format($s1_s3 + $kurang_s1) }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-4">
                    <table class="table table-sm table-bordered text-center">
                        <thead class="table-light">
                            <tr><th colspan="2">Sertifikasi Guru</th></tr>
                        </thead>
                        <tbody>
                            <tr><td class="text-start">Sudah Tersertifikasi</td><td>{{ number_format($sertifikasi) }}</td></tr>
                            <tr><td class="text-start">Belum Tersertifikasi</td><td>{{ number_format($belum_sertifikasi) }}</td></tr>
                            <tr class="table-light">
                                <td class="text-start"><strong>Total</strong></td>
                                <td><strong>{{ number_format($sertifikasi + $belum_sertifikasi) }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive mt-4">
        <table class="table table-striped table-hover table-bordered">
            <thead class="table-light text-center align-middle">
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">NPSN</th>
                    <th rowspan="2">Nama Sekolah</th>
                    <th rowspan="2">Jenjang</th>
                    <th rowspan="2">Status</th>
                    <th colspan="4">Status Kepegawaian Guru</th>
                    <th colspan="2">Kualifikasi Akademik Guru</th>
                    <th colspan="2">Sertifikasi Guru</th>
                </tr>
                <tr>
                    <th>PNS</th>
                    <th>GTY</th>
                    <th>GTT</th>
                    <th>P3K</th>
                    <th>S1-S3</th>
                    <th><S1</th>
                    <th>Sudah</th>
                    <th>Belum</th>
                </tr>
            </thead>
            <tbody class="text-center align-middle">
                @forelse ($gtk_slb as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->npsn }}</td>
                    <td class="text-start">{{ $item->namasekolah }}</td>
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
                @empty
                <tr>
                    <td colspan="13" class="text-center">Tidak ada data GTK SLB</td>
                </tr>
                @endforelse
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
