<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function purchase_goods()
    {
        $suppliers = DB::table('tb_employees')->where('level_id', 3)->get();

        $products = DB::table('tb_products')->get();

        return view('transaction.purchase_goods', compact('suppliers', 'products'));
    }

    public function purchase_goods_store(Request $request)
    {
        $request->validate([
            'supplier_id'        => 'required|exists:employees,id',
            'purchase_date'      => 'required|date',
            'items'              => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.qty'        => 'required|integer|min:1',
            'items.*.price'      => 'required|numeric|min:0',
        ]);

        $purchase = Purchase::create([
            'supplier_id'   => $request->supplier_id,
            'purchase_date' => $request->purchase_date,
            'total_price'   => 0,
        ]);

        $totalPrice = 0;

        foreach ($request->items as $item)
        {
            $subtotal = $item['qty'] * $item['price'];
            PurchaseItem::create([
                'purchase_id' => $purchase->id,
                'product_id'  => $item['product_id'],
                'qty'         => $item['qty'],
                'price'       => $item['price'],
            ]);
            $totalPrice += $subtotal;
        }

        $purchase->update(['total_price' => $totalPrice]);

        return redirect()->route('purchases.create')->with('success', 'Pembelian berhasil disimpan.');
    }

    public function goods_receipt()
    {
        $suppliers = DB::table('tb_employees')->where('level_id', 3)->get();

        $products = DB::table('tb_products')->get();

        return view('transaction.goods_receipt', compact('suppliers', 'products'));
    }

    public function goods_receipt_store(Request $request)
    {
        $request->validate([
            'supplier_id'        => 'required|exists:employees,id',
            'receipt_date'       => 'required|date',
            'items'              => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.qty'        => 'required|integer|min:1',
        ]);

        $receipt = Receipt::create([
            'supplier_id'  => $request->supplier_id,
            'receipt_date' => $request->receipt_date,
            'total_qty'    => 0,
        ]);

        $totalQty = 0;

        foreach ($request->items as $item)
        {
            ReceiptItem::create([
                'receipt_id' => $receipt->id,
                'product_id' => $item['product_id'],
                'qty'        => $item['qty'],
            ]);

            $totalQty += $item['qty'];
        }

        $receipt->update(['total_qty' => $totalQty]);

        return redirect()->route('receipts.create')->with('success', 'Penerimaan barang berhasil disimpan.');
    }

    public function stock_transactions()
    {
        $data = DB::table('tb_products')
        ->leftJoin(DB::raw('(SELECT product_id, SUM(quantity) as total_purchase FROM tb_purchase_items GROUP BY product_id) as purchases'), 'tb_products.id', '=', 'purchases.product_id')
        ->leftJoin(DB::raw('(SELECT product_id, SUM(quantity) as total_receipt FROM tb_receipt_items GROUP BY product_id) as receipts'), 'tb_products.id', '=', 'receipts.product_id')
        ->select(
            'tb_products.id',
            'tb_products.name',
            'tb_products.initial_stock',
            DB::raw('COALESCE(purchases.total_purchase, 0) as total_purchase'),
            DB::raw('COALESCE(receipts.total_receipt, 0) as total_receipt'),
            DB::raw('tb_products.initial_stock + COALESCE(purchases.total_purchase, 0) + COALESCE(receipts.total_receipt, 0) as available_stock')
        )
        ->get();

        return view('transaction.stock_transactions', compact('data'));
    }
}
