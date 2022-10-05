<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;
use App\User;

class UserController extends Controller
{
    public function index(Request $request, $type = null)
    {
        if ($request->ajax()) {
            $data = User::where('role', $type)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = "";
                    $btn .= '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-dark btn-sm mx-1" id="edit"><i class="fas fa-edit"></i></a>';
                    if ($row->id != auth()->user()->id) {
                        $btn .= '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-danger btn-sm mx-1" id="hapus"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $data = [
            'type' => $type
        ];
        return view('user.index', $data);
    }

    public function insert(Request $request)
    {
        try {
            $user = new User;
            $user->name = $request->name;
            $user->jenis_kelamin = $request->jenis_kelamin;
            $user->telepon = $request->telepon;
            $user->role = $request->type;
            $user->alamat = $request->alamat;
            $user->email = $request->email;
            $user->username = $request->username;
            if (!empty($request->password)) {
                $user->password = bcrypt($request->password);
            }
            $user->save();
            return response()->json(['status' => true, 'message' => 'Sukses']);
        } catch (\Exception $err) {
            return response()->json(['status' => false, 'message' => $err->getMessage()]);
        }
    }

    public function edit(Request $request)
    {
        $q = User::find($request->id);
        return response()->json($q);
    }

    public function delete(Request $request)
    {
        $query = User::find($request->id);
        $del = $query->delete();
        if ($del) {
            return response()->json(['status' => $del, 'message' => 'Hapus Sukses']);
        } else {
            return response()->json(['status' => $del, 'message' => 'Gagal']);
        }
    }

    public function update(Request $request)
    {
        try {
            $user = User::find($request->id);
            $user->name = $request->name;
            $user->jenis_kelamin = $request->jenis_kelamin;
            $user->telepon = $request->telepon;
            $user->alamat = $request->alamat;
            $user->email = $request->email;
            $user->username = $request->username;
            if (!empty($request->password)) {
                $user->password = bcrypt($request->password);
            }
            $user->save();
            return response()->json(['status' => true, 'message' => 'Sukses']);
        } catch (\Exception $err) {
            return response()->json(['status' => false, 'message' => $err->getMessage()]);
        }
    }
}
