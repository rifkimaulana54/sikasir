<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Menu;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function index()
    {
        return view('admin.menus.index');
    }

    public function getNewData()
    {
        $kategoris = Kategori::orderBy('id', 'desc')->get();
        return view('admin.menus.data-baru', compact('kategoris'));
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $query = $request->get('query');
            if ($query != '') {
                $data = Menu::with('kategori')
                    ->where('nama_menu', 'like', '%' . $query . '%')
                    ->orderBy('id', 'desc')
                    ->get();
            } else {
                $data = Menu::with('kategori')
                    ->orderBy('id', 'desc')
                    ->get();
            }
            $total_row = $data->count();
            if ($total_row > 0) {
                $i = 1;
                foreach ($data as $row) {
                    $output .= '
                    <tr>
                        <td>' . $i++ . '</td>
                        <td> <img src="' . url("image/menu/" . $row->gambar) . '"width="50" height="50" alt=""></td>
                        <td>' . $row->nama_menu . '</td>
                        <td>' . $row->kategori->nama_kategori . '</td>
                        <td> Rp.' . number_format($row->harga) . '</td>
                        <td class="text-center">
                            <span class="btn btn-primary btn-sm" onclick="editMenu(' . $row->id . ')"><i class="fas fa-edit"></i></span>
                            <span class="btn btn-danger btn-sm" onclick="hapusMenu(' . $row->id . ')"><i class="fas fa-trash"></i></span>
                        </td>
                    </tr>
                    ';
                }
            } else {
                $output = '
                <tr>
                    <td align="center" colspan="9">Tidak ada menu ' . $query . '!</td>
                </tr>
                ';
            }
            $data = array(
                'table_data'  => $output,
                'total_data'  => $total_row
            );

            echo json_encode($data);
        }
    }
    public function getPerkategori($kategori_id)
    {
        $menus = Menu::with('kategori')
            ->where('kategori_id', $kategori_id)
            ->orderBy('id', 'desc')->get();
        return view('admin.menus.data-perkategori', compact('menus'));
    }

    public function create()
    {
        $kategoris = Kategori::orderBy('id', 'desc')->get();
        return view('admin.menus.create-menu', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            "gambar" => 'required|image|mimes:jpg,jpeg,png,svg',
            "nama_menu" => 'required|max:60|min:3',
            "harga" => 'required|integer',
        ]);
        if ($validator->passes()) {
            $fotoImg = $request->file('gambar');
            $newName = rand() . '-' . time() . '.' . $fotoImg->getClientOriginalExtension();
            $fotoImg->move(public_path('image/menu'), $newName);
            Menu::create([
                "gambar" => $newName,
                "kategori_id" => $request->kategori,
                "nama_menu" => $request->nama_menu,
                "harga" => $request->harga,
            ]);
            return response()->json(['success' => 'Berhasil membuat menu baru!']);
        } else {
            return response()->json(['error' => $validator->errors()->all()]);
        }
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $kategoris = Kategori::all();
        return view('admin.menus.edit-menu', compact('menu', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);
        $validator =  Validator::make($request->all(), [
            "nama_menu" => 'required|max:60|min:3',
            "harga" => 'required|integer',
        ]);

        if ($validator->passes()) {
            $fotoImg = $request->file('gambar');
            if ($fotoImg == null) {
                $menu->update([
                    "kategori_id" => $request->kategori,
                    "nama_menu" => $request->nama_menu,
                    "harga" => $request->harga,
                ]);
                return response()->json(['success' => 'Berhasil update menu!']);
            } else {
                $newName = rand() . '-' . time() . '.' . $fotoImg->getClientOriginalExtension();
                $fotoImg->move(public_path('image/menu'), $newName);
                $menu->update([
                    "gambar" => $newName,
                    "kategori_id" => $request->kategori,
                    "nama_menu" => $request->nama_menu,
                    "harga" => $request->harga,
                ]);
                return response()->json(['success' => 'Berhasil update menu!']);
            }
        } else {
            return response()->json(['error' => $validator->errors()->all()]);
        }
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();
        return response()->json(['success' => 'Berhasil hapus menu!']);
    }
}
