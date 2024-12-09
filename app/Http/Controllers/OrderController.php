<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\CashDrawer;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        try {
            // ตรวจสอบข้อมูล
            $validatedData = $request->validate([
                'total_amount' => 'required|numeric|min:0',
                'payment_method' => 'required|string|in:cash,qr',
                'cart' => 'required', // รับได้ทั้ง JSON String หรือ Array
                'received_amount' => 'nullable|numeric|min:0',
                'change' => 'nullable|numeric|min:0',
            ]);

            $cashDrawer = CashDrawer::firstOrCreate(['id' => 1], ['current_balance' => 0.00]);
            
            // แปลง cart จาก JSON String เป็น Array
            $cart = is_string($request->input('cart')) ? json_decode($request->input('cart'), true) : $request->input('cart');

            if (!$cart || !is_array($cart)) {
                return response()->json(['error' => 'Invalid cart data'], 400);
            }

            // บันทึกหลักฐานการโอนเงิน (ถ้ามี)
            if ($request->hasFile('proof_image')) {
                $file = $request->file('proof_image');
                $fileName = time() . '.' . $request->proof_image->extension();
                $file->move(public_path('img/proof_image/'), $fileName);
                $validatedData['proof_image'] = 'img/proof_image/' . $fileName;
            }

            // บันทึกคำสั่งซื้อ
            $order = Order::create([
                'order_number' => uniqid('ORD-'),
                'total_amount' => $validatedData['total_amount'],
                'payment_method' => $validatedData['payment_method'],
                'received_amount' => $validatedData['received_amount'] ?? null,
                'change' => $validatedData['change'] ?? null,
                'proof_image' => $validatedData['proof_image'] ?? null,
                'user_id' => auth()->id(),
            ]);

            foreach ($cart as $item) {
                $product = Product::find($item['id']);

                if ($product) {
                    if ($product->stock_quantity >= $item['quantity']) {
                        $product->decrement('stock_quantity', $item['quantity']);
                    } else {
                        return response()->json(['error' => 'สินค้าไม่เพียงพอ: ' . $product->name], 400);
                    }

                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item['id'],
                        'price' => $item['price'],
                        'quantity' => $item['quantity'],
                    ]);
                }
            }

            if ($validatedData['payment_method'] === 'cash') {
                $cashDrawer->adjustBalance($validatedData['total_amount'], 'add', 'ยอดขายจากคำสั่งซื้อ #' . $order->order_number);
            }

            return response()->json([
                'message' => 'บันทึกคำสั่งซื้อสำเร็จ',
                'order' => $order,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'เกิดข้อผิดพลาด: ' . $e->getMessage()], 500);
        }
    }

    public function salesHistory()
    {
        // ดึงข้อมูลคำสั่งซื้อพร้อมรายการสินค้า
        $orders = \App\Models\Order::with('items')->orderBy('created_at', 'desc')->paginate(10); // แสดง 10 รายการต่อหน้า

        return view('admin.saleshistory', compact('orders'));
    }

    public function salesDetail($id)
    {
        // ดึงคำสั่งซื้อพร้อมรายการสินค้า
        $order = \App\Models\Order::with('items')->findOrFail($id);

        // ส่งตัวแปร $order ไปยัง View
        return view('admin.salesdetail', compact('order'));
    }

    public function salesDetail2($orderNumber)
    {
        // ค้นหาคำสั่งซื้อด้วย order_number
        $order = Order::with('items')->where('order_number', $orderNumber)->firstOrFail();

        return view('admin.salesdetail', compact('order'));
    }
}
