<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Menu Data SLB</title>
    
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
    <!-- Perbaikan Logout: Menggunakan form untuk POST request -->
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
            <h2 class="mb-0">Menu Data SLB</h2>
            <small class="text-muted">Silakan pilih salah satu menu di bawah ini untuk melihat data detail.</small>
        </div>
    </div>

    <div class="row pt-4">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card menu-card text-center h-100">
                <div class="card-body d-flex flex-column justify-content-center">
                    <i class="bi bi-bank fs-1 text-primary"></i>
                    <h5 class="card-title mt-3 mb-2">Data Identitas Sekolah</h5>
                    <button class="btn btn-primary mt-auto" data-bs-toggle="modal" data-bs-target="#yearSelectionModal" data-title="Data Identitas Sekolah" data-url="/disSLB">
                        Lihat Data
                    </button>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card menu-card text-center h-100">
                <div class="card-body d-flex flex-column justify-content-center">
                    <i class="bi bi-building-gear fs-1 text-success"></i>
                    <h5 class="card-title mt-3 mb-2">Data Sarpras</h5>
                    <button class="btn btn-success mt-auto" data-bs-toggle="modal" data-bs-target="#yearSelectionModal" data-title="Data Sarpras" data-url="/dasarSLB">
                        Lihat Data
                    </button>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card menu-card text-center h-100">
                <div class="card-body d-flex flex-column justify-content-center">
                    <i class="bi bi-people-fill fs-1 text-warning"></i>
                    <h5 class="card-title mt-3 mb-2">Data Rekap Murid</h5>
                    <button class="btn btn-warning mt-auto" data-bs-toggle="modal" data-bs-target="#yearSelectionModal" data-title="Data Rekap Murid" data-url="/drmSLB">
                        Lihat Data
                    </button>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card menu-card text-center h-100">
                <div class="card-body d-flex flex-column justify-content-center">
                    <i class="bi bi-person-video3 fs-1 text-danger"></i>
                    <h5 class="card-title mt-3 mb-2">Data Rekap GTK</h5>
                    <button class="btn btn-danger mt-auto" data-bs-toggle="modal" data-bs-target="#yearSelectionModal" data-title="Data Rekap GTK" data-url="/gtkSLB">
                        Lihat Data
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="yearSelectionModal" tabindex="-1" aria-labelledby="yearModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="yearModalLabel">Pilih Tahun</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Silakan pilih tahun data yang ingin Anda lihat.</p>
                <select class="form-select" id="yearSelect">
                    @for ($year = 2020; $year <= 2025; $year++)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endfor
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <a href="#" id="modalContinueBtn" class="btn btn-primary">Lanjutkan</a>
            </div>
        </div>
    </div>
</div>


<script>
    // Script untuk dropdown sidebar (tetap sama)
    const sidebarBtn = document.getElementById('dataSekolahBtn');
    const sidebarDropdown = document.getElementById('dataSekolahDropdown');
    sidebarBtn.addEventListener('click', function(e) {
        e.preventDefault();
        sidebarDropdown.style.display = sidebarDropdown.style.display === 'none' ? 'block' : 'none';
    });
    document.addEventListener('click', function(e) {
        if (!sidebarBtn.contains(e.target) && !sidebarDropdown.contains(e.target)) {
            sidebarDropdown.style.display = 'none';
        }
    });

    // --- Script BARU untuk Modal Pilihan Tahun ---
    const yearModal = document.getElementById('yearSelectionModal');
    const yearSelect = document.getElementById('yearSelect');
    const modalContinueBtn = document.getElementById('modalContinueBtn');
    let baseUrl = ''; 

    // Fungsi baru untuk membuat URL sesuai format yang diinginkan
    function generateDynamicUrl(url, year) {
        if (year == '2020') {
            return url; // Untuk tahun 2020, gunakan URL dasar (contoh: /disSLB)
        } else {
            // Untuk tahun lain, ambil 2 digit terakhir dan tambahkan ke URL
            const yearSuffix = year.slice(-2); // '2021' -> '21'
            return url + yearSuffix; // contoh: /disSLB21
        }
    }

    // Event listener saat modal akan ditampilkan
    yearModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const title = button.getAttribute('data-title');
        baseUrl = button.getAttribute('data-url');
        
        const modalTitle = yearModal.querySelector('.modal-title');
        modalTitle.textContent = 'Pilih Tahun untuk ' + title;

        const selectedYear = yearSelect.value;
        // Gunakan fungsi baru untuk membuat URL awal
        modalContinueBtn.href = generateDynamicUrl(baseUrl, selectedYear);
    });

    // Event listener saat pilihan tahun di dalam modal berubah
    yearSelect.addEventListener('change', function() {
        const selectedYear = this.value;
        // Gunakan fungsi baru untuk update URL
        modalContinueBtn.href = generateDynamicUrl(baseUrl, selectedYear);
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
