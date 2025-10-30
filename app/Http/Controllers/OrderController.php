<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * ✅ ดำเนินการสั่งซื้อ
     */
    public function checkout(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ]);
        
        


        // ✅ ดึงข้อมูลตะกร้าสินค้า
        $cartItems = CartItem::with('menuItem')->get();

        if ($cartItems->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'ไม่มีสินค้าในตะกร้า'
            ], 400);
        }

        try {
            // ✅ เปิด transaction
            // DB::beginTransaction();

            $subtotal = 0;

            foreach ($cartItems as $item) {
                if (!$item->menuItem) continue;
                $subtotal += $item->menuItem->price * $item->quantity;
            }

            // if ($subtotal <= 0) {
            //     DB::rollBack();
            //     return response()->json([
            //         'success' => false,
            //         'message' => 'ไม่พบรายการสินค้าในตะกร้าที่ถูกต้อง'
            //     ], 400);
            // }

            $vat = $subtotal * 0.07;
            $grandTotal = $subtotal + $vat;

            // ✅ สร้างคำสั่งซื้อ
            $order = Order::create([
                'customer_name' => $validated['name'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'subtotal' => $subtotal,
                'vat' => $vat,
                'total' => $grandTotal,
                'status' => 'pending',
            ]);

            // ✅ บันทึกรายการสินค้าใน order_items
            foreach ($cartItems as $item) {
                if (!$item->menuItem) continue;

                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_item_id' => $item->menu_item_id,
                    'quantity' => $item->quantity,
                    'price' => $item->menuItem->price,
                    'total' => $item->menuItem->price * $item->quantity,
                ]);
            }

            // ✅ เคลียร์ตะกร้า
            CartItem::truncate();
            session(['cart_count' => 0]);

            // ✅ ปิด transaction
            // DB::commit();

            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            // ✅ ถ้าเกิดข้อผิดพลาดให้ rollback
            // if (DB::transactionLevel() > 0) {
            //     DB::rollBack();
            // }

            return response()->json([
                'success' => false,
                'message' => 'เกิดข้อผิดพลาด: ' . $e->getMessage(),
            ], 500);
        }
    }
}
