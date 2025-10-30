<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;
use App\Models\CartItem;
use App\Models\Inventory;

class CartController extends Controller
{
    // 🛒 แสดงตะกร้าสินค้า
    public function index()
    {
        $cartItems = CartItem::with('menuItem')->get();
        $total = $cartItems->sum(fn($i) => $i->menuItem->price * $i->quantity);

        return view('cart.index', compact('cartItems', 'total'));
    }

    // ✅ เพิ่มสินค้าเข้าตะกร้า (ใช้ AJAX)
    public function add(Request $request)
    {
        $id = $request->menu_item_id;
        $item = MenuItem::find($id);
        $stock = Inventory::where('menu_item_id', $id)->first();

        if (!$item) {
            return response()->json(['success' => false, 'message' => '❌ ไม่พบสินค้า']);
        }

        if (!$stock || $stock->quantity <= 0) {
            return response()->json(['success' => false, 'message' => '❌ สินค้าหมดสต็อก']);
        }

        $cart = CartItem::firstOrNew(['menu_item_id' => $id]);
        $cart->quantity = $cart->exists ? $cart->quantity + 1 : 1;
        $cart->save();

        // ลดจำนวนสต็อก
        $stock->decrement('quantity');

        // อัปเดต session ให้ badge ตะกร้า
        $cartCount = CartItem::sum('quantity');
        session(['cart_count' => $cartCount]);

        return response()->json([
            'success' => true,
            'cart_count' => $cartCount,
            'message' => '✅ เพิ่มสินค้าลงตะกร้าแล้ว'
        ]);
    }

    // ✅ เพิ่ม / ลด จำนวนสินค้าในตะกร้า
    public function updateQuantity(Request $request, $id)
    {
        $item = CartItem::find($id);
        if (!$item) {
            return response()->json(['success' => false]);
        }

        $inventory = Inventory::where('menu_item_id', $item->menu_item_id)->first();

        if ($request->action === 'increase') {
            // เช็คว่ายังมีของใน stock มั้ย
            if ($inventory && $inventory->quantity > 0) {
                $item->quantity++;
                $item->save();
                $inventory->decrement('quantity');
            } else {
                return response()->json(['success' => false, 'message' => '❌ สินค้าหมดสต็อก']);
            }
        }

        if ($request->action === 'decrease' && $item->quantity > 1) {
            $item->quantity--;
            $item->save();
            $inventory->increment('quantity');
        }

        // อัปเดตจำนวนรวมใน session
        session(['cart_count' => CartItem::sum('quantity')]);

        return response()->json(['success' => true]);
    }

    public function remove($id)
    {
        $cartItem = CartItem::find($id);
        if (!$cartItem) {
            return response()->json(['success' => false]);
        }

        $inventory = Inventory::where('menu_item_id', $cartItem->menu_item_id)->first();
        if ($inventory) {
            $inventory->increment('quantity', $cartItem->quantity);
        }

        $cartItem->delete();
        session(['cart_count' => CartItem::sum('quantity')]);

        return response()->json(['success' => true]);
    }

}
