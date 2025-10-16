<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Sarpras SMK</title>

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
                <h2 class="mb-0">Data Sarpras SMK Tahun 2022</h2>
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
            <h5 class="mb-0">Rekapitulasi Data Sarpras</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">
                    <thead class="table-light align-middle">
                        <tr>
                            <th>Sarana Prasarana</th>
                            <th>Baik</th>
                            <th>Rusak Ringan</th>
                            <th>Rusak Sedang</th>
                            <th>Rusak Berat</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-start">Ruang Kelas</td>
                            <td>{{ $sarpras_smk->sum('r_kls_baik') }}</td>
                            <td>{{ $sarpras_smk->sum('r_kls_rusak_ringan') }}</td>
                            <td>{{ $sarpras_smk->sum('r_kls_rusak_sedang') }}</td>
                            <td>{{ $sarpras_smk->sum('r_kls_rusak_berat') }}</td>
                            <td><strong>{{ $sarpras_smk->sum('r_kls_baik') + $sarpras_smk->sum('r_kls_rusak_ringan') + $sarpras_smk->sum('r_kls_rusak_sedang') + $sarpras_smk->sum('r_kls_rusak_berat') }}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-start">Perpustakaan</td>
                            <td>{{ $sarpras_smk->sum('perpustakaan_baik') }}</td>
                            <td>{{ $sarpras_smk->sum('perpustakaan_rusak_ringan') }}</td>
                            <td>{{ $sarpras_smk->sum('perpustakaan_rusak_sedang') }}</td>
                            <td>{{ $sarpras_smk->sum('perpustakaan_rusak_berat') }}</td>
                            <td><strong>{{ $sarpras_smk->sum('perpustakaan_baik') + $sarpras_smk->sum('perpustakaan_rusak_ringan') + $sarpras_smk->sum('perpustakaan_rusak_sedang') + $sarpras_smk->sum('perpustakaan_rusak_berat') }}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-start">Toilet Guru Pria</td>
                            <td>{{ $sarpras_smk->sum('toilet_guru_pria_baik') }}</td>
                            <td>{{ $sarpras_smk->sum('toilet_guru_pria_rusak_ringan') }}</td>
                            <td>{{ $sarpras_smk->sum('toilet_guru_pria_rusak_sedang') }}</td>
                            <td>{{ $sarpras_smk->sum('toilet_guru_pria_rusak_berat') }}</td>
                            <td><strong>{{ $sarpras_smk->sum('toilet_guru_pria_baik') + $sarpras_smk->sum('toilet_guru_pria_rusak_ringan') + $sarpras_smk->sum('toilet_guru_pria_rusak_sedang') + $sarpras_smk->sum('toilet_guru_pria_rusak_berat') }}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-start">Toilet Guru Wanita</td>
                            <td>{{ $sarpras_smk->sum('toilet_guru_wanita_baik') }}</td>
                            <td>{{ $sarpras_smk->sum('toilet_guru_wanita_rusak_ringan') }}</td>
                            <td>{{ $sarpras_smk->sum('toilet_guru_wanita_rusak_sedang') }}</td>
                            <td>{{ $sarpras_smk->sum('toilet_guru_wanita_rusak_berat') }}</td>
                            <td><strong>{{ $sarpras_smk->sum('toilet_guru_wanita_baik') + $sarpras_smk->sum('toilet_guru_wanita_rusak_ringan') + $sarpras_smk->sum('toilet_guru_wanita_rusak_sedang') + $sarpras_smk->sum('toilet_guru_wanita_rusak_berat') }}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-start">Toilet Murid Pria</td>
                            <td>{{ $sarpras_smk->sum('toilet_murid_pria_baik') }}</td>
                            <td>{{ $sarpras_smk->sum('toilet_murid_pria_rusak_ringan') }}</td>
                            <td>{{ $sarpras_smk->sum('toilet_murid_pria_rusak_sedang') }}</td>
                            <td>{{ $sarpras_smk->sum('toilet_murid_pria_rusak_berat') }}</td>
                            <td><strong>{{ $sarpras_smk->sum('toilet_murid_pria_baik') + $sarpras_smk->sum('toilet_murid_pria_rusak_ringan') + $sarpras_smk->sum('toilet_murid_pria_rusak_sedang') + $sarpras_smk->sum('toilet_murid_pria_rusak_berat') }}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-start">Toilet Murid Wanita</td>
                            <td>{{ $sarpras_smk->sum('toilet_murid_wanita_baik') }}</td>
                            <td>{{ $sarpras_smk->sum('toilet_murid_wanita_rusak_ringan') }}</td>
                            <td>{{ $sarpras_smk->sum('toilet_murid_wanita_rusak_sedang') }}</td>
                            <td>{{ $sarpras_smk->sum('toilet_murid_wanita_rusak_berat') }}</td>
                            <td><strong>{{ $sarpras_smk->sum('toilet_murid_wanita_baik') + $sarpras_smk->sum('toilet_murid_wanita_rusak_ringan') + $sarpras_smk->sum('toilet_murid_wanita_rusak_sedang') + $sarpras_smk->sum('toilet_murid_wanita_rusak_berat') }}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-start">R. UKS</td>
                            <td>{{ $sarpras_smk->sum('r_uks_baik') }}</td>
                            <td>{{ $sarpras_smk->sum('r_uks_rusak_ringan') }}</td>
                            <td>-</td>
                            <td>{{ $sarpras_smk->sum('r_uks_rusak_berat') }}</td>
                            <td><strong>{{ $sarpras_smk->sum('r_uks_baik') + $sarpras_smk->sum('r_uks_rusak_ringan') + $sarpras_smk->sum('r_uks_rusak_berat') }}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-start">Lab Komputer</td>
                            <td>{{ $sarpras_smk->sum('lab_komputer_baik') }}</td>
                            <td>{{ $sarpras_smk->sum('lab_komputer_rusak_ringan') }}</td>
                            <td>{{ $sarpras_smk->sum('lab_komputer_rusak_sedang') }}</td>
                            <td>{{ $sarpras_smk->sum('lab_komputer_rusak_berat') }}</td>
                            <td><strong>{{ $sarpras_smk->sum('lab_komputer_baik') + $sarpras_smk->sum('lab_komputer_rusak_ringan') + $sarpras_smk->sum('lab_komputer_rusak_sedang') + $sarpras_smk->sum('lab_komputer_rusak_berat') }}</strong></td>
                        </tr>
                        <tr class="table-light">
                            <td class="text-start"><strong>Unit Komputer</strong></td>
                            <td colspan="5"><strong>{{ $sarpras_smk->sum('unit_komputer') }}</strong></td>
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
                    <th colspan="4">Ruang Kelas</th>
                    <th colspan="4">Perpustakaan</th>
                    <th colspan="4">Toilet Guru Pria</th>
                    <th colspan="4">Toilet Guru Wanita</th>
                    <th colspan="4">Toilet Murid Pria</th>
                    <th colspan="4">Toilet Murid Wanita</th>
                    <th colspan="3">R. UKS</th>
                    <th colspan="4">Lab Komputer</th>
                    <th rowspan="2">Unit Komputer</th>
                </tr>
                <tr>
                    <th>Baik</th><th>Rsk Ringan</th><th>Rsk Sedang</th><th>Rsk Berat</th>
                    <th>Baik</th><th>Rsk Ringan</th><th>Rsk Sedang</th><th>Rsk Berat</th>
                    <th>Baik</th><th>Rsk Ringan</th><th>Rsk Sedang</th><th>Rsk Berat</th>
                    <th>Baik</th><th>Rsk Ringan</th><th>Rsk Sedang</th><th>Rsk Berat</th>
                    <th>Baik</th><th>Rsk Ringan</th><th>Rsk Sedang</th><th>Rsk Berat</th>
                    <th>Baik</th><th>Rsk Ringan</th><th>Rsk Sedang</th><th>Rsk Berat</th>
                    <th>Baik</th><th>Rsk Ringan</th><th>Rsk Berat</th>
                    <th>Baik</th><th>Rsk Ringan</th><th>Rsk Sedang</th><th>Rsk Berat</th>
                </tr>
            </thead>
            <tbody class="text-center align-middle">
                @forelse($sarpras_smk as $index => $data)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td class="text-start">{{ $data->npsn ?? '' }}</td>
                    <td class="text-start">{{ $data->namasekolah ?? '' }}</td>
                    <td>{{ $data->jenjang ?? '' }}</td>
                    <td>{{ $data->status ?? '' }}</td>
                    <td>{{ $data->r_kls_baik ?? '' }}</td>
                    <td>{{ $data->r_kls_rusak_ringan ?? '' }}</td>
                    <td>{{ $data->r_kls_rusak_sedang ?? '' }}</td>
                    <td>{{ $data->r_kls_rusak_berat ?? '' }}</td>
                    <td>{{ $data->perpustakaan_baik ?? '' }}</td>
                    <td>{{ $data->perpustakaan_rusak_ringan ?? '' }}</td>
                    <td>{{ $data->perpustakaan_rusak_sedang ?? '' }}</td>
                    <td>{{ $data->perpustakaan_rusak_berat ?? '' }}</td>
                    <td>{{ $data->toilet_guru_pria_baik ?? '' }}</td>
                    <td>{{ $data->toilet_guru_pria_rusak_ringan ?? '' }}</td>
                    <td>{{ $data->toilet_guru_pria_rusak_sedang ?? '' }}</td>
                    <td>{{ $data->toilet_guru_pria_rusak_berat ?? '' }}</td>
                    <td>{{ $data->toilet_guru_wanita_baik ?? '' }}</td>
                    <td>{{ $data->toilet_guru_wanita_rusak_ringan ?? '' }}</td>
                    <td>{{ $data->toilet_guru_wanita_rusak_sedang ?? '' }}</td>
                    <td>{{ $data->toilet_guru_wanita_rusak_berat ?? '' }}</td>
                    <td>{{ $data->toilet_murid_pria_baik ?? '' }}</td>
                    <td>{{ $data->toilet_murid_pria_rusak_ringan ?? '' }}</td>
                    <td>{{ $data->toilet_murid_pria_rusak_sedang ?? '' }}</td>
                    <td>{{ $data->toilet_murid_pria_rusak_berat ?? '' }}</td>
                    <td>{{ $data->toilet_murid_wanita_baik ?? '' }}</td>
                    <td>{{ $data->toilet_murid_wanita_rusak_ringan ?? '' }}</td>
                    <td>{{ $data->toilet_murid_wanita_rusak_sedang ?? '' }}</td>
                    <td>{{ $data->toilet_murid_wanita_rusak_berat ?? '' }}</td>
                    <td>{{ $data->r_uks_baik ?? '' }}</td>
                    <td>{{ $data->r_uks_rusak_ringan ?? '' }}</td>
                    <td>{{ $data->r_uks_rusak_berat ?? '' }}</td>
                    <td>{{ $data->lab_komputer_baik ?? '' }}</td>
                    <td>{{ $data->lab_komputer_rusak_ringan ?? '' }}</td>
                    <td>{{ $data->lab_komputer_rusak_sedang ?? '' }}</td>
                    <td>{{ $data->lab_komputer_rusak_berat ?? '' }}</td>
                    <td>{{ $data->unit_komputer ?? '' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="37" class="text-center">Tidak ada data sarpras SMK</td>
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
