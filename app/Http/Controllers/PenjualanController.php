<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    // Menampilkan data penjualan dalam format JSON
    public function index()
    {
        $penjualans = Penjualan::all(); // Mengambil semua data penjualan
        return response()->json($penjualans); // Mengembalikan data dalam format JSON
    }

    // Menyimpan data penjualan baru
    public function store(Request $request)
    {
        $total = $request->jumlah * $request->harga;
        $penjualan = Penjualan::create([
            'produk' => $request->produk,
            'jumlah' => $request->jumlah,
            'harga' => $request->harga,
            'total' => $total
        ]);
        return response()->json($penjualan, 201); // Mengembalikan data penjualan yang baru dibuat
    }

    // Menampilkan data penjualan berdasarkan ID
    public function show($id)
    {
        return Penjualan::findOrFail($id); // Mencari penjualan berdasarkan ID
    }

    // Memperbarui data penjualan berdasarkan ID
    public function update(Request $request, $id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $penjualan->update($request->all());
        return response()->json($penjualan, 200); // Mengembalikan penjualan yang sudah diperbarui
    }

    // Menghapus data penjualan berdasarkan ID
    public function destroy($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $penjualan->delete();
        return response()->json(null, 204); // Mengembalikan response kosong setelah menghapus
    }
}
