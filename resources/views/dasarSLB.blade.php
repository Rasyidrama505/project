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
            <h2 class="mb-0">Data Sarpras SLB</h2>
            <small class="text-muted">Silakan pilih menu data SLB di bawah ini.</small>
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

    <div class="table-responsive mt-4">
        <table class="table table-bordered table-striped">
            <thead class="table-dark text-center align-middle">
                <tr>
                    <th>No</th>
                    <th>NPSN</th>
                    <th>Nama Sekolah</th>
                    <th>Jenjang</th>
                    <th>Status</th>
                    <th>R.Kls Baik</th>
                    <th>R.Kls Rusak Ringan</th>
                    <th>R.Kls Rusak Sedang</th>
                    <th>R.Kls Rusak Berat</th>
                    <th>Perpustakaan Baik</th>
                    <th>Perpustakaan Rusak Ringan</th>
                    <th>Perpustakaan Rusak Sedang</th>
                    <th>Perpustakaan Rusak Berat</th>
                    <th>Toilet Guru Pria Baik</th>
                    <th>Toilet Guru Pria Rusak Ringan</th>
                    <th>Toilet Guru Pria Rusak Sedang</th>
                    <th>Toilet Guru Pria Rusak Berat</th>
                    <th>Toilet Guru Wanita Baik</th>
                    <th>Toilet Guru Wanita Rusak Ringan</th>
                    <th>Toilet Guru Wanita Rusak Sedang</th>
                    <th>Toilet Guru Wanita Rusak Berat</th>
                    <th>Toilet Murid Pria Baik</th>
                    <th>Toilet Murid Pria Rusak Ringan</th>
                    <th>Toilet Murid Pria Rusak Sedang</th>
                    <th>Toilet Murid Pria Rusak Berat</th>
                    <th>Toilet Murid Wanita Baik</th>
                    <th>Toilet Murid Wanita Rusak Ringan</th>
                    <th>Toilet Murid Wanita Rusak Sedang</th>
                    <th>Toilet Murid Wanita Rusak Berat</th>
                    <th>R.UKS Baik</th>
                    <th>R.UKS Rusak Ringan</th>
                    <th>R.UKS Rusak Berat</th>
                    <th>Lab Komputer Baik</th>
                    <th>Lab Komputer Rusak Ringan</th>
                    <th>Lab Komputer Rusak Sedang</th>
                    <th>Lab Komputer Rusak Berat</th>
                    <th>Unit Komputer</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sarpras_slb as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->npsn }}</td>
                    <td>{{ $item->namasekolah }}</td>
                    <td>{{ $item->jenjang }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->r_kls_baik }}</td>
                    <td>{{ $item->r_kls_rusak_ringan }}</td>
                    <td>{{ $item->r_kls_rusak_sedang }}</td>
                    <td>{{ $item->r_kls_rusak_berat }}</td>
                    <td>{{ $item->perpustakaan_baik }}</td>
                    <td>{{ $item->perpustakaan_rusak_ringan }}</td>
                    <td>{{ $item->perpustakaan_rusak_sedang }}</td>
                    <td>{{ $item->perpustakaan_rusak_berat }}</td>
                    <td>{{ $item->toilet_guru_pria_baik }}</td>
                    <td>{{ $item->toilet_guru_pria_rusak_ringan }}</td>
                    <td>{{ $item->toilet_guru_pria_rusak_sedang }}</td>
                    <td>{{ $item->toilet_guru_pria_rusak_berat }}</td>
                    <td>{{ $item->toilet_guru_wanita_baik }}</td>
                    <td>{{ $item->toilet_guru_wanita_rusak_ringan }}</td>
                    <td>{{ $item->toilet_guru_wanita_rusak_sedang }}</td>
                    <td>{{ $item->toilet_guru_wanita_rusak_berat }}</td>
                    <td>{{ $item->toilet_murid_pria_baik }}</td>
                    <td>{{ $item->toilet_murid_pria_rusak_ringan }}</td>
                    <td>{{ $item->toilet_murid_pria_rusak_sedang }}</td>
                    <td>{{ $item->toilet_murid_pria_rusak_berat }}</td>
                    <td>{{ $item->toilet_murid_wanita_baik }}</td>
                    <td>{{ $item->toilet_murid_wanita_rusak_ringan }}</td>
                    <td>{{ $item->toilet_murid_wanita_rusak_sedang }}</td>
                    <td>{{ $item->toilet_murid_wanita_rusak_berat }}</td>
                    <td>{{ $item->r_uks_baik }}</td>
                    <td>{{ $item->r_uks_rusak_ringan }}</td>
                    <td>{{ $item->r_uks_rusak_berat }}</td>
                    <td>{{ $item->lab_komputer_baik }}</td>
                    <td>{{ $item->lab_komputer_rusak_ringan }}</td>
                    <td>{{ $item->lab_komputer_rusak_sedang }}</td>
                    <td>{{ $item->lab_komputer_rusak_berat }}</td>
                    <td>{{ $item->unit_komputer }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
