@php
    $manu = 'หน้าขาย';
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.head')
</head>

<body class="p-0 m-0 box-border">
    <div class="w-full flex flex-col">
        <div class=" flex flex-row">
            <div
                class="w-full h-20 fixed top-0 z-40 bg-sky-900 shadow-lg text-white content-center justify-items-center">
                <div class="w-full mx-0 px-4 sm:px-4 lg:px-8">
                    <div class="flex justify-between h-16 items-center">
                        <!-- Logo -->
                        <a href="" class="text-lg flex flex-row gap-2 items-center font-semibold "><img
                                src="{{ asset('img/AdminLogo.png') }}" width="50px" alt=""> ระบบขายวัตุมงคล</a>
                        <!-- Menu Button -->
                        <div class="lg:hidden">
                            <label for="menu-toggle" class="cursor-pointer">
                                <svg class="w-6 h-6 " fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16m-7 6h7"></path>
                                </svg>
                            </label>
                            <input type="checkbox" id="menu-toggle" class="hidden">
                        </div>
                        <!-- Desktop Links -->
                        <div class="hidden lg:flex items-center justify-between gap-4	border-sky-100	">
                            <div class=" items-center gap-1">
                                <h2 class="text-xl">{{ Auth::user()->name }}</h2>
                                <h2 class="text-md">สิทธิ์การใช้งาน : {{ Auth::user()->type }}</h2>
                            </div>
                            <form id="logout-form" method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="#" id="logout-btn"
                                    class="flex items-center gap-2 p-2 rounded bg-sky-600 text-white hover:bg-sky-700">
                                    Logout
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Slide-in Menu -->
                <div id="menu"
                    class="fixed inset-0 bg-sky-900 text-white z-20 transform -translate-x-full transition-transform duration-300 ease-in-out">
                    <div class="flex flex-col h-full">
                        <!-- Close Button -->
                        <div class="flex justify-between p-4">
                            <h1 class="text-3xl">
                                เมนูจัดการระบบ
                            </h1>
                            <button id="close-menu" class="text-white hover:text-gray-900">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        <!-- Menu Links -->
                        <div class="flex flex-col h-full space-y-6">
                            <ul class="flex-1 m-4 p-2 space-y-4">
                                <li class="">
                                    <a href="/admin/pos" class="flex items-center gap-2 p-2 rounded hover:bg-sky-800">
                                        <img src="{{ asset('img/submenu/ic_menu_store_normal.svg') }}" width="30px"
                                            height="30px" alt="">
                                        หน้าขาย
                                    </a>
                                </li>
                                <li class="">
                                    <a href="#" class="flex items-center gap-2 p-2 rounded hover:bg-sky-800">
                                        <img src="{{ asset('img/submenu/ic_dashboard_normal.svg') }}" width="30px"
                                            height="30px" alt="">
                                        แดชบอร์ด
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center gap-2 p-2 rounded hover:bg-sky-800">
                                        <img src="{{ asset('img/submenu/ic_menu_receipt_normal.svg') }}" width="30px"
                                            height="30px" alt="">
                                        ประวัติการขาย
                                    </a>
                                </li>
                                <li>
                                    <a href="/admin/products"
                                        class="flex items-center gap-2 p-2 rounded hover:bg-sky-800">
                                        <img src="{{ asset('img/submenu/ic_menu_fullstock_v2_normal.svg') }}"
                                            width="30px" height="30px" alt="">
                                        จัดการข้อมูลสินค้า
                                    </a>
                                </li>
                                <li>
                                    <a href="/admin/categories"
                                        class="flex items-center gap-2 p-2 rounded hover:bg-sky-800">
                                        <img src="{{ asset('img/submenu/ic_wholesale.svg') }}" width="30px"
                                            height="30px" alt="">
                                        จัดการประเภทสินค้า
                                    </a>
                                </li>
                                <li>
                                    <a href="/admin/users" class="flex items-center gap-2 p-2 rounded hover:bg-sky-800">
                                        <img src="{{ asset('img/submenu/ic_menu_staff_v2_normal.svg') }}" width="30px"
                                            height="30px" alt="">
                                        จัดการพนักงาน
                                    </a>
                                </li>
                                <div class="flex items-center justify-between border-t p-2	border-sky-100	">
                                    <div class=" items-center gap-1">
                                        <h2 class="text-xl">{{ Auth::user()->name }}</h2>
                                        <h2 class="text-md">สิทธิ์การใช้งาน : {{ Auth::user()->type }}</h2>
                                    </div>
                                    <form id="logout-form2" method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a href="#" id="logout-btn2"
                                            class="flex items-center gap-2 p-2 rounded bg-sky-600 text-white hover:bg-sky-700">
                                            Logout
                                        </a>
                                    </form>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-20 flex flex-row">
            <div class=" hidden lg:flex w-64 h-screen fixed bg-sky-900 text-white  flex-col">
                {{-- <div class="p-4 text-center font-bold text-2xl border-b p-2	border-sky-100">
                        เมนูจัดการระบบ
                    </div> --}}
                <ul class="flex-1 m-4 p-2 space-y-4">
                    <li class="">
                        <a href="/admin/pos"
                            class="flex items-center gap-2 p-2 rounded {{ $manu == 'หน้าขาย' ? ' bg-sky-600 scale-125' : '' }} hover:bg-sky-800 hover:scale-110	">
                            <img src="{{ asset('img/submenu/ic_menu_store_normal.svg') }}" width="30px"
                                height="30px" alt="">
                            หน้าขาย
                        </a>
                    </li>
                    <li class="">
                        <a href="#"
                            class="flex items-center gap-2 p-2 rounded {{ $manu == 'แดชบอร์ด' ? ' bg-sky-600 scale-125' : '' }} hover:bg-sky-800 hover:scale-110	">
                            <img src="{{ asset('img/submenu/ic_dashboard_normal.svg') }}" width="30px"
                                height="30px" alt="">
                            แดชบอร์ด
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center gap-2 p-2 rounded  hover:bg-sky-800 hover:scale-110	">
                            <img src="{{ asset('img/submenu/ic_menu_receipt_normal.svg') }}" width="30px"
                                height="30px" alt="">
                            ประวัติการขาย
                        </a>
                    </li>
                    <li>
                        <a href="/admin/products"
                            class="flex items-center gap-2 p-2 rounded {{ $manu == 'จัดการข้อมูลสินค้า' ? ' bg-sky-600 scale-125' : '' }} hover:bg-sky-800 hover:scale-110	">
                            <img src="{{ asset('img/submenu/ic_menu_fullstock_v2_normal.svg') }}" width="30px"
                                height="30px" alt="">
                            จัดการข้อมูลสินค้า
                        </a>
                    </li>
                    <li>
                        <a href="/admin/categories"
                            class="flex items-center gap-2 p-2 rounded {{ $manu == 'จัดการประเภทสินค้า' ? ' bg-sky-600 scale-125' : '' }} hover:bg-sky-800 hover:scale-110	">
                            <img src="{{ asset('img/submenu/ic_wholesale.svg') }}" width="30px" height="30px"
                                alt="">
                            จัดการประเภทสินค้า
                        </a>
                    </li>
                    <li>
                        <a href="/admin/users"
                            class="flex items-center gap-2 p-2 rounded {{ $manu == 'พนักงาน' ? ' bg-sky-600 scale-125' : '' }} hover:bg-sky-800 hover:scale-110	">
                            <img src="{{ asset('img/submenu/ic_menu_staff_v2_normal.svg') }}" width="30px"
                                height="30px" alt="">
                            จัดการพนักงาน
                        </a>
                    </li>
                </ul>
            </div>
            <div class="lg:ml-64 w-full flex flex-row p-1">
                <div class="w-full lg:w-3/5 rounded-lg shadow-lg bg-gray-100 overflow-y-scroll">
                    <div class="p-6 w-full h-auto bg-white">
                        <h2 class=" text-2xl">เลือกประเภทสินค้า</h2>
                    </div>
                    <div class="mt-4 grid grid-cols-2 mb-48 md:grid-cols-3 xl:grid-cols-4 ">
                        <div class=" bg-sky-100 w-48 md:w-auto h-auto mt-3 m-1 p-2 rounded-lg shadow-xl border-2 border-blue-300 hover:scale-105 transition-transform duration-500 ease-in-out	">
                            <img src="{{ asset('img/เทียน.png') }}" alt="">
                            <h1 class=" text-lg font-bold mt-2">กิมกังวัชระ</h1>
                            <p class=" text-xl font-bold text-sky-500">฿100.00</p>
                        </div>
                        <div class=" bg-sky-100 w-48 md:w-auto h-auto mt-3 m-1 p-2 rounded-lg shadow-xl border-2 border-blue-300 hover:scale-105 transition-transform duration-500 ease-in-out	">
                            <img src="{{ asset('img/เทียน.png') }}" alt="">
                            <h1 class=" text-lg font-bold mt-2">กิมกังวัชระ</h1>
                            <p class=" text-xl font-bold text-sky-500">฿100.00</p>
                        </div>
                        <div class=" bg-sky-100 w-48 md:w-auto h-auto mt-3 m-1 p-2 rounded-lg shadow-xl border-2 border-blue-300 hover:scale-105 transition-transform duration-500 ease-in-out	">
                            <img src="{{ asset('img/เทียน.png') }}" alt="">
                            <h1 class=" text-lg font-bold mt-2">กิมกังวัชระ</h1>
                            <p class=" text-xl font-bold text-sky-500">฿100.00</p>
                        </div>
                        <div class=" bg-sky-100 w-48 md:w-auto h-auto mt-3 m-1 p-2 rounded-lg shadow-xl border-2 border-blue-300 hover:scale-105 transition-transform duration-500 ease-in-out	">
                            <img src="{{ asset('img/เทียน.png') }}" alt="">
                            <h1 class=" text-lg font-bold mt-2">กิมกังวัชระ</h1>
                            <p class=" text-xl font-bold text-sky-500">฿100.00</p>
                        </div>
                        <div class=" bg-sky-100 w-48 md:w-auto h-auto mt-3 m-1 p-2 rounded-lg shadow-xl border-2 border-blue-300 hover:scale-105 transition-transform duration-500 ease-in-out	">
                            <img src="{{ asset('img/เทียน.png') }}" alt="">
                            <h1 class=" text-lg font-bold mt-2">กิมกังวัชระ</h1>
                            <p class=" text-xl font-bold text-sky-500">฿100.00</p>
                        </div>
                        <div class=" bg-sky-100 w-48 md:w-auto h-auto mt-3 m-1 p-2 rounded-lg shadow-xl border-2 border-blue-300 hover:scale-105 transition-transform duration-500 ease-in-out	">
                            <img src="{{ asset('img/เทียน.png') }}" alt="">
                            <h1 class=" text-lg font-bold mt-2">กิมกังวัชระ</h1>
                            <p class=" text-xl font-bold text-sky-500">฿100.00</p>
                        </div>
                        <div class=" bg-sky-100 w-48 md:w-auto h-auto mt-3 m-1 p-2 rounded-lg shadow-xl border-2 border-blue-300 hover:scale-105 transition-transform duration-500 ease-in-out	">
                            <img src="{{ asset('img/เทียน.png') }}" alt="">
                            <h1 class=" text-lg font-bold mt-2">กิมกังวัชระ</h1>
                            <p class=" text-xl font-bold text-sky-500">฿100.00</p>
                        </div>
                        <div class=" bg-sky-100 w-48 md:w-auto h-auto mt-3 m-1 p-2 rounded-lg shadow-xl border-2 border-blue-300 hover:scale-105 transition-transform duration-500 ease-in-out	">
                            <img src="{{ asset('img/เทียน.png') }}" alt="">
                            <h1 class=" text-lg font-bold mt-2">กิมกังวัชระ</h1>
                            <p class=" text-xl font-bold text-sky-500">฿100.00</p>
                        </div>
                        <div class=" bg-sky-100 w-48 md:w-auto h-auto mt-3 m-1 p-2 rounded-lg shadow-xl border-2 border-blue-300 hover:scale-105 transition-transform duration-500 ease-in-out	">
                            <img src="{{ asset('img/เทียน.png') }}" alt="">
                            <h1 class=" text-lg font-bold mt-2">กิมกังวัชระ</h1>
                            <p class=" text-xl font-bold text-sky-500">฿100.00</p>
                        </div>
                        <div class=" bg-sky-100 w-48 md:w-auto h-auto mt-3 m-1 p-2 rounded-lg shadow-xl border-2 border-blue-300 hover:scale-105 transition-transform duration-500 ease-in-out	">
                            <img src="{{ asset('img/เทียน.png') }}" alt="">
                            <h1 class=" text-lg font-bold mt-2">กิมกังวัชระ</h1>
                            <p class=" text-xl font-bold text-sky-500">฿100.00</p>
                        </div>
                        <div class=" bg-sky-100 w-48 md:w-auto h-auto mt-3 m-1 p-2 rounded-lg shadow-xl border-2 border-blue-300 hover:scale-105 transition-transform duration-500 ease-in-out	">
                            <img src="{{ asset('img/เทียน.png') }}" alt="">
                            <h1 class=" text-lg font-bold mt-2">กิมกังวัชระ</h1>
                            <p class=" text-xl font-bold text-sky-500">฿100.00</p>
                        </div>
                        <div class=" bg-sky-100 w-48 md:w-auto h-auto mt-3 m-1 p-2 rounded-lg shadow-xl border-2 border-blue-300 hover:scale-105 transition-transform duration-500 ease-in-out	">
                            <img src="{{ asset('img/เทียน.png') }}" alt="">
                            <h1 class=" text-lg font-bold mt-2">กิมกังวัชระ</h1>
                            <p class=" text-xl font-bold text-sky-500">฿100.00</p>
                        </div>
                        <div class=" bg-sky-100 w-48 md:w-auto h-auto mt-3 m-1 p-2 rounded-lg shadow-xl border-2 border-blue-300 hover:scale-105 transition-transform duration-500 ease-in-out	">
                            <img src="{{ asset('img/เทียน.png') }}" alt="">
                            <h1 class=" text-lg font-bold mt-2">กิมกังวัชระ</h1>
                            <p class=" text-xl font-bold text-sky-500">฿100.00</p>
                        </div>
                        <div class=" bg-sky-100 w-48 md:w-auto h-auto mt-3 m-1 p-2 rounded-lg shadow-xl border-2 border-blue-300 hover:scale-105 transition-transform duration-500 ease-in-out	">
                            <img src="{{ asset('img/เทียน.png') }}" alt="">
                            <h1 class=" text-lg font-bold mt-2">กิมกังวัชระ</h1>
                            <p class=" text-xl font-bold text-sky-500">฿100.00</p>
                        </div>
                        <div class=" bg-sky-100 w-48 md:w-auto h-auto mt-3 m-1 p-2 rounded-lg shadow-xl border-2 border-blue-300 hover:scale-105 transition-transform duration-500 ease-in-out	">
                            <img src="{{ asset('img/เทียน.png') }}" alt="">
                            <h1 class=" text-lg font-bold mt-2">กิมกังวัชระ</h1>
                            <p class=" text-xl font-bold text-sky-500">฿100.00</p>
                        </div>
                        <div class=" bg-sky-100 w-48 md:w-auto h-auto mt-3 m-1 p-2 rounded-lg shadow-xl border-2 border-blue-300 hover:scale-105 transition-transform duration-500 ease-in-out	">
                            <img src="{{ asset('img/เทียน.png') }}" alt="">
                            <h1 class=" text-lg font-bold mt-2">กิมกังวัชระ</h1>
                            <p class=" text-xl font-bold text-sky-500">฿100.00</p>
                        </div>
                        <div class=" bg-sky-100 w-48 md:w-auto h-auto mt-3 m-1 p-2 rounded-lg shadow-xl border-2 border-blue-300 hover:scale-105 transition-transform duration-500 ease-in-out	">
                            <img src="{{ asset('img/เทียน.png') }}" alt="">
                            <h1 class=" text-lg font-bold mt-2">กิมกังวัชระ</h1>
                            <p class=" text-xl font-bold text-sky-500">฿100.00</p>
                        </div>
                        <div class=" bg-sky-100 w-48 md:w-auto h-auto mt-3 m-1 p-2 rounded-lg shadow-xl border-2 border-blue-300 hover:scale-105 transition-transform duration-500 ease-in-out	">
                            <img src="{{ asset('img/เทียน.png') }}" alt="">
                            <h1 class=" text-lg font-bold mt-2">กิมกังวัชระ</h1>
                            <p class=" text-xl font-bold text-sky-500">฿100.00</p>
                        </div>
                    </div>
                </div>
                <div class=" hidden fixed right-0 lg:flex lg:w-2/6 h-screen  lg:p-5 bg-white overflow-hidden rounded-lg shadow-lg overflow-y-auto">
                    <div class=" w-full ">
                        <div class="p-5 flex items-center justify-between">
                            <h1 class=" text-3xl">ยอดรวมสุทธิ</h1>
                            <h1 class=" text-3xl">110.00 ฿</h1>
                        </div>
                        <div>
                            <button id="openModal" class="px-4 py-2 h-20 w-full  bg-sky-400 text-white rounded hover:bg-sky-600">
                                <h1 class=" text-4xl">ชำระเงิน</h1>
                            </button>
                        </div>
                        <div class="p-5 flex items-center gap-2 justify-end">
                            <h1 class=" text-lg">1 รายการ</h1>
                            <h1 class=" text-lg"> | </h1>
                            <h1 class=" text-lg">1 ชิ้น</h1>
                        </div>
                        <div class="overflow-y-auto h-3/5 px-4">
                            <div class=" w-full mt-2 p-5 px-4 bg-sky-50 rounded-xl overflow-y-auto ">
                                <div class=" flex justify-between">
                                    <h1 class="text-xl">1. สปาเก็ตตี้ขี้เมาทะเล</h1>
                                    <h1 class="text-2xl">110.00</h1>
                                </div>  
                                <div class="mt-2 flex justify-between">
                                    <button id="openModal" class="px-4 py-2 bg-white text-white rounded hover:bg-red-50">
                                        <i class="fa-solid fa-trash-can" style="color: #ff0000;"></i>
                                    </button>
                                    <button><p class="text-xl bg-white rounded-lg px-4 py-2">x1</p></button>
                                </div>
                            </div>
                            <div class=" w-full mt-2 p-5 px-4 bg-sky-50 rounded-xl overflow-y-auto ">
                                <div class=" flex justify-between">
                                    <h1 class="text-xl">1. สปาเก็ตตี้ขี้เมาทะเล</h1>
                                    <h1 class="text-2xl">110.00</h1>
                                </div>  
                                <div class="mt-2 flex justify-between">
                                    <button id="openModal" class="px-4 py-2 bg-white text-white rounded hover:bg-red-50">
                                        <i class="fa-solid fa-trash-can" style="color: #ff0000;"></i>
                                    </button>
                                    <button><p class="text-xl bg-white rounded-lg px-4 py-2">x1</p></button>
                                </div>
                            </div>
                            <div class=" w-full mt-2 p-5 px-4 bg-sky-50 rounded-xl overflow-y-auto ">
                                <div class=" flex justify-between">
                                    <h1 class="text-xl">1. สปาเก็ตตี้ขี้เมาทะเล</h1>
                                    <h1 class="text-2xl">110.00</h1>
                                </div>  
                                <div class="mt-2 flex justify-between">
                                    <button id="openModal" class="px-4 py-2 bg-white text-white rounded hover:bg-red-50">
                                        <i class="fa-solid fa-trash-can" style="color: #ff0000;"></i>
                                    </button>
                                    <button><p class="text-xl bg-white rounded-lg px-4 py-2">x1</p></button>
                                </div>
                            </div>
                            <div class=" w-full mt-2 p-5 px-4 bg-sky-50 rounded-xl overflow-y-auto ">
                                <div class=" flex justify-between">
                                    <h1 class="text-xl">1. สปาเก็ตตี้ขี้เมาทะเล</h1>
                                    <h1 class="text-2xl">110.00</h1>
                                </div>  
                                <div class="mt-2 flex justify-between">
                                    <button id="openModal" class="px-4 py-2 bg-white text-white rounded hover:bg-red-50">
                                        <i class="fa-solid fa-trash-can" style="color: #ff0000;"></i>
                                    </button>
                                    <button><p class="text-xl bg-white rounded-lg px-4 py-2">x1</p></button>
                                </div>
                            </div>
                            <div class=" w-full mt-2 p-5 px-4 bg-sky-50 rounded-xl overflow-y-auto ">
                                <div class=" flex justify-between">
                                    <h1 class="text-xl">1. สปาเก็ตตี้ขี้เมาทะเล</h1>
                                    <h1 class="text-2xl">110.00</h1>
                                </div>  
                                <div class="mt-2 flex justify-between">
                                    <button id="openModal" class="px-4 py-2 bg-white text-white rounded hover:bg-red-50">
                                        <i class="fa-solid fa-trash-can" style="color: #ff0000;"></i>
                                    </button>
                                    <button><p class="text-xl bg-white rounded-lg px-4 py-2">x1</p></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
