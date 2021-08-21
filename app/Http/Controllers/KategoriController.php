<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    public function create()
    {
        return view('admin.kategori.create-kategori');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "nama_kategori" => 'required|max:100',
        ]);

        if ($validator->passes()) {
            DB::table('kategoris')->insert([
                'nama_kategori' => $request->nama_kategori,
            ]);

            return response()->json(['success' => 'Berhasil membuat kategori baru!']);
        } else {
            return response()->json(['error' => $validator->errors()->all()]);
        }
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('admin.kategori.data-edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $kategori = DB::table('kategoris')->where('id', $id);
        $validator = Validator::make($request->all(), [
            "nama_kategori" => 'required|max:100',
        ]);

        if ($validator->passes()) {
            $kategori->update([
                'nama_kategori' => $request->nama_kategori,
            ]);

            return response()->json(['success' => 'Berhasil update kategori!']);
        } else {
            return response()->json(['error' => $validator->errors()->all()]);
        }
    }


    public function destroy($id)
    {
        $kategori = DB::table('kategoris')->where('id', $id);
        $kategori->delete();
        return response()->json(['success' => 'Berhasil hapus kategori!']);
    }
}
