<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\StockMovement;

class StockController extends Controller
{
    // แสดงรายการสินค้าและสต็อก
    public function index()
    {
        $products = Product::with('latestStockMovement.user')->get();

        return view('admin.stock', compact('products'));
    }


    // เพิ่มสินค้าในสต็อก
    public function addStock(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'note' => 'nullable|string',
        ]);

        $product = Product::findOrFail($id);
        $product->increment('stock_quantity', $request->quantity);

        StockMovement::create([
            'product_id' => $product->id,
            'user_id' => auth()->id(), // บันทึก ID ของผู้ใช้งาน
            'quantity' => $request->quantity,
            'type' => 'in',
            'note' => $request->note,
        ]);

        return redirect()->route('admin.stock')->with('success', 'เพิ่มสินค้าในสต็อกเรียบร้อย');
    }


    // ลดสินค้าในสต็อก
    public function reduceStock(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'note' => 'nullable|string',
        ]);

        $product = Product::findOrFail($id);

        if ($product->stock_quantity < $request->quantity) {
            return redirect()->back()->with('error', 'สต็อกสินค้าไม่เพียงพอ');
        }

        $product->decrement('stock_quantity', $request->quantity);

        StockMovement::create([
            'product_id' => $product->id,
            'user_id' => auth()->id(), // บันทึก ID ของผู้ใช้งาน
            'quantity' => $request->quantity,
            'type' => 'out',
            'note' => $request->note,
        ]);

        return redirect()->route('admin.stock')->with('success', 'ลดสินค้าในสต็อกเรียบร้อย');
    }
}
