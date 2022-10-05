<?php

namespace App\Http\Controllers;

use App\Bahanbaku;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;

class BahanbakuController extends Controller
{
    function generate()
    {
        $kode = Bahanbaku::max('kode_bahanbaku');
        $urutan = (int) substr($kode, 3, 3);

        // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
        $urutan++;

        // membentuk kode barang baru
        // perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
        // misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
        // angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
        $huruf = "BB";
        $kode = $huruf . sprintf("%03s", $urutan);
        return $kode;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Bahanbaku::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = "";
                    $btn .= '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-dark btn-sm mx-1" id="edit"><i class="fas fa-edit"></i></a>';
                    $btn .= '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-danger btn-sm mx-1" id="hapus"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $data = [
            'title' => 'Bahan Baku',
        ];
        return view('bahanbaku.index', $data);
    }

    public function insert(Request $req)
    {
        try {
            $q = new Bahanbaku;
            $q->kode_bahanbaku = $this->generate();
            $q->nama_bahanbaku = ucwords($req->nama_bahanbaku);
            $q->ukuran = $req->ukuran;
            $q->jumlah = $req->jumlah;
            $q->satuan = $req->satuan;
            $q->save();
            return response()->json(['status' => true, 'message' => 'Sukses']);
        } catch (\Exception $err) {
            return response()->json(['status' => false, 'message' => $err->getMessage()]);
        }
    }

    public function edit(Request $request)
    {
        $q = Bahanbaku::find($request->id);
        return response()->json($q);
    }

    public function delete(Request $request)
    {
        $query = Bahanbaku::find($request->id);
        $del = $query->delete();
        if ($del) {
            return response()->json(['status' => $del, 'message' => 'Hapus Sukses']);
        } else {
            return response()->json(['status' => $del, 'message' => 'Gagal']);
        }
    }

    public function update(Request $req)
    {
        try {
            $q = Bahanbaku::find($req->id);
            $q->nama_bahanbaku = ucwords($req->nama_bahanbaku);
            $q->ukuran = $req->ukuran;
            $q->jumlah = $req->jumlah;
            $q->satuan = $req->satuan;
            $q->save();
            return response()->json(['status' => true, 'message' => 'Sukses']);
        } catch (\Exception $err) {
            return response()->json(['status' => false, 'message' => $err->getMessage()]);
        }
    }
}
