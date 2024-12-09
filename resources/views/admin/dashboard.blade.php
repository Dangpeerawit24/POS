@extends('layouts.main')
@php
    $manu = 'แดชบอร์ด';
@endphp
@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Dashboard</h1>

    <!-- สถิติรวม -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="p-4 bg-white shadow rounded-lg">
            <h2 class="text-lg font-semibold">ยอดขายรวม</h2>
            <p class="text-2xl font-bold text-green-500">฿{{ number_format($totalSales, 2) ?? 'ไม่พบข้อมูล' }}</p>
        </div>
        <div class="p-4 bg-white shadow rounded-lg">
            <h2 class="text-lg font-semibold">จำนวนคำสั่งซื้อ</h2>
            <p class="text-2xl font-bold">{{ $totalOrders }}</p>
        </div>
        <div class="p-4 bg-white shadow rounded-lg">
            <h2 class="text-lg font-semibold">สินค้าใกล้หมดสต็อก</h2>
            <p class="text-2xl font-bold text-red-500">{{ $lowStockProducts->count() }}</p>
        </div>
    </div>

    <!-- สินค้าใกล้หมดสต็อก -->
    <div class="mt-6">
        <h2 class="text-xl font-bold mb-4">สินค้าใกล้หมดสต็อก</h2>
        <div class="overflow-x-auto">
            <table class="table-auto w-full border-collapse border border-gray-200 bg-white shadow-md">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2 text-left">ชื่อสินค้า</th>
                        <th class="border border-gray-300 px-4 py-2 text-right">จำนวนคงเหลือ</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($lowStockProducts as $product)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">{{ $product->name }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-right">{{ $product->stock_quantity }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="border border-gray-300 px-4 py-2 text-center">ไม่มีสินค้าใกล้หมดสต็อก</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- การอัปเดตสต็อกล่าสุด -->
    <div class="mt-6">
        <h2 class="text-xl font-bold mb-4">การอัปเดตสต็อกล่าสุด</h2>
        <div class="overflow-x-auto">
            <table class="table-auto w-full border-collapse border border-gray-200 bg-white shadow-md">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border text-nowrap border-gray-300 px-4 py-2 text-left">สินค้า</th>
                        <th class="border text-nowrap border-gray-300 px-4 py-2 text-left">การดำเนินการ</th>
                        <th class="border text-nowrap border-gray-300 px-4 py-2 text-right">จำนวน</th>
                        <th class="border text-nowrap border-gray-300 px-4 py-2 text-left">ผู้ดำเนินการ</th>
                        <th class="border text-nowrap border-gray-300 px-4 py-2 text-left">เวลา</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentStockMovements as $movement)
                        <tr>
                            <td class="border text-nowrap border-gray-300 px-4 py-2">{{ $movement->product->name }}</td>
                            <td class="border text-nowrap border-gray-300 px-4 py-2">{{ $movement->type === 'in' ? 'เพิ่ม' : 'ลด' }}</td>
                            <td class="border text-nowrap border-gray-300 px-4 py-2 text-right">{{ $movement->quantity }}</td>
                            <td class="border text-nowrap border-gray-300 px-4 py-2">{{ $movement->user->name ?? 'ไม่ระบุ' }}</td>
                            <td class="border text-nowrap border-gray-300 px-4 py-2">{{ $movement->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="border border-gray-300 px-4 py-2 text-center">ไม่มีการอัปเดตสต็อกล่าสุด</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
