<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Menu;
use App\Models\Sold;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KasirController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (request()->user()->hasRole('kasir')) {
            $kategoris = Kategori::all();
            return view('kasir.index', compact('kategoris'));
        } else {
            return redirect('/login');
        }
    }
    public function allMenu()
    {
        $menus = Menu::with('kategori')
            ->orderBy('id', 'desc')->get();
        return view('kasir.all-menu', compact('menus'));
    }

    public function menuPerkategori($kategori_id)
    {
        $menus = Menu::with('kategori')
            ->where('kategori_id', $kategori_id)
            ->orderBy('id', 'desc')->get();
        return view('kasir.menu-perkategori', compact('menus'));
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
                    <div class="col-2 mb-4 text-center">
                        <a class="text-dark text-decoration-none" onclick="selectMenu(' . $row->id . ')" style="cursor: pointer">
                            <img src="' . url("image/menu/" . $row->gambar) . '"width="90" class="mr-1 ml-auto mr-auto">
                            <small>' . $row->nama_menu . '</small>
                        </a>
                    </div>
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
                'menu_kasir'  => $output,
                'total_data'  => $total_row
            );

            echo json_encode($data);
        }
    }

    public function getSolds()
    {
        $solds = Sold::where('counted', 0)->get();
        return view('kasir.data-sold', compact('solds'));
    }

    public function store($id)
    {
        $user = Auth::user();
        $cek = Sold::where('menu_id', $id)->where('counted', 0)->first();
        if ($cek == null) {
            $user->sold()->create([
                "quantity" => 1,
                "menu_id" => $id,
                "tanggal" => date('Y-m-d'),
            ]);
        } else {
            $cek->update([
                "quantity" => $cek->quantity + 1,
            ]);
        }
    }

    public function reset()
    {
        $reset = Sold::where('counted', 0)->update([
            "counted" => 1,
        ]);
        return $reset;
    }

    public function updateQty($id, $qty)
    {
        $jumlah = Sold::findOrFail($id);
        $jumlah->update([
            'quantity' => $qty,
        ]);
    }

    public function destroy($id)
    {
        Sold::findOrFail($id)->delete();
    }
}
