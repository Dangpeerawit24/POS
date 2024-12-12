@extends('layouts.main')
@php
    $manu = 'จัดการสต็อกสินค้า';
@endphp
@Section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-6">การจัดการสต็อกสินค้า</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-4">
                {{ session('error') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="table-auto w-full border-collapse border border-gray-200 bg-white shadow-md">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border text-nowrap border-gray-300 px-4 py-2 text-left">ชื่อสินค้า</th>
                        <th class="border text-nowrap border-gray-300 px-4 py-2 text-right">จำนวนสต็อก</th>
                        <th class="border text-nowrap border-gray-300 px-4 py-2 text-center">ผู้ดำเนินการล่าสุด</th>
                        <th class="border text-nowrap border-gray-300 px-4 py-2 text-center">การจัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td class="border text-nowrap border-gray-300 px-4 py-2">{{ $product->name }}</td>
                            <td class="border text-nowrap border-gray-300 px-4 py-2 text-right">
                                {{ $product->stock_quantity }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">
                                @if ($product->latestStockMovement)
                                    {{ $product->latestStockMovement->user ? $product->latestStockMovement->user->name : 'ไม่ระบุ' }}
                                @else
                                    ไม่มีข้อมูล
                                @endif
                            </td>
                            <td class="border text-nowrap border-gray-300 px-4 py-2 text-center">
                                @if (Auth::user()->type === 'admin')
                                    <form action="{{ route('stock.add', $product->id) }}" method="POST"
                                        class="inline-block">
                                        @csrf
                                        <input type="number" name="quantity"
                                            class="w-16 sm:w-24 px-2 py-1 border rounded-lg" placeholder="จำนวน">
                                        <button type="submit"
                                            class="sm:w-10 md:w-16 px-2 py-1 bg-green-500 text-white rounded-lg text-sm sm:text-base">เพิ่ม</button>
                                    </form>
                                    <form action="{{ route('stock.reduce', $product->id) }}" method="POST"
                                        class="inline-block ml-2">
                                        @csrf
                                        <input type="number" name="quantity"
                                            class="w-16 sm:w-24 px-2 py-1 border rounded-lg" placeholder="จำนวน">
                                        <button type="submit"
                                            class="sm:w-10 md:w-16 px-2 py-1 bg-red-500 text-white rounded-lg text-sm sm:text-base">ลด</button>
                                    </form>
                                @elseif (Auth::user()->type === 'manager')
                                    <form action="{{ route('manager.stock.add', $product->id) }}" method="POST"
                                        class="inline-block">
                                        @csrf
                                        <input type="number" name="quantity"
                                            class="w-16 sm:w-24 px-2 py-1 border rounded-lg" placeholder="จำนวน">
                                        <button type="submit"
                                            class="sm:w-10 md:w-16 px-2 py-1 bg-green-500 text-white rounded-lg text-sm sm:text-base">เพิ่ม</button>
                                    </form>
                                    <form action="{{ route('manager.stock.reduce', $product->id) }}" method="POST"
                                        class="inline-block ml-2">
                                        @csrf
                                        <input type="number" name="quantity"
                                            class="w-16 sm:w-24 px-2 py-1 border rounded-lg" placeholder="จำนวน">
                                        <button type="submit"
                                            class="sm:w-10 md:w-16 px-2 py-1 bg-red-500 text-white rounded-lg text-sm sm:text-base">ลด</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endSection
