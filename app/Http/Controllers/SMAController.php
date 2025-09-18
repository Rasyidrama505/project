<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SMAController extends Controller
{
    public function index()
    {
        // Ambil semua data dari tabel dis_sma
        $sma = DB::table('dis_sma')->get();

        // Kirim ke view 'sma'
        return view('sma', compact('sma'));
    }

    public function disSMA(Request $request)
    {
        // Ambil query builder untuk dis_sma
        $query = DB::table('dis_sma');

        // Terapkan filter jika ada
        if ($request->has('jenjang') && $request->jenjang != '') {
            $query->where('jenjang', $request->jenjang);
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('kabupaten_kota') && $request->kabupaten_kota != '') {
            $query->where('kabupaten_kota', $request->kabupaten_kota);
        }

        // Ambil data yang sudah difilter
        $sma = $query->get();

        // Ambil opsi untuk filter dropdown
        $jenjangOptions = DB::table('dis_sma')->select('jenjang')->distinct()->pluck('jenjang');
        $statusOptions = DB::table('dis_sma')->select('status')->distinct()->pluck('status');
        $kabupatenKotaOptions = DB::table('dis_sma')->select('kabupaten_kota')->distinct()->pluck('kabupaten_kota');

        // Kirim ke view 'disSMA' dengan data dan opsi filter
        return view('disSMA', compact('sma', 'jenjangOptions', 'statusOptions', 'kabupatenKotaOptions'));
    }

    public function drmSMA(Request $request)
    {
        // Ambil query builder untuk drm_sma
        $query = DB::table('drm_sma');

        // Terapkan filter jika ada
        if ($request->has('jenjang') && $request->jenjang != '') {
            $query->where('jenjang', $request->jenjang);
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Ambil data yang sudah difilter
        $drm_sma = $query->get();

        // Ambil opsi untuk filter dropdown
        $jenjangOptions = DB::table('drm_sma')->select('jenjang')->distinct()->pluck('jenjang');
        $statusOptions = DB::table('drm_sma')->select('status')->distinct()->pluck('status');

        // Kirim ke view 'drmSMA' dengan data dan opsi filter
        return view('drmSMA', compact('drm_sma', 'jenjangOptions', 'statusOptions'));
    }

    public function gtkSMA(Request $request)
    {
        // Ambil query builder untuk gtk_sma
        $query = DB::table('gtk_sma');

        // Terapkan filter jika ada
        if ($request->has('jenjang') && $request->jenjang != '') {
            $query->where('jenjang', $request->jenjang);
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Ambil data yang sudah difilter
        $gtk_sma = $query->get();

        // Ambil opsi untuk filter dropdown
        $jenjangOptions = DB::table('gtk_sma')->select('jenjang')->distinct()->pluck('jenjang');
        $statusOptions = DB::table('gtk_sma')->select('status')->distinct()->pluck('status');

        // Kirim ke view 'gtkSMA' dengan data dan opsi filter
        return view('gtkSMA', compact('gtk_sma', 'jenjangOptions', 'statusOptions'));
    }

    public function sarprasSMA(Request $request)
    {
        // Ambil query builder untuk sarpras_sma
        $query = DB::table('sarpras_sma');

        // Terapkan filter jika ada
        if ($request->has('jenjang') && $request->jenjang != '') {
            $query->where('jenjang', $request->jenjang);
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Ambil data yang sudah difilter
        $sarpras_sma = $query->get();

        // Ambil opsi untuk filter dropdown
        $jenjangOptions = DB::table('sarpras_sma')->select('jenjang')->distinct()->pluck('jenjang');
        $statusOptions = DB::table('sarpras_sma')->select('status')->distinct()->pluck('status');

        // Kirim ke view 'dasarSMA' dengan data dan opsi filter
        return view('dasarSMA', compact('sarpras_sma', 'jenjangOptions', 'statusOptions'));
    }

    public function sarprasSMK(Request $request)
    {
        // Ambil query builder untuk sarpras_smk
        $query = DB::table('sarpras_smk');

        // Terapkan filter jika ada
        if ($request->has('jenjang') && $request->jenjang != '') {
            $query->where('jenjang', $request->jenjang);
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Ambil data yang sudah difilter
        $sarpras_smk = $query->get();

        // Ambil opsi untuk filter dropdown
        $jenjangOptions = DB::table('sarpras_smk')->select('jenjang')->distinct()->pluck('jenjang');
        $statusOptions = DB::table('sarpras_smk')->select('status')->distinct()->pluck('status');

        // Kirim ke view 'dasarSMK' dengan data dan opsi filter
        return view('dasarSMK', compact('sarpras_smk', 'jenjangOptions', 'statusOptions'));
    }

    public function disSMK(Request $request)
    {
        // Ambil query builder untuk dis_smk
        $query = DB::table('dis_smk');

        // Terapkan filter jika ada
        if ($request->has('jenjang') && $request->jenjang != '') {
            $query->where('jenjang', $request->jenjang);
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('kabupaten_kota') && $request->kabupaten_kota != '') {
            $query->where('kabupaten_kota', $request->kabupaten_kota);
        }

        // Ambil data yang sudah difilter
        $dis_smk = $query->get();

        // Ambil opsi untuk filter dropdown
        $jenjangOptions = DB::table('dis_smk')->select('jenjang')->distinct()->pluck('jenjang');
        $statusOptions = DB::table('dis_smk')->select('status')->distinct()->pluck('status');
        $kabupatenKotaOptions = DB::table('dis_smk')->select('kabupaten_kota')->distinct()->pluck('kabupaten_kota');

        // Kirim ke view 'disSMK' dengan data dan opsi filter
        return view('disSMK', compact('dis_smk', 'jenjangOptions', 'statusOptions', 'kabupatenKotaOptions'));
    }

    public function drmSMK(Request $request)
    {
        // Ambil query builder untuk drm_smk
        $query = DB::table('drm_smk');

        // Terapkan filter jika ada
        if ($request->has('jenjang') && $request->jenjang != '') {
            $query->where('jenjang', $request->jenjang);
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Ambil data yang sudah difilter
        $drm_smk = $query->get();

        // Ambil opsi untuk filter dropdown
        $jenjangOptions = DB::table('drm_smk')->select('jenjang')->distinct()->pluck('jenjang');
        $statusOptions = DB::table('drm_smk')->select('status')->distinct()->pluck('status');

        // Kirim ke view 'drmSMK' dengan data dan opsi filter
        return view('drmSMK', compact('drm_smk', 'jenjangOptions', 'statusOptions'));
    }

    public function gtkSMK(Request $request)
    {
        // Ambil query builder untuk gtk_smk
        $query = DB::table('gtk_smk');

        // Terapkan filter jika ada
        if ($request->has('jenjang') && $request->jenjang != '') {
            $query->where('jenjang', $request->jenjang);
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Ambil data yang sudah difilter
        $gtk_smk = $query->get();

        // Ambil opsi untuk filter dropdown
        $jenjangOptions = DB::table('gtk_smk')->select('jenjang')->distinct()->pluck('jenjang');
        $statusOptions = DB::table('gtk_smk')->select('status')->distinct()->pluck('status');

        // Kirim ke view 'gtkSMK' dengan data dan opsi filter
        return view('gtkSMK', compact('gtk_smk', 'jenjangOptions', 'statusOptions'));
    }

    public function drmSLB(Request $request)
    {
        // Ambil query builder untuk drm_slb
        $query = DB::table('drm_slb');

        // Terapkan filter jika ada
        if ($request->has('jenjang') && $request->jenjang != '') {
            $query->where('jenjang', $request->jenjang);
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Ambil data yang sudah difilter
        $drm_slb = $query->get();

        // Ambil opsi untuk filter dropdown
        $jenjangOptions = DB::table('drm_slb')->select('jenjang')->distinct()->pluck('jenjang');
        $statusOptions = DB::table('drm_slb')->select('status')->distinct()->pluck('status');

        // Kirim ke view 'drmSLB' dengan data dan opsi filter
        return view('drmSLB', compact('drm_slb', 'jenjangOptions', 'statusOptions'));
    }

    public function gtkSLB(Request $request)
    {
        // Ambil query builder untuk gtk_slb
        $query = DB::table('gtk_slb');

        // Terapkan filter jika ada
        if ($request->has('jenjang') && $request->jenjang != '') {
            $query->where('jenjang', $request->jenjang);
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Ambil data yang sudah difilter
        $gtk_slb = $query->get();

        // Ambil opsi untuk filter dropdown
        $jenjangOptions = DB::table('gtk_slb')->select('jenjang')->distinct()->pluck('jenjang');
        $statusOptions = DB::table('gtk_slb')->select('status')->distinct()->pluck('status');

        // Kirim ke view 'gtkSLB' dengan data dan opsi filter
        return view('gtkSLB', compact('gtk_slb', 'jenjangOptions', 'statusOptions'));
    }

    public function sarprasSLB(Request $request)
    {
        // Ambil query builder untuk sarpras_slb
        $query = DB::table('sarpras_slb');

        // Terapkan filter jika ada
        if ($request->has('jenjang') && $request->jenjang != '') {
            $query->where('jenjang', $request->jenjang);
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Ambil data yang sudah difilter
        $sarpras_slb = $query->get();

        // Ambil opsi untuk filter dropdown
        $jenjangOptions = DB::table('sarpras_slb')->select('jenjang')->distinct()->pluck('jenjang');
        $statusOptions = DB::table('sarpras_slb')->select('status')->distinct()->pluck('status');

        // Kirim ke view 'dasarSLB' dengan data dan opsi filter
        return view('dasarSLB', compact('sarpras_slb', 'jenjangOptions', 'statusOptions'));
    }

    public function disSLB(Request $request)
    {
        // Ambil query builder untuk dis_slb
        $query = DB::table('dis_slb');

        // Terapkan filter jika ada
        if ($request->has('jenjang') && $request->jenjang != '') {
            $query->where('jenjang', $request->jenjang);
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('kabupaten_kota') && $request->kabupaten_kota != '') {
            $query->where('kabupaten_kota', $request->kabupaten_kota);
        }

        // Ambil data yang sudah difilter
        $dis_slb = $query->get();

        // Ambil opsi untuk filter dropdown
        $jenjangOptions = DB::table('dis_slb')->select('jenjang')->distinct()->pluck('jenjang');
        $statusOptions = DB::table('dis_slb')->select('status')->distinct()->pluck('status');
        $kabupatenKotaOptions = DB::table('dis_slb')->select('kabupaten_kota')->distinct()->pluck('kabupaten_kota');

        // Kirim ke view 'disSLB' dengan data dan opsi filter
        return view('disSLB', compact('dis_slb', 'jenjangOptions', 'statusOptions', 'kabupatenKotaOptions'));
    }
}
