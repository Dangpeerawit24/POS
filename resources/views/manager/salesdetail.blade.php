@extends('layouts.main')

@php
    $manu = 'ประวัติการขาย';
@endphp

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-6">รายละเอียดคำสั่งซื้อ</h1>

        <!-- ข้อมูลคำสั่งซื้อ -->
        <div class="bg-white p-6 shadow-md rounded-lg">
            <p><strong>รหัสคำสั่งซื้อ:</strong> {{ $order->order_number }}</p>
            <p><strong>วันที่:</strong> {{ $order->formatted_date }}</p>
            <p><strong>ยอดรวม:</strong> {{ $order->formatted_total }}</p>
            <p><strong>วิธีการชำระเงิน:</strong> {{ $order->payment_method_label }}</p>
            <p><strong>พนักงานขาย:</strong> {{ $order->user ? $order->user->name : 'ไม่ระบุ' }}</p>
            @if ($order->payment_method_label === 'ออนไลน์')
                <button onclick="openSlipModal('{{ asset($order->proof_image) }}')"
                    class="px-4 py-2 mt-3 bg-blue-500 text-white rounded hover:bg-blue-600">สลิปหลักฐานการโอน</button>
            @endif
        </div>

        <!-- รายการสินค้า -->
        <h2 class="text-xl font-bold mt-6 mb-4">รายการสินค้า</h2>
        <div class=" overflow-x-auto">
            <table class="table-auto w-full border-collapse border border-gray-200 bg-white shadow-md">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border text-nowrap border-gray-300 px-4 py-2 text-left">ชื่อสินค้า</th>
                        <th class="border text-nowrap border-gray-300 px-4 py-2 text-right">ราคา (฿)</th>
                        <th class="border text-nowrap border-gray-300 px-4 py-2 text-center">จำนวน</th>
                        <th class="border text-nowrap border-gray-300 px-4 py-2 text-right">รวม (฿)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $item)
                        <tr>
                            <td class="border text-nowrap border-gray-300 px-4 py-2">
                                {{ $item->product ? $item->product->name : 'สินค้าถูกลบ' }}</td>
                            <td class="border text-nowrap border-gray-300 px-4 py-2 text-right">
                                {{ number_format($item->price, 2) }}</td>
                            <td class="border text-nowrap border-gray-300 px-4 py-2 text-center">{{ $item->quantity }}</td>
                            <td class="border text-nowrap border-gray-300 px-4 py-2 text-right">
                                {{ number_format($item->price * $item->quantity, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div id="slipModal" class="fixed inset-0 px-2 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-4">
            <!-- ปุ่มปิด -->
            <div class="flex justify-end">
                <button onclick="closeSlipModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fa-solid fa-times"></i> <!-- ไอคอนปิด -->
                </button>
            </div>
            <!-- ภาพสลิป -->
            <div class="mt-2">
                <img id="slipImage" src="" alt="สลิปการโอน" class="rounded-lg w-full">
            </div>
        </div>
    </div>
    <script>
        function openSlipModal(imageUrl) {
            const modal = document.getElementById('slipModal');
            const slipImage = document.getElementById('slipImage');

            // ตั้งค่ารูปภาพใน Modal
            slipImage.src = imageUrl;

            // แสดง Modal
            modal.classList.remove('hidden');
        }

        function closeSlipModal() {
            const modal = document.getElementById('slipModal');

            // ซ่อน Modal
            modal.classList.add('hidden');
        }
    </script>
@endsection
