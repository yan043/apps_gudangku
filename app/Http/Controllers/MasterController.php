<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class MasterController extends Controller
{
    public function categories()
    {
        $data = DB::table('tb_categories')->get();

        return view('master.categories', compact('data'));
    }

    public function categories_store(Request $request)
    {
        switch ($request->id)
        {
            case 'new':
                    DB::table('tb_categories')
                    ->insert([
                        'name'       => $request->name,
                        'created_at' => date('Y-m-d H:i:s'),
                        'created_by' => Session::get('nik')
                    ]);
                break;

            default:
                    DB::table('tb_categories')
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

        return redirect()->route('master.categories');
    }

    public function categories_destroy($id)
    {
        $category = DB::table('tb_categories')->where('id', $id)->first();

        if (!$category)
        {
            return redirect()->route('master.categories')->with('alert', [
                'type'    => 'danger',
                'message' => 'Kategori tidak ditemukan!'
            ]);
        }

        DB::table('tb_categories')->where('id', $id)->delete();

        return redirect()->route('master.categories')->with('alert', [
            'type'    => 'success',
            'message' => 'Kategori berhasil dihapus!'
        ]);
    }

    public function products()
    {
        $categories = DB::table('tb_categories')->get();

        $data = DB::table('tb_products AS tp')
        ->leftJoin('tb_categories AS tc', 'tp.category_id', '=', 'tc.id')
        ->select('tp.*', 'tc.name AS category_name')
        ->get();

        return view('master.products', compact('categories', 'data'));
    }

    public function products_store(Request $request)
    {
        switch ($request->id)
        {
            case 'new':
                    DB::table('tb_products')
                    ->insert([
                        'category_id'    => $request->category_id,
                        'code'           => $request->code,
                        'name'           => $request->name,
                        'quantity'       => $request->quantity,
                        'unit'           => $request->unit,
                        'purchase_price' => $request->purchase_price,
                        'selling_price'  => $request->selling_price,
                        'created_at'     => date('Y-m-d H:i:s'),
                        'created_by'     => Session::get('nik')
                    ]);
                break;

            default:
                    DB::table('tb_products')
                    ->where('id', $request->id)
                    ->update([
                        'category_id'    => $request->category_id,
                        'code'           => $request->code,
                        'name'           => $request->name,
                        'quantity'       => $request->quantity,
                        'unit'           => $request->unit,
                        'purchase_price' => $request->purchase_price,
                        'selling_price'  => $request->selling_price,
                        'updated_at'     => date('Y-m-d H:i:s'),
                        'updated_by'     => Session::get('nik')
                    ]);
                break;
        }

        session()->flash('alert', [
            'type'    => 'primary',
            'message' => 'Data berhasil disimpan!'
        ]);

        return redirect()->route('master.products');
    }

    public function products_destroy($id)
    {
        $category = DB::table('tb_products')->where('id', $id)->first();

        if (!$category)
        {
            return redirect()->route('master.products')->with('alert', [
                'type'    => 'danger',
                'message' => 'Barang tidak ditemukan!'
            ]);
        }

        DB::table('tb_products')->where('id', $id)->delete();

        return redirect()->route('master.products')->with('alert', [
            'type'    => 'success',
            'message' => 'Barang berhasil dihapus!'
        ]);
    }
}
