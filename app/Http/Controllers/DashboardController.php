<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // คำนวณยอดขายรวมเฉพาะคำสั่งซื้อที่สถานะเป็น 'completed'
        $totalSales = Order::where('status', 'completed')->sum('total_amount');

        // นับจำนวนคำสั่งซื้อที่สถานะเป็น 'completed'
        $totalOrders = Order::where('status', 'completed')->count();

        // คำนวณยอดขายเฉพาะวันนี้
        $salesToday = Order::where('status', 'completed')
            ->whereDate('created_at', today())
            ->sum('total_amount');

        // สินค้าที่ใกล้หมดสต็อก
        $lowStockProducts = Product::where('stock_quantity', '<', 10)->get();

        // การอัปเดตสต็อกล่าสุด
        $recentStockMovements = StockMovement::with('user', 'product')->latest()->take(5)->get();

        // คำสั่งซื้อที่ถูกยกเลิก
        $cancelledOrders = Order::where('status', 'cancelled')->orderBy('created_at', 'desc')->get();

        // ส่งข้อมูลไปยัง View
        if (Auth::user()->type === 'admin') {
            return view('admin.dashboard', compact('totalSales', 'totalOrders', 'salesToday', 'lowStockProducts', 'recentStockMovements', 'cancelledOrders'));
        }elseif (Auth::user()->type === 'manager') {
            return view('manager.dashboard', compact('totalSales', 'totalOrders', 'salesToday', 'lowStockProducts', 'recentStockMovements', 'cancelledOrders'));
        }else {
            return view('home', compact('products'));
        }
    }
}
