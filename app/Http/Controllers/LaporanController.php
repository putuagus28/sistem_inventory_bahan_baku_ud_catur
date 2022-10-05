<?php

namespace App\Http\Controllers;

use App\Bahanbaku_keluar;
use App\Bahanbaku_masuk;
use App\Bahanbaku_sisa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PDF;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index($jenis = "")
    {
        $data1['bulan'] = [
            "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus",
            "September", "Oktober", "November", "Desember"
        ];

        if ($jenis == "bbm") {
            $data = [
                'title' => 'Laporan Bahan Baku Masuk',
                'jenis' => $jenis,
                'query' => Bahanbaku_masuk::all(),
            ];
            return view('laporan.bbm', array_merge($data1, $data));
        } elseif ($jenis == "bbk") {
            $data = [
                'title' => 'Laporan Bahan Baku Keluar',
                'jenis' => $jenis,
                'query' => Bahanbaku_keluar::all(),
            ];
            return view('laporan.bbk', array_merge($data1, $data));
        } elseif ($jenis == "bbs") {
            $data = [
                'title' => 'Laporan Bahan Baku Sisa',
                'jenis' => $jenis,
                'query' => Bahanbaku_sisa::all(),
            ];
            return view('laporan.bbs', array_merge($data1, $data));
        }

        return abort(404);
    }

    public function getLaporan(Request $req)
    {
        if ($req->jenis == "bbm") {
            $periode = explode('/', $req->periode);
            $query = Bahanbaku_masuk::with('bahanbaku', 'user', 'supplier', 'periode')
                ->select('*', DB::raw('DATE_FORMAT(tanggal_bbm, "%d-%m-%Y") as tanggal'))
                ->whereMonth('tanggal_bbm', $req->bulan)
                ->whereYear('tanggal_bbm', $req->tahun)
                ->orderBy('tanggal_bbm', 'desc')
                ->get();
            $data = [
                'query' => $query,
                'jenis' => $req->jenis
            ];
        } else if ($req->jenis == "bbk") {
            $periode = explode('/', $req->periode);
            $query = Bahanbaku_keluar::select('*', DB::raw('DATE_FORMAT(tanggal_bbk, "%d-%m-%Y") as tanggal'))
                ->whereMonth('tanggal_bbk', '>=', $req->bulan)
                ->whereYear('tanggal_bbk', '<=', $req->tahun)
                ->orderBy('tanggal_bbk', 'desc')
                ->get();
            $data = [
                'query' => $query,
                'jenis' => $req->jenis
            ];
        } else if ($req->jenis == "bbs") {
            $periode = explode('/', $req->periode);
            $query = Bahanbaku_sisa::select('*', DB::raw('DATE_FORMAT(tanggal_bbm, "%d-%m-%Y") as tanggal'))
                ->whereYear('tanggal_bbm', '>=', $periode[0])
                ->whereYear('tanggal_bbm', '<=', $periode[1])
                ->orderBy('tanggal_bbm', 'desc')
                ->get();
            $data = [
                'query' => $query,
                'jenis' => $req->jenis
            ];
        }
        return response()->json($data);
    }

    // Generate PDF
    public function generatePDF($jenis, $periode, $id = null, $ukms_id = null)
    {
        $periode = explode('-', $periode);
        if ($jenis == "bbm") {
            $query = Bahanbaku_masuk::with('bahanbaku', 'user', 'supplier', 'periode')
                ->select('*', DB::raw('DATE_FORMAT(tanggal, "%d-%m-%Y") as tanggal'))
                ->where('id', $id)
                ->whereYear('tanggal', '>=', $periode[0])
                ->whereYear('tanggal', '<=', $periode[1])
                ->orderBy('tanggal', 'desc')
                ->get();
            $data = [
                'query' => $query,
                'periode' => $periode[0] . '/' . $periode[1],
                'jenis' => $jenis
            ];
        } else if ($jenis == "bbk") {
            $query = Bahanbaku_keluar::with('users', 'detail')
                ->select('*', DB::raw('DATE_FORMAT(tanggal, "%d-%m-%Y") as tanggal'))
                ->where('id', $id)
                ->whereYear('tanggal', '>=', $periode[0])
                ->whereYear('tanggal', '<=', $periode[1])
                ->orderBy('tanggal', 'desc')
                ->get();
            $data = [
                'query' => $query,
                'periode' => $periode[0] . '/' . $periode[1],
                'jenis' => $jenis
            ];
        } else if ($jenis == "bbs") {
            $query = Bahanbaku_sisa::with('users', 'detail')
                ->select('*', DB::raw('DATE_FORMAT(tanggal, "%d-%m-%Y") as tanggal'))
                ->where('id', $id)
                ->whereYear('tanggal', '>=', $periode[0])
                ->whereYear('tanggal', '<=', $periode[1])
                ->orderBy('tanggal', 'desc')
                ->get();
            $data = [
                'query' => $query,
                'periode' => $periode[0] . '/' . $periode[1],
                'jenis' => $jenis
            ];
        }

        // $pdf = PDF::loadView('laporan.pdf_view', $data);
        // $pdf = PDF::loadview('laporan.pdf_view', $data)->setPaper('A4', 'potrait');
        // return $pdf->download('laporan-pdf.pdf');
        // return $pdf->stream();
        return view('laporan.pdf_view', $data);
    }
}
