@extends('layouts.main')

@php
    $manu = 'ประวัติการขาย';
@endphp

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">ประวัติการขาย</h1>
    <div class=" overflow-x-auto">
    <table class="table-auto w-full border-collapse border border-gray-200 bg-white shadow-md">
        <thead class="bg-gray-100">
            <tr>
                <th class="border text-nowrap border-gray-300 px-4 py-2 text-left">รหัสคำสั่งซื้อ</th>
                <th class="border text-nowrap border-gray-300 px-4 py-2 text-left">วันที่</th>
                <th class="border text-nowrap border-gray-300 px-4 py-2 text-right">ยอดรวม (฿)</th>
                <th class="border text-nowrap border-gray-300 px-4 py-2 text-center">รายการ</th>
                <th class="border text-nowrap border-gray-300 px-4 py-2 text-center">วิธีการชำระเงิน</th>
                <th class="border text-nowrap border-gray-300 px-4 py-2 text-center">รายละเอียด</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr>
                    <td class="border text-nowrap border-gray-300 px-4 py-2">{{ $order->order_number }}</td>
                    <td class="border text-nowrap border-gray-300 px-4 py-2">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td class="border text-nowrap border-gray-300 px-4 py-2 text-right">{{ number_format($order->total_amount, 2) }}</td>
                    <td class="border text-nowrap border-gray-300 px-4 py-2 text-center">{{ $order->items->count() }}</td>
                    <td class="border text-nowrap border-gray-300 px-4 py-2 text-center">
                        {{ $order->payment_method === 'cash' ? 'เงินสด' : 'ออนไลน์' }}
                    </td>
                    <td class="border text-nowrap border-gray-300 px-4 py-2 text-center">
                        <a href="{{ route('sales.detail', $order->id) }}" class="text-blue-500 hover:underline">ดูรายละเอียด</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-gray-500 py-4">ไม่มีข้อมูลคำสั่งซื้อ</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
    <div class="mt-6">
        {{ $orders->links() }}
    </div>
</div>
@endsection
