<?php

namespace App\Http\Controllers;

use App\Models\CashDrawer;
use App\Models\CashMovement;
use Illuminate\Http\Request;

class CashDrawerController extends Controller
{
    public function index()
    {
        $cashDrawer = CashDrawer::firstOrCreate(['id' => 1], ['current_balance' => '0.00']);

        // ใช้ paginate สำหรับ movements
        $movements = $cashDrawer->movements()->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.cashdrawer', compact('cashDrawer', 'movements'));
    }


    public function addFunds(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'note' => 'nullable|string|max:255',
        ]);

        $cashDrawer = CashDrawer::find(1);
        $cashDrawer->adjustBalance($request->amount, 'add', $request->note);

        return redirect()->route('cashdrawer.index')->with('success', 'เพิ่มเงินสำเร็จ');
    }

    public function subtractFunds(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'note' => 'nullable|string|max:255',
        ]);

        $cashDrawer = CashDrawer::find(1);

        if ($cashDrawer->current_balance < $request->amount) {
            return redirect()->route('cashdrawer.index')->with('error', 'ยอดเงินไม่เพียงพอ');
        }

        $cashDrawer->adjustBalance($request->amount, 'subtract', $request->note);

        return redirect()->route('cashdrawer.index')->with('success', 'ถอนเงินสำเร็จ');
    }
}
