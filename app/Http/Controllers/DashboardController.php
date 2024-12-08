<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\StockMovement;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSales = Order::sum('total_amount'); // ยอดขายรวม
        $totalOrders = Order::count(); // จำนวนคำสั่งซื้อ
        $lowStockProducts = Product::where('stock_quantity', '<', 10)->get(); // สินค้าใกล้หมดสต็อก
        $recentStockMovements = StockMovement::with('user', 'product')->latest()->take(5)->get(); // การอัปเดตสต็อกล่าสุด

        return view('admin.dashboard', compact('totalSales', 'totalOrders', 'lowStockProducts', 'recentStockMovements'));
    }
}
