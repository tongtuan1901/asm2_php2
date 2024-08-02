<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Fruit;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $sessionId = session()->getId();
        $cartItems = Cart::where('session_id', $sessionId)->with('fruit')->get();
        $total = $cartItems->sum(function($item) {
            return $item->quantity * $item->fruit->price;
        });

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request, Fruit $fruit)
    {
        $sessionId = session()->getId();
        $quantity = $request->input('quantity', 1);

        $cartItem = Cart::where('session_id', $sessionId)
            ->where('fruit_id', $fruit->id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            Cart::create([
                'session_id' => $sessionId,
                'fruit_id' => $fruit->id,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
    }

    public function update(Request $request, Fruit $fruit)
    {
        $sessionId = session()->getId();
        $quantity = $request->input('quantity');

        $cartItem = Cart::where('session_id', $sessionId)
            ->where('fruit_id', $fruit->id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity = $quantity;
            $cartItem->save();
        }

        return redirect()->route('cart.index')->with('success', 'Giỏ hàng đã được cập nhật.');
    }

    public function remove(Fruit $fruit)
    {
        $sessionId = session()->getId();

        Cart::where('session_id', $sessionId)
            ->where('fruit_id', $fruit->id)
            ->delete();

        return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng.');
    }
}