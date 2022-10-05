<?php

namespace App\Http\Controllers;

use App\Bahanbaku;
use App\Bahanbaku_masuk;
use App\Periode;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;

class BbmController extends Controller
{
    function upStok($id = null, $qty = 0, $act = null)
    {
        $b = Bahanbaku::find($id);
        if ($act == '+') {
            $b->jumlah = $b->jumlah + $qty;
        } else {
            $b->jumlah = $b->jumlah - $qty;
        }
        return $b->save();
    }

    function switchStok($id = null, $qty_lama = 0, $qty_baru = 0)
    {
        $b = Bahanbaku::find($id);
        $b->jumlah = ($b->jumlah - $qty_lama) + $qty_baru;
        return $b->save();
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Bahanbaku_masuk::with('bahanbaku', 'user', 'supplier', 'periode')->get();
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
            'title' => 'Bahan Baku Masuk',
            'bahanbaku' => Bahanbaku::all(),
            'supplier' => Supplier::all(),
            'periode' => Periode::all(),
        ];
        return view('bbm.index', $data);
    }

    public function insert(Request $req)
    {
        try {
            $q = new Bahanbaku_masuk;
            $q->bahanbakus_id = $req->bahanbakus_id;
            $q->users_id = auth()->user()->id;
            $q->suppliers_id = $req->suppliers_id;
            $q->periodes_id = $req->periodes_id;
            $q->ukuran = $req->ukuran;
            $q->jumlah = $req->jumlah;
            $q->harga = $req->harga;
            $q->satuan = $req->satuan;
            $q->tanggal_bbm = date('Y-m-d', strtotime($req->tanggal_bbm));
            $q->save();

            $this->upStok($req->bahanbakus_id, $req->jumlah, '+');
            return response()->json(['status' => true, 'message' => 'Sukses']);
        } catch (\Exception $err) {
            return response()->json(['status' => false, 'message' => $err->getMessage()]);
        }
    }

    public function edit(Request $request)
    {
        $q = Bahanbaku_masuk::find($request->id);
        return response()->json($q);
    }

    public function delete(Request $request)
    {
        $query = Bahanbaku_masuk::find($request->id);
        $this->upStok($query->bahanbakus_id, $query->jumlah, '-');
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
            $q = Bahanbaku_masuk::find($req->id);
            $qty_lama = $q->jumlah;
            $bahanbakus_id_lama = $q->bahanbakus_id;
            $q->bahanbakus_id = $req->bahanbakus_id;
            $q->users_id = auth()->user()->id;
            $q->suppliers_id = $req->suppliers_id;
            $q->periodes_id = $req->periodes_id;
            $q->ukuran = $req->ukuran;
            $q->jumlah = $req->jumlah;
            $q->harga = $req->harga;
            $q->satuan = $req->satuan;
            $q->tanggal_bbm = date('Y-m-d', strtotime($req->tanggal_bbm));
            $q->save();

            if ($bahanbakus_id_lama == $req->bahanbakus_id) {
                $this->switchStok($req->bahanbakus_id, $qty_lama, $req->jumlah);
            } else {
                $this->upStok($bahanbakus_id_lama, $qty_lama, '-');
                $this->upStok($req->bahanbakus_id, $req->jumlah, '+');
            }
            return response()->json(['status' => true, 'message' => 'Sukses']);
        } catch (\Exception $err) {
            return response()->json(['status' => false, 'message' => $err->getMessage()]);
        }
    }
}
