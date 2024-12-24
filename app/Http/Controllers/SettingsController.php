<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    public function employee()
    {
        $data = DB::table('tb_employees AS te')
        ->leftJoin('tb_levels AS tl', 'te.level_id', '=', 'tl.id')
        ->select('te.*', 'tl.name AS level_name')
        ->get();

        $level = DB::table('tb_levels')->get();

        return view('settings.employee', compact('data', 'level'));
    }

    public function employee_store(Request $request)
    {
        switch ($request->id)
        {
            case 'new':
                    DB::table('tb_employees')
                    ->insert([
                        'nik'        => $request->nik,
                        'name'       => $request->name,
                        'gender'     => $request->gender,
                        'level_id'   => $request->level_id,
                        'address'    => $request->address,
                        'phone'      => $request->phone,
                        'password'   => Hash::make($request->password),
                        'created_at' => date('Y-m-d H:i:s'),
                        'created_by' => Session::get('nik')
                    ]);
                break;

            default:
                    DB::table('tb_employees')
                    ->where('id', $request->id)
                    ->update([
                        'nik'        => $request->nik,
                        'name'       => $request->name,
                        'gender'     => $request->gender,
                        'level_id'   => $request->level_id,
                        'address'    => $request->address,
                        'phone'      => $request->phone,
                        'password'   => Hash::make($request->password),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'updated_by' => Session::get('nik')
                    ]);

                    if ($request->password != null || $request->password != '')
                    {
                        DB::table('tb_employees')
                        ->where('id', $request->id)
                        ->update([
                            'password'       => Hash::make($request->password),
                            'remember_token' => null,
                            'ip_address'     => null,
                            'login_at'       => null,
                            'updated_at'     => date('Y-m-d H:i:s'),
                            'updated_by'     => Session::get('nik')
                        ]);
                    }
                break;
        }

        session()->flash('alert', [
            'type'    => 'primary',
            'message' => 'Data berhasil disimpan!'
        ]);

        return redirect()->route('settings.employee');
    }

    public function employee_destroy($id)
    {
        $category = DB::table('tb_employees')->where('id', $id)->first();

        if (!$category) {
            return redirect()->route('settings.employee')->with('alert', [
                'type'    => 'danger',
                'message' => 'User tidak ditemukan!'
            ]);
        }

        DB::table('tb_employees')->where('id', $id)->delete();

        return redirect()->route('settings.employee')->with('alert', [
            'type'    => 'success',
            'message' => 'User berhasil dihapus!'
        ]);
    }

    public function level()
    {
        $data = DB::table('tb_levels')->get();

        return view('settings.level', compact('data'));
    }

    public function level_store(Request $request)
    {
        switch ($request->id)
        {
            case 'new':
                    DB::table('tb_levels')
                    ->insert([
                        'name'       => $request->name,
                        'created_at' => date('Y-m-d H:i:s'),
                        'created_by' => Session::get('nik')
                    ]);
                break;

            default:
                    DB::table('tb_levels')
                    ->where('id', $request->id)
                    ->update([
                        'name'       => $request->name,
                        'updated_at' => date('Y-m-d H:i:s'),
                        'updated_by' => Session::get('nik')
                    ]);
                break;
        }

        session()->flash('alert', [
            'type'    => 'primary',
            'message' => 'Data berhasil disimpan!'
        ]);

        return redirect()->route('settings.level');
    }

    public function level_destroy($id)
    {
        $category = DB::table('tb_levels')->where('id', $id)->first();

        if (!$category)
        {
            return redirect()->route('settings.level')->with('alert', [
                'type'    => 'danger',
                'message' => 'Level tidak ditemukan!'
            ]);
        }

        DB::table('tb_levels')->where('id', $id)->delete();

        return redirect()->route('settings.level')->with('alert', [
            'type'    => 'success',
            'message' => 'Level berhasil dihapus!'
        ]);
    }
}
