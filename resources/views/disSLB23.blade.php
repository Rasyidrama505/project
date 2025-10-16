<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Identitas Sekolah SLB</title>

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
                <h2 class="mb-0">Data Identitas Sekolah SLB Tahun 2023</h2>
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
                <div class="col-md-3">
                    <label for="jenjang" class="form-label">Jenjang</label>
                    <select class="form-select" id="jenjang" name="jenjang">
                        <option value="">Semua Jenjang</option>
                        @foreach($jenjangOptions as $option)
                            <option value="{{ $option }}" {{ request('jenjang') == $option ? 'selected' : '' }}>{{ $option }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status">
                        <option value="">Semua Status</option>
                        @foreach($statusOptions as $option)
                            <option value="{{ $option }}" {{ request('status') == $option ? 'selected' : '' }}>{{ $option }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="kabupaten_kota" class="form-label">Kabupaten/Kota</label>
                    <select class="form-select" id="kabupaten_kota" name="kabupaten_kota">
                        <option value="">Semua Kabupaten/Kota</option>
                        @foreach($kabupatenKotaOptions as $option)
                            <option value="{{ $option }}" {{ request('kabupaten_kota') == $option ? 'selected' : '' }}>{{ $option }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">Filter</button>
                    <a href="{{ url()->current() }}" class="btn btn-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card mt-4">
    <div class="card-header">
        <h5 class="mb-0">Rekapitulasi Identitas Sekolah</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <table class="table table-sm table-bordered text-center">
                    <thead class="table-light">
                        <tr><th colspan="2">Jumlah Sekolah</th></tr>
                    </thead>
                    <tbody>
                        {{-- Perbaikan: Menggunakan filter() dan strtolower() agar tidak case-sensitive --}}
                        <tr><td class="text-start">Negeri</td><td>{{ $dis_slb->filter(fn($item) => strtolower(trim($item->status)) === 'negeri')->count() }}</td></tr>
                        <tr><td class="text-start">Swasta</td><td>{{ $dis_slb->filter(fn($item) => strtolower(trim($item->status)) === 'swasta')->count() }}</td></tr>
                        <tr class="table-light">
                            <td class="text-start"><strong>Total</strong></td>
                            <td><strong>{{ $dis_slb->count() }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-md-3">
                {{-- Perbaikan: Menggunakan trim() saat groupBy untuk menghilangkan spasi --}}
                @php
                    $kabupatenCounts = $dis_slb->groupBy(fn($item) => trim($item->kabupaten_kota));
                @endphp
                <table class="table table-sm table-bordered text-center">
                    <thead class="table-light">
                        <tr><th colspan="2">Sebaran per Kabupaten/Kota</th></tr>
                    </thead>
                    <tbody>
                        @foreach($kabupatenKotaOptions as $kab)
                            <tr>
                                <td class="text-start">{{ $kab }}</td>
                                {{-- Kode .get() sudah benar dari perbaikan sebelumnya --}}
                                <td>{{ $kabupatenCounts->get($kab)?->count() ?? 0 }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-md-3">
                @php
                    $akreditasiCounts = $dis_slb->groupBy('akreditasi');
                    $akreditasiOptions = $dis_slb->pluck('akreditasi')->filter()->unique()->sort();
                @endphp
                <table class="table table-sm table-bordered text-center">
                    <thead class="table-light">
                        <tr><th colspan="2">Berdasarkan Akreditasi</th></tr>
                    </thead>
                    <tbody>
                        @foreach($akreditasiOptions as $akr)
                            <tr>
                                <td>Akreditasi {{ $akr }}</td>
                                <td>{{ $akreditasiCounts->get($akr)?->count() ?? 0 }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-md-3">
                <table class="table table-sm table-bordered text-center">
                    <thead class="table-light">
                        <tr><th colspan="2">Jumlah Ruangan Belajar</th></tr>
                    </thead>
                    <tbody>
                        <tr><td class="text-start">Tingkat X</td><td>{{ $dis_slb->sum('jml_rombel_tkt_x') }}</td></tr>
                        <tr><td class="text-start">Tingkat XI</td><td>{{ $dis_slb->sum('jml_rombel_tkt_xi') }}</td></tr>
                        <tr><td class="text-start">Tingkat XII</td><td>{{ $dis_slb->sum('jml_rombel_tkt_xii') }}</td></tr>
                        <tr><td class="text-start">Tingkat XIII</td><td>{{ $dis_slb->sum('jml_rombel_tkt_xiii') }}</td></tr>
                        <tr class="table-light">
                            <td class="text-start"><strong>Total Rombel</strong></td>
                            <td><strong>{{ $dis_slb->sum('jml_rombel_tkt_x') + $dis_slb->sum('jml_rombel_tkt_xi') + $dis_slb->sum('jml_rombel_tkt_xii') + $dis_slb->sum('jml_rombel_tkt_xiii') }}</strong></td>
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
                    <th rowspan="2">Kabupaten/Kota</th>
                    <th rowspan="2">Kecamatan</th>
                    <th rowspan="2">Kelurahan</th>
                    <th rowspan="2">E-mail</th>
                    <th rowspan="2">No Telp</th>
                    <th rowspan="2">Akreditasi</th>
                    <th colspan="4">Jumlah Rombel</th>
                </tr>
                <tr>
                    <th>Tingkat X</th>
                    <th>Tingkat XI</th>
                    <th>Tingkat XII</th>
                    <th>Tingkat XIII</th>
                </tr>
            </thead>
            <tbody class="text-center align-middle">
                @forelse ($dis_slb as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->npsn }}</td>
                    <td class="text-start">{{ $item->nama_sekolah }}</td>
                    <td>{{ $item->jenjang }}</td>
                    <td>{{ $item->status }}</td>
                    <td class="text-start">{{ $item->kabupaten_kota }}</td>
                    <td class="text-start">{{ $item->kecamatan }}</td>
                    <td class="text-start">{{ $item->kelurahan }}</td>
                    <td class="text-start">{{ $item->email }}</td>
                    <td>{{ $item->no_telp }}</td>
                    <td>{{ $item->akreditasi }}</td>
                    <td>{{ $item->jml_rombel_tkt_x }}</td>
                    <td>{{ $item->jml_rombel_tkt_xi }}</td>
                    <td>{{ $item->jml_rombel_tkt_xii }}</td>
                    <td>{{ $item->jml_rombel_tkt_xiii }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="15" class="text-center">Tidak ada data yang cocok dengan filter Anda.</td>
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
