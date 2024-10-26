<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Facades\Validator;

class BarangClientController extends Controller
{
    public function index()
    {
        return response([
            'success' => true,
            'message' => 'List Semua Data Barang',
            'data' => Barang::with(['supplier' => function () {
            }])->get(),
        ], 200);
    }

    public function show(Request $request, $id)
    {
        return response([
            'success' => true,
            'message' => 'Data Barang',
            'data' => Barang::with(['supplier' => function () {
            }])->find($id),
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'user_id'     => 'required',
                'categori_id'   => 'required',
                'namaBarang'   => 'required',
                'kodeBarang'   => 'required',
                'hargaBeli'   => 'required',
                'hargaJual'   => 'required',
                'stok'   => 'required',
            ],
            [
                'user_id.required' => 'User ID Tidak Boleh Kosong!',
                'categori_id.required' => 'Categori ID Tidak Boleh Kosong!',
                'namaBarang.required' => 'Nama Barang Tidak Boleh Kosong!',
                'kodeBarang.required' => 'Kode Barang Tidak Boleh Kosong!',
                'hargaBeli.required' => 'Harga Beli Tidak Boleh Kosong!',
                'hargaJual.required' => 'Harga Jual Tidak Boleh Kosong!',
                'stok.required' => 'Stok Tidak Boleh Kosong!',
            ]
        );

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ], 401);
        } else {

            $barang = new Barang();
            $barang->user_id = $request->user_id;
            $barang->categori_id = $request->categori_id;
            $barang->namaBarang = $request->namaBarang;
            $barang->kodeBarang = $request->kodeBarang;
            $barang->hargaBeli = $request->hargaBeli;
            $barang->hargaJual = $request->hargaJual;
            $barang->stok = $request->stok;
            $barang->save();

            return response([
                'success' => true,
                'message' => 'Data Barang Berhasil Ditambah',
                'data' => $barang,
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
                'user_id'     => 'required',
                'categori_id'   => 'required',
                'namaBarang'   => 'required',
                'kodeBarang'   => 'required',
                'hargaBeli'   => 'required',
                'hargaJual'   => 'required',
                'stok'   => 'required',
            ],
            [
                'user_id.required' => 'User ID Tidak Boleh Kosong!',
                'categori_id.required' => 'Categori ID Tidak Boleh Kosong!',
                'namaBarang.required' => 'Nama Barang Tidak Boleh Kosong!',
                'kodeBarang.required' => 'Kode Barang Tidak Boleh Kosong!',
                'hargaBeli.required' => 'Harga Beli Tidak Boleh Kosong!',
                'hargaJual.required' => 'Harga Jual Tidak Boleh Kosong!',
                'stok.required' => 'Stok Tidak Boleh Kosong!',
            ]
        );

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ], 401);
        } else {

            $barang = Barang::find($id);
            $barang->user_id = $request->user_id;
            $barang->categori_id = $request->categori_id;
            $barang->namaBarang = $request->namaBarang;
            $barang->kodeBarang = $request->kodeBarang;
            $barang->hargaBeli = $request->hargaBeli;
            $barang->hargaJual = $request->hargaJual;
            $barang->stok = $request->stok;
            $barang->save();

            return response([
                'success' => true,
                'message' => 'Data Barang Berhasil Diupdate',
                'data' => $barang,
            ], 200);
        }
    }

    public function destroy(Request $request, $id)
    {
        Barang::destroy($id);
        return response([
            'success' => true,
            'message' => 'Data Berhasil Berhasil Dihapus',
        ], 200);
    }
}
