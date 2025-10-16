<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SMAController extends Controller
{
    /**
     * Menampilkan halaman dashboard dengan data agregat.
     */
    public function showDashboard()
    {
        // ===================================
        // Menghitung Total Sekolah, Murid, dan Guru
        // ===================================
        $totalSekolahSma = DB::table('dis_sma')->count();
        $totalSekolahSmk = DB::table('dis_smk')->count();
        $totalSekolahSlb = DB::table('dis_slb')->count();
        $totalSekolah2020 = $totalSekolahSma + $totalSekolahSmk + $totalSekolahSlb;

        $totalMuridSma = DB::table('drm_sma')->sum(DB::raw('siswa_tkt_x_l + siswa_tkt_x_p + siswa_tkt_xi_l + siswa_tkt_xi_p + siswa_tkt_xii_l + siswa_tkt_xii_p'));
        $totalMuridSmk = DB::table('drm_smk')->sum(DB::raw('siswa_tkt_x_l + siswa_tkt_x_p + siswa_tkt_xi_l + siswa_tkt_xi_p + siswa_tkt_xii_l + siswa_tkt_xii_p + siswa_tkt_xiii_l + siswa_tkt_xiii_p'));
        $totalMuridSlb = DB::table('drm_slb')->sum(DB::raw('siswa_tkt_x_l + siswa_tkt_x_p + siswa_tkt_xi_l + siswa_tkt_xi_p + siswa_tkt_xii_l + siswa_tkt_xii_p + siswa_tkt_xiii_l + siswa_tkt_xiii_p'));
        $totalMurid2020 = $totalMuridSma + $totalMuridSmk + $totalMuridSlb;

        $totalGuruSma = DB::table('gtk_sma')->sum(DB::raw('guru_pns + guru_gty + guru_gtt + guru_p3k'));
        $totalGuruSmk = DB::table('gtk_smk')->sum(DB::raw('guru_pns + guru_gty + guru_gtt + guru_p3k'));
        $totalGuruSlb = DB::table('gtk_slb')->sum(DB::raw('guru_pns + guru_gty + guru_gtt + guru_p3k'));
        $totalGuru2020 = $totalGuruSma + $totalGuruSmk + $totalGuruSlb;

        // =====================================================================
        // Logika untuk mengambil data chart
        // =====================================================================
        $sekolahSma = DB::table('dis_sma')->select('kabupaten_kota', DB::raw('count(*) as total'))->groupBy('kabupaten_kota')->get();
        $sekolahSmk = DB::table('dis_smk')->select('kabupaten_kota', DB::raw('count(*) as total'))->groupBy('kabupaten_kota')->get();
        $sekolahSlb = DB::table('dis_slb')->select('kabupaten_kota', DB::raw('count(*) as total'))->groupBy('kabupaten_kota')->get();

        $sekolahPerKabupaten = [];
        $allSekolah = $sekolahSma->concat($sekolahSmk)->concat($sekolahSlb);

        foreach ($allSekolah as $data) {
            $namaStandar = 'Lainnya';
            $namaInput = strtolower($data->kabupaten_kota);

            if (strpos($namaInput, 'bantul') !== false) {
                $namaStandar = 'Kab. Bantul';
            } elseif (strpos($namaInput, 'sleman') !== false) {
                $namaStandar = 'Kab. Sleman';
            } elseif (strpos($namaInput, 'gunung kidul') !== false || strpos($namaInput, 'gunungkidul') !== false) {
                $namaStandar = 'Kab. Gunung Kidul';
            } elseif (strpos($namaInput, 'kulon progo') !== false || strpos($namaInput, 'kulonprogo') !== false) {
                $namaStandar = 'Kab. Kulon Progo';
            } elseif (strpos($namaInput, 'yogyakarta') !== false) {
                $namaStandar = 'Kota Yogyakarta';
            }
            
            $sekolahPerKabupaten[$namaStandar] = ($sekolahPerKabupaten[$namaStandar] ?? 0) + $data->total;
        }
        
        $labelsKabupaten = array_keys($sekolahPerKabupaten);
        $dataKabupaten = array_values($sekolahPerKabupaten);


        // =====================================================================
        // Mengembalikan view 'dashboard' dan mengirim semua data
        // =====================================================================
        return view('dashboard', compact(
            'totalSekolah2020', 'totalSekolahSma', 'totalSekolahSmk', 'totalSekolahSlb',
            'totalMurid2020', 'totalMuridSma', 'totalMuridSmk', 'totalMuridSlb',
            'totalGuru2020', 'totalGuruSma', 'totalGuruSmk', 'totalGuruSlb',
            'labelsKabupaten', 'dataKabupaten'
        ));
    }

    public function index()
    {
        $sma = DB::table('dis_sma')->get();
        return view('sma', compact('sma'));
    }

    // =====================================================================
    // FUNGSI UNTUK DATA SMA
    // =====================================================================
    public function disSMA(Request $request) { return $this->handleDataRequest('dis_sma', 'disSMA', 'sma', [], $request, true); }
    public function disSMA21(Request $request) { return $this->handleDataRequest('dis21', 'disSMA21', 'sma', [['column' => 'jenjang', 'value' => 'SMA']], $request, true); }
    public function disSMA22(Request $request) { return $this->handleDataRequest('dis22', 'disSMA22', 'sma', [['column' => 'jenjang', 'value' => 'SMA']], $request, true); }
    public function disSMA23(Request $request) { return $this->handleDataRequest('dis23', 'disSMA23', 'sma', [['column' => 'jenjang', 'value' => 'SMA']], $request, true); }
    public function disSMA24(Request $request) { return $this->handleDataRequest('dis24', 'disSMA24', 'sma', [['column' => 'jenjang', 'value' => 'SMA']], $request, true); }
    public function disSMA25(Request $request) { return $this->handleDataRequest('dis25', 'disSMA25', 'sma', [['column' => 'jenjang', 'value' => 'SMA']], $request, true); }

    public function drmSMA(Request $request) { return $this->handleDataRequest('drm_sma', 'drmSMA', 'drm_sma', [], $request, false); }
    public function drmSMA21(Request $request) { return $this->handleDataRequest('drm21', 'drmSMA21', 'drm_sma', [['column' => 'jenjang', 'value' => 'SMA']], $request, false); }
    public function drmSMA22(Request $request) { return $this->handleDataRequest('drm22', 'drmSMA22', 'drm_sma', [['column' => 'jenjang', 'value' => 'SMA']], $request, false); }
    public function drmSMA23(Request $request) { return $this->handleDataRequest('drm23', 'drmSMA23', 'drm_sma', [['column' => 'jenjang', 'value' => 'SMA']], $request, false); }
    public function drmSMA24(Request $request) { return $this->handleDataRequest('drm24', 'drmSMA24', 'drm_sma', [['column' => 'jenjang', 'value' => 'SMA']], $request, false); }
    public function drmSMA25(Request $request) { return $this->handleDataRequest('drm25', 'drmSMA25', 'drm_sma', [['column' => 'jenjang', 'value' => 'SMA']], $request, false); }

    public function gtkSMA(Request $request) { return $this->handleDataRequest('gtk_sma', 'gtkSMA', 'gtk_sma', [], $request, false); }
    public function gtkSMA21(Request $request) { return $this->handleDataRequest('gtk21', 'gtkSMA21', 'gtk_sma', [], $request, false); }
    public function gtkSMA22(Request $request) { return $this->handleDataRequest('gtk22', 'gtkSMA22', 'gtk_sma', [], $request, false); }
    public function gtkSMA23(Request $request) { return $this->handleDataRequest('gtk23', 'gtkSMA23', 'gtk_sma', [], $request, false); }
    public function gtkSMA24(Request $request) { return $this->handleDataRequest('gtk24', 'gtkSMA24', 'gtk_sma', [], $request, false); }
    public function gtkSMA25(Request $request) { return $this->handleDataRequest('gtk25', 'gtkSMA25', 'gtk_sma', [], $request, false); }

    public function sarprasSMA(Request $request) { return $this->handleDataRequest('sarpras_sma', 'dasarSMA', 'sarpras_sma', [], $request, false); }
    public function sarprasSMA21(Request $request) { return $this->handleDataRequest('sarpras21', 'dasarSMA21', 'sarpras_sma', [], $request, false); }
    public function sarprasSMA22(Request $request) { return $this->handleDataRequest('sarpras22', 'dasarSMA22', 'sarpras_sma', [], $request, false); }
    public function sarprasSMA23(Request $request) { return $this->handleDataRequest('sarpras23', 'dasarSMA23', 'sarpras_sma', [], $request, false); }
    public function sarprasSMA24(Request $request) { return $this->handleDataRequest('sarpras24', 'dasarSMA24', 'sarpras_sma', [], $request, false); }
    public function sarprasSMA25(Request $request) { return $this->handleDataRequest('sarpras25', 'dasarSMA25', 'sarpras_sma', [], $request, false); }

    // =====================================================================
    // FUNGSI UNTUK DATA SMK
    // =====================================================================
    public function disSMK(Request $request) { return $this->handleDataRequest('dis_smk', 'disSMK', 'dis_smk', [], $request, true); }
    public function disSMK21(Request $request) { return $this->handleDataRequest('dis21', 'disSMK21', 'dis_smk', [['column' => 'jenjang', 'value' => 'SMK']], $request, true); }
    public function disSMK22(Request $request) { return $this->handleDataRequest('dis22', 'disSMK22', 'dis_smk', [['column' => 'jenjang', 'value' => 'SMK']], $request, true); }
    public function disSMK23(Request $request) { return $this->handleDataRequest('dis23', 'disSMK23', 'dis_smk', [['column' => 'jenjang', 'value' => 'SMK']], $request, true); }
    public function disSMK24(Request $request) { return $this->handleDataRequest('dis24', 'disSMK24', 'dis_smk', [['column' => 'jenjang', 'value' => 'SMK']], $request, true); }
    public function disSMK25(Request $request) { return $this->handleDataRequest('dis25', 'disSMK25', 'dis_smk', [['column' => 'jenjang', 'value' => 'SMK']], $request, true); }

    public function drmSMK(Request $request) { return $this->handleDataRequest('drm_smk', 'drmSMK', 'drm_smk', [], $request, false); }
    public function drmSMK21(Request $request) { return $this->handleDataRequest('drm21', 'drmSMK21', 'drm_smk', [['column' => 'jenjang', 'value' => 'SMK']], $request, false); }
    public function drmSMK22(Request $request) { return $this->handleDataRequest('drm22', 'drmSMK22', 'drm_smk', [['column' => 'jenjang', 'value' => 'SMK']], $request, false); }
    public function drmSMK23(Request $request) { return $this->handleDataRequest('drm23', 'drmSMK23', 'drm_smk', [['column' => 'jenjang', 'value' => 'SMK']], $request, false); }
    public function drmSMK24(Request $request) { return $this->handleDataRequest('drm24', 'drmSMK24', 'drm_smk', [['column' => 'jenjang', 'value' => 'SMK']], $request, false); }
    public function drmSMK25(Request $request) { return $this->handleDataRequest('drm25', 'drmSMK25', 'drm_smk', [['column' => 'jenjang', 'value' => 'SMK']], $request, false); }

    public function gtkSMK(Request $request) { return $this->handleDataRequest('gtk_smk', 'gtkSMK', 'gtk_smk', [], $request, false); }
    public function gtkSMK21(Request $request) { return $this->handleDataRequest('gtk21', 'gtkSMK21', 'gtk_smk', [], $request, false); }
    public function gtkSMK22(Request $request) { return $this->handleDataRequest('gtk22', 'gtkSMK22', 'gtk_smk', [], $request, false); }
    public function gtkSMK23(Request $request) { return $this->handleDataRequest('gtk23', 'gtkSMK23', 'gtk_smk', [], $request, false); }
    public function gtkSMK24(Request $request) { return $this->handleDataRequest('gtk24', 'gtkSMK24', 'gtk_smk', [], $request, false); }
    public function gtkSMK25(Request $request) { return $this->handleDataRequest('gtk25', 'gtkSMK25', 'gtk_smk', [], $request, false); }
    
    public function sarprasSMK(Request $request) { return $this->handleDataRequest('sarpras_smk', 'dasarSMK', 'sarpras_smk', [], $request, false); }
    public function sarprasSMK21(Request $request) { return $this->handleDataRequest('sarpras21', 'dasarSMK21', 'sarpras_smk', [], $request, false); }
    public function sarprasSMK22(Request $request) { return $this->handleDataRequest('sarpras22', 'dasarSMK22', 'sarpras_smk', [], $request, false); }
    public function sarprasSMK23(Request $request) { return $this->handleDataRequest('sarpras23', 'dasarSMK23', 'sarpras_smk', [], $request, false); }
    public function sarprasSMK24(Request $request) { return $this->handleDataRequest('sarpras24', 'dasarSMK24', 'sarpras_smk', [], $request, false); }
    public function sarprasSMK25(Request $request) { return $this->handleDataRequest('sarpras25', 'dasarSMK25', 'sarpras_smk', [], $request, false); }

    // =====================================================================
    // FUNGSI UNTUK DATA SLB
    // =====================================================================
    public function disSLB(Request $request) { return $this->handleDataRequest('dis_slb', 'disSLB', 'dis_slb', [], $request, true); }
    public function disSLB21(Request $request) { return $this->handleDataRequest('dis_slb21', 'disSLB21', 'dis_slb', [['column' => 'jenjang', 'value' => 'SLB']], $request, true); }
    public function disSLB22(Request $request) { return $this->handleDataRequest('dis22', 'disSLB22', 'dis_slb', [['column' => 'jenjang', 'value' => 'SLB']], $request, true); }
    public function disSLB23(Request $request) { return $this->handleDataRequest('dis23', 'disSLB23', 'dis_slb', [['column' => 'jenjang', 'value' => 'SLB']], $request, true); }
    public function disSLB24(Request $request) { return $this->handleDataRequest('dis24', 'disSLB24', 'dis_slb', [['column' => 'jenjang', 'value' => 'SLB']], $request, true); }
    public function disSLB25(Request $request) { return $this->handleDataRequest('dis25', 'disSLB25', 'dis_slb', [['column' => 'jenjang', 'value' => 'SLB']], $request, true); }

    public function drmSLB(Request $request) { return $this->handleDataRequest('drm_slb', 'drmSLB', 'drm_slb', [], $request, false); }
    public function drmSLB21(Request $request) { return $this->handleDataRequest('drm21', 'drmSLB21', 'drm_slb', [['column' => 'jenjang', 'value' => 'SLB']], $request, false); }
    public function drmSLB22(Request $request) { return $this->handleDataRequest('drm22', 'drmSLB22', 'drm_slb', [['column' => 'jenjang', 'value' => 'SLB']], $request, false); }
    public function drmSLB23(Request $request) { return $this->handleDataRequest('drm23', 'drmSLB23', 'drm_slb', [['column' => 'jenjang', 'value' => 'SLB']], $request, false); }
    public function drmSLB24(Request $request) { return $this->handleDataRequest('drm24', 'drmSLB24', 'drm_slb', [['column' => 'jenjang', 'value' => 'SLB']], $request, false); }
    public function drmSLB25(Request $request) { return $this->handleDataRequest('drm25', 'drmSLB25', 'drm_slb', [['column' => 'jenjang', 'value' => 'SLB']], $request, false); }

    public function gtkSLB(Request $request) { return $this->handleDataRequest('gtk_slb', 'gtkSLB', 'gtk_slb', [], $request, false); }
    public function gtkSLB21(Request $request) { return $this->handleDataRequest('gtk21', 'gtkSLB21', 'gtk_slb', [], $request, false); }
    public function gtkSLB22(Request $request) { return $this->handleDataRequest('gtk22', 'gtkSLB22', 'gtk_slb', [], $request, false); }
    public function gtkSLB23(Request $request) { return $this->handleDataRequest('gtk23', 'gtkSLB23', 'gtk_slb', [], $request, false); }
    public function gtkSLB24(Request $request) { return $this->handleDataRequest('gtk24', 'gtkSLB24', 'gtk_slb', [], $request, false); }
    public function gtkSLB25(Request $request) { return $this->handleDataRequest('gtk25', 'gtkSLB25', 'gtk_slb', [], $request, false); }

    public function sarprasSLB(Request $request) { return $this->handleDataRequest('sarpras_slb', 'dasarSLB', 'sarpras_slb', [], $request, false); }
    public function sarprasSLB21(Request $request) { return $this->handleDataRequest('sarpras21', 'dasarSLB21', 'sarpras_slb', [], $request, false); }
    public function sarprasSLB22(Request $request) { return $this->handleDataRequest('sarpras22', 'dasarSLB22', 'sarpras_slb', [], $request, false); }
    public function sarprasSLB23(Request $request) { return $this->handleDataRequest('sarpras23', 'dasarSLB23', 'sarpras_slb', [], $request, false); }
    public function sarprasSLB24(Request $request) { return $this->handleDataRequest('sarpras24', 'dasarSLB24', 'sarpras_slb', [], $request, false); }
    public function sarprasSLB25(Request $request) { return $this->handleDataRequest('sarpras25', 'dasarSLB25', 'sarpras_slb', [], $request, false); }

    // =====================================================================
    // FUNGSI PEMBANTU (PRIVATE HELPERS)
    // =====================================================================

    /**
     * Membangun query dengan filter dari request dan filter tambahan.
     */
    private function buildFilteredQuery($table, $request, $additionalFilters = [], $includeKabupaten = true)
    {
        $query = DB::table($table);

        foreach ($additionalFilters as $filter) {
            $query->where($filter['column'], $filter['value']);
        }

        if ($request->has('jenjang') && $request->jenjang != '') {
            $query->where('jenjang', $request->jenjang);
        }
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        if ($includeKabupaten && $request->has('kabupaten_kota') && $request->kabupaten_kota != '') {
            $query->where('kabupaten_kota', $request->kabupaten_kota);
        }

        return $query;
    }

    /**
     * Mengambil opsi filter yang unik (distinct) dari tabel.
     */
    private function getFilterOptions($table, $additionalFilters = [], $includeKabupaten = true)
    {
        $baseQuery = DB::table($table);

        foreach ($additionalFilters as $filter) {
            $baseQuery->where($filter['column'], $filter['value']);
        }

        $jenjangOptions = (clone $baseQuery)->select('jenjang')->distinct()->pluck('jenjang');
        $statusOptions = (clone $baseQuery)->select('status')->distinct()->pluck('status');
        $kabupatenKotaOptions = $includeKabupaten ? (clone $baseQuery)->select('kabupaten_kota')->distinct()->pluck('kabupaten_kota') : collect();

        return compact('jenjangOptions', 'statusOptions', 'kabupatenKotaOptions');
    }

    /**
     * Menangani request data, memfilter, dan mengembalikan view dengan data yang sesuai.
     */
    private function handleDataRequest($table, $view, $dataVar, $additionalFilters = [], Request $request, $includeKabupaten = true)
    {
        $query = $this->buildFilteredQuery($table, $request, $additionalFilters, $includeKabupaten);
        $data = $query->get();
        $filterOptions = $this->getFilterOptions($table, $additionalFilters, $includeKabupaten);
        
        $viewData = [
            $dataVar => $data,
            'jenjangOptions' => $filterOptions['jenjangOptions'],
            'statusOptions' => $filterOptions['statusOptions'],
        ];

        if ($includeKabupaten) {
            $viewData['kabupatenKotaOptions'] = $filterOptions['kabupatenKotaOptions'];
        }

        return view($view, $viewData);
    }
}