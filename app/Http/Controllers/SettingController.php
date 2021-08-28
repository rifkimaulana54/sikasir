<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function setting()
    {
        $setting = DB::table('settings')->first();
        return view('admin.settings.setting', compact('setting'));
    }

    public function edit($id)
    {
        $setting = DB::table('settings')->where('id', $id)->first();
        return view('admin.settings.edit-setting', compact('setting'));
    }

    public function update(Request $request, $id)
    {
        $setting = DB::table('settings')->where('id', $id);
        $validator =  Validator::make($request->all(), [
            "nama_brand" => 'required',
        ]);

        if ($validator->passes()) {
            $logoImg = $request->file('logo');
            if ($logoImg == null) {
                $setting->update([
                    "nama_brand" => $request->nama_brand,
                ]);
                return response()->json(['success' => 'Berhasil update app!']);
            } else {
                $newName = rand() . '-' . time() . '.' . $logoImg->getClientOriginalExtension();
                $logoImg->move(public_path('image/'), $newName);
                $setting->update([
                    "logo" => $newName,
                    "nama_brand" => $request->nama_brand,
                ]);
                return response()->json(['success' => 'Berhasil update app!']);
            }
        } else {
            return response()->json(['error' => $validator->errors()->all()]);
        }
    }

    public function newData()
    {
        $setting = DB::table('settings')->first();
        return view('admin.settings.new-data-sett', compact('setting'));
    }
}
