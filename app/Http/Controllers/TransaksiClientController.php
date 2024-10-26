<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransaksiClientController extends Controller
{
    //
    public function index()
    {
        return response([
            'success' => true,
            'message' => 'List Semua Data Transaksi',
            'data' => Transaksi::with(['barang' => function () {
            }])->get(),
        ], 200);
    }

    public function show(Request $request, $id)
    {
        return response([
            'success' => true,
            'message' => 'Data Transaksi',
            'data' => Transaksi::with(['barang' => function () {
            }])->find($id),
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'id_barang'     => 'required',
                'stok'   => 'required',
                'tanggal'   => 'required',
                'ket'   => 'required',
            ],
            [
                'id_barang.required' => 'ID Barang Tidak Boleh Kosong!',
                'stok.required' => 'Stok Tidak Boleh Kosong!',
                'tanggal.required' => 'Tanggal Tidak Boleh Kosong!',
                'ket.required' => 'Keterangan Tidak Boleh Kosong!',
            ]
        );

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ], 401);
        } else {

            $transaksi = new Transaksi();
            $transaksi->id_barang = $request->id_barang;
            $transaksi->stok = $request->stok;
            $transaksi->ket = $request->ket;
            $transaksi->tanggal = $request->tanggal;
            $transaksi->save();

            if ($transaksi->ket == "masuk") {
                $barang = Barang::find($request->id_barang);
                if ($barang) {
                    $barang->stok += $request->stok;
                    $barang->save();
                }
            } else if ($transaksi->ket == "keluar") {
                $barang = Barang::find($request->id_barang);
                if ($barang) {
                    $barang->stok -= $request->stok;
                    $barang->save();
                }
            }

            return response([
                'success' => true,
                'message' => ($request->ket == "masuk" ? "Transaksi Masuk" : "Transaksi Keluar") . " Berhasil Disimpan",
                'data' => $transaksi,
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
                'stok'   => 'required',
            ],
            [
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

            $transaksi = Transaksi::find($id);
            $old_stok = $transaksi->stok;
            $transaksi->stok = $request->stok;
            $transaksi->save();

            $ket = $transaksi->ket;
            $id_barang = $transaksi->id_barang;

            if ($ket == "masuk") {
                $barang = Barang::find($id_barang);
                if ($barang) {
                    $barang->stok -= ($old_stok - $request->stok);
                    $barang->save();
                }
            } else if ($ket == "keluar") {
                $barang = Barang::find($id_barang);
                if ($barang) {
                    $barang->stok += ($old_stok - $request->stok);
                    $barang->save();
                }
            }

            return response([
                'success' => true,
                'message' => 'Data Transaksi Berhasil Diupdate',
                'data' => $transaksi,
            ], 200);
        }
    }

    public function destroy(Request $request, $id)
    {
        $transaksi = Transaksi::find($id);
        $transaksi->delete();

        $ket = $transaksi->ket;
        $id_barang = $transaksi->id_barang;

        if ($ket == "masuk") {
            $barang = Barang::find($id_barang);
            if ($barang) {
                $barang->stok -= $request->stok;
                $barang->save();
            }
        } else if ($ket == "keluar") {
            $barang = Barang::find($id_barang);
            if ($barang) {
                $barang->stok += $request->stok;
                $barang->save();
            }
        }

        return response([
            'success' => true,
            'message' => 'Data Transaksi Berhasil Dihapus',
        ], 200);
    }
}
