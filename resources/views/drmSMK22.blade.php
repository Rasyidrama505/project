<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Rekap Murid SMK</title>

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
                <h2 class="mb-0">Data Rekap Murid SMK Tahun 2022</h2>
                <small class="text-muted">Silakan pilih menu data SMK di bawah ini.</small>
            </div>
        </div>

        <a href="/smk" class="btn btn-outline-secondary">
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
            <h5 class="mb-0">Rekapitulasi Murid</h5>
        </div>
        <div class="card-body">
            @php
                // Menghitung semua total di awal agar lebih efisien
                $total_x_l = $drm_smk->sum('siswa_tkt_x_l');
                $total_x_p = $drm_smk->sum('siswa_tkt_x_p');
                $total_xi_l = $drm_smk->sum('siswa_tkt_xi_l');
                $total_xi_p = $drm_smk->sum('siswa_tkt_xi_p');
                $total_xii_l = $drm_smk->sum('siswa_tkt_xii_l');
                $total_xii_p = $drm_smk->sum('siswa_tkt_xii_p');
                $total_xiii_l = $drm_smk->sum('siswa_tkt_xiii_l');
                $total_xiii_p = $drm_smk->sum('siswa_tkt_xiii_p');

                $grand_total_l = $total_x_l + $total_xi_l + $total_xii_l + $total_xiii_l;
                $grand_total_p = $total_x_p + $total_xi_p + $total_xii_p + $total_xiii_p;

                $total_kip = $drm_smk->sum('siswa_penerima_kip');
                $total_dalam_kab = $drm_smk->sum('siswa_dari_dalam_kab');
                $total_luar_kab = $drm_smk->sum('siswa_dari_luar_kab');
            @endphp
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead class="table-light">
                        <tr>
                            <th>Keterangan</th>
                            <th>Laki-laki (L)</th>
                            <th>Perempuan (P)</th>
                            <th>Jumlah Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-start">Tingkat X</td>
                            <td>{{ number_format($total_x_l) }}</td>
                            <td>{{ number_format($total_x_p) }}</td>
                            <td><strong>{{ number_format($total_x_l + $total_x_p) }}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-start">Tingkat XI</td>
                            <td>{{ number_format($total_xi_l) }}</td>
                            <td>{{ number_format($total_xi_p) }}</td>
                            <td><strong>{{ number_format($total_xi_l + $total_xi_p) }}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-start">Tingkat XII</td>
                            <td>{{ number_format($total_xii_l) }}</td>
                            <td>{{ number_format($total_xii_p) }}</td>
                            <td><strong>{{ number_format($total_xii_l + $total_xii_p) }}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-start">Tingkat XIII</td>
                            <td>{{ number_format($total_xiii_l) }}</td>
                            <td>{{ number_format($total_xiii_p) }}</td>
                            <td><strong>{{ number_format($total_xiii_l + $total_xiii_p) }}</strong></td>
                        </tr>
                        <tr class="table-light">
                            <td class="text-start"><strong>Total Siswa</strong></td>
                            <td><strong>{{ number_format($grand_total_l) }}</strong></td>
                            <td><strong>{{ number_format($grand_total_p) }}</strong></td>
                            <td><strong>{{ number_format($grand_total_l + $grand_total_p) }}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-start"><strong>Siswa Penerima KIP</strong></td>
                            <td colspan="3"><strong>{{ number_format($total_kip) }}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-start"><strong>Domisili Dalam Kab.</strong></td>
                            <td colspan="3"><strong>{{ number_format($total_dalam_kab) }}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-start"><strong>Domisili Luar Kab.</strong></td>
                            <td colspan="3"><strong>{{ number_format($total_luar_kab) }}</strong></td>
                        </tr>
                    </tbody>
                </table>
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
                    <th colspan="2">Tingkat X</th>
                    <th colspan="2">Tingkat XI</th>
                    <th colspan="2">Tingkat XII</th>
                    <th colspan="2">Tingkat XIII</th>
                    <th rowspan="2">Siswa Penerima KIP</th>
                    <th colspan="2">Domisili Siswa</th>
                </tr>
                <tr>
                    <th>L</th>
                    <th>P</th>
                    <th>L</th>
                    <th>P</th>
                    <th>L</th>
                    <th>P</th>
                    <th>L</th>
                    <th>P</th>
                    <th>Dalam Kab.</th>
                    <th>Luar Kab.</th>
                </tr>
            </thead>
            <tbody class="text-center align-middle">
                @forelse ($drm_smk as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->npsn }}</td>
                    <td class="text-start">{{ $item->namasekolah }}</td>
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
                    <td>{{ $item->siswa_penerima_kip }}</td>
                    <td>{{ $item->siswa_dari_dalam_kab }}</td>
                    <td>{{ $item->siswa_dari_luar_kab }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="16" class="text-center">Tidak ada data rekap murid SMK</td>
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
