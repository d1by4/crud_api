<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Dotenv\Validator;
use Illuminate\Http\Request;

class BukuController extends Controller
{

    public function index()
    {
        $data = Buku::orderBy('id', 'asc')->get();
        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan',
            'data' => $data,
        ], 200);
    }

    public function store(Request $request)
    {
        // Validasi input menggunakan metode validate
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'pengarang' => 'required',
            'tanggal_publikasi' => 'required'
        ]);

        // Menggunakan model untuk menyimpan data
        $dataBuku = Buku::create([
            'judul' => $validated['judul'],
            'pengarang' => $validated['pengarang'],
            'tanggal_publikasi' => $validated['tanggal_publikasi'],
        ]);

        // Mengembalikan respons JSON yang sesuai
        return response()->json([
            'status' => true,
            'message' => 'Sukses membuat data baru',
            'data' => $dataBuku,
        ]);
    }

    public function show($id)
    {
        $data = Buku::find($id);
        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'data ditemukan',
                'data' => $data,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'data tidak ditemukan',
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        // Validasi input menggunakan metode validate
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'pengarang' => 'required',
            'tanggal_publikasi' => 'required'
        ]);

        // Menggunakan model untuk menyimpan data
        $dataBuku = Buku::findOrFail($id);
        $dataBuku->update($request->all());

        if ($dataBuku) {
            return response()->json([
                'status' => true,
                'message' => 'data berhasil diperbarui',
                'data' => $dataBuku,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'data gagal diperbarui',
            ]);
        }
    }

    public function destroy($id)
    {
        $dataBuku = Buku::findOrFail($id);
        $dataBuku->delete();

        if ($dataBuku) {
            return response()->json([
                'status' => true,
                'message' => 'data berhasil dihapus',
                'data' => $dataBuku,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'data gagal dihapus',
            ]);
        }
    }
}
