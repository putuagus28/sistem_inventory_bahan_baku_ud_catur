<?php

namespace App\Http\Controllers;

use App\Produksi;
use App\Bahanbaku;
use App\Bahanbaku_sisa;
use App\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;

class BbsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Bahanbaku_sisa::with('bahanbaku', 'user', 'produksi')->get();
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
            'title' => 'Bahan Baku Sisa',
            'bahanbaku' => Bahanbaku::all(),
            'periode' => Periode::all(),
            'produksi' => Produksi::all(),
        ];
        return view('bbs.index', $data);
    }

    public function insert(Request $req)
    {
        try {
            $q = new Bahanbaku_sisa;
            $q->bahanbakus_id = $req->bahanbakus_id;
            $q->users_id = auth()->user()->id;
            $q->produksis_id = $req->produksis_id;
            $q->ukuran = $req->ukuran;
            $q->jumlah = $req->jumlah;
            $q->satuan = $req->satuan;
            $q->keterangan = $req->keterangan;
            $q->save();

            return response()->json(['status' => true, 'message' => 'Sukses']);
        } catch (\Exception $err) {
            return response()->json(['status' => false, 'message' => $err->getMessage()]);
        }
    }

    public function edit(Request $request)
    {
        $q = Bahanbaku_sisa::find($request->id);
        return response()->json($q);
    }

    public function delete(Request $request)
    {
        $query = Bahanbaku_sisa::find($request->id);
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
            $q = Bahanbaku_sisa::find($req->id);
            $q->bahanbakus_id = $req->bahanbakus_id;
            $q->users_id = auth()->user()->id;
            $q->produksis_id = $req->produksis_id;
            $q->ukuran = $req->ukuran;
            $q->jumlah = $req->jumlah;
            $q->satuan = $req->satuan;
            $q->keterangan = $req->keterangan;
            $q->save();
            return response()->json(['status' => true, 'message' => 'Sukses']);
        } catch (\Exception $err) {
            return response()->json(['status' => false, 'message' => $err->getMessage()]);
        }
    }
}
