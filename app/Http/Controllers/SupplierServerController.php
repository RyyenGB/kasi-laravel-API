<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Supplier;

class SupplierServerController extends Controller
{
    public function index()
    {
        return response([
            'success' => true,
            'message' => 'List Semua Data Supplier',
            'data' => Supplier::get(),
        ], 200);
    }

    public function show(Request $request, $id)
    {
        return response([
            'success' => true,
            'message' => 'Data Supplier',
            'data' => Supplier::find($id),
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'namaToko'     => 'required',
                'noKontak'   => 'required',
                'alamat'   => 'required',
                'user_id'   => 'required',
            ],
            [
                'namaToko.required' => 'Nama Toko Tidak Boleh Kosong!',
                'noKontak.required' => 'No. Kontak Tidak Boleh Kosong!',
                'alamat.required' => 'Alamat Tidak Boleh Kosong!',
                'user_id.required' => 'User ID Tidak Boleh Kosong!',
            ]
        );

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ], 401);
        } else {

            $supllier = new Supplier();
            $supllier->namaToko = $request->namaToko;
            $supllier->noKontak = $request->noKontak;
            $supllier->alamat = $request->alamat;
            $supllier->user_id = $request->user_id;
            $supllier->save();

            return response([
                'success' => true,
                'message' => 'Data Supplier Berhasil Ditambah',
                'data' => $supllier,
            ], 200);
        }
    }

    public function update(Request $request, $id)
    {
        if (!$id) {
            return response()->json([
                'success' => false,
                'message' => 'ID Tidak Ada!',
            ], 401);
        }

        $validator = Validator::make(
            $request->all(),
            [
                'namaToko'     => 'required',
                'noKontak'   => 'required',
                'alamat'   => 'required',
                'user_id'   => 'required',
            ],
            [
                'namaToko.required' => 'Nama Toko Tidak Boleh Kosong!',
                'noKontak.required' => 'No. Kontak Tidak Boleh Kosong!',
                'alamat.required' => 'Alamat Tidak Boleh Kosong!',
                'user_id.required' => 'User ID Tidak Boleh Kosong!',
            ]
        );

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ], 401);
        } else {

            $supllier = Supplier::find($id);
            $supllier->namaToko = $request->namaToko;
            $supllier->noKontak = $request->noKontak;
            $supllier->alamat = $request->alamat;
            $supllier->user_id = $request->user_id;
            $supllier->save();

            return response([
                'success' => true,
                'message' => 'Data Supplier Berhasil Diupdate',
                'data' => $supllier,
            ], 200);
        }
    }

    public function destroy(Request $request, $id)
    {
        Supplier::destroy($id);
        return response([
            'success' => true,
            'message' => 'Data Berhasil Berhasil Dihapus',
        ], 200);
    }
}
