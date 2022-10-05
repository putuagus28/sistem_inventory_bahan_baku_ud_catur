<?php

namespace App\Http\Controllers;

use App\Bahanbaku;
use App\Supplier;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $role = auth()->user()->role;

        if (in_array($role, ['admin', 'pegawai'])) {
            $data = [
                'title' => 'Dashboard',
                'users' => User::all()->count(),
                'sup' => Supplier::all()->count(),
                'bb' => Bahanbaku::all()->count(),
                'lap' => 3,
            ];
        }

        $data['bulan'] = [
            "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus",
            "September", "Oktober", "November", "Desember"
        ];
        return view('dashboard', $data);
    }

    public function chart()
    {
        $data['bulan'] = [
            "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus",
            "September", "Oktober", "November", "Desember"
        ];

        $total = [];
        // for ($i = 1; $i <= 12; $i++) {
        //     $db = DB::table("pemasukans")
        //         ->selectRaw('SUM(nominal) as total')
        //         ->where('ukms_id', Session::get('ukms_id'))
        //         ->whereMonth('tanggal', '=', $i)
        //         ->whereYear('tanggal', '=', date('Y'))
        //         ->groupBy(DB::raw("MONTH(tanggal)"))
        //         ->get();
        //     if ($db->count() == null) {
        //         $total[] = 0;
        //     } else {
        //         foreach ($db as $val) {
        //             $total[] = $val->total;
        //         }
        //     }
        // }

        // for ($i = 1; $i <= 12; $i++) {
        //     $db = DB::table("pengeluarans")
        //         ->selectRaw('SUM(nominal) as total')
        //         ->where('ukms_id', Session::get('ukms_id'))
        //         ->whereMonth('tanggal', '=', $i)
        //         ->whereYear('tanggal', '=', date('Y'))
        //         ->groupBy(DB::raw("MONTH(tanggal)"))
        //         ->get();
        //     if ($db->count() == null) {
        //         $total2[] = 0;
        //     } else {
        //         foreach ($db as $val) {
        //             $total2[] = $val->total;
        //         }
        //     }
        // }
        $data['total'] = $total;
        $data['title'] = 'Pemasukan ' . date('Y');

        return response()->json(array('data' => $data));
    }
}
