<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create()
    {
        $sessionId = session()->getId();
        $cartItems = Cart::where('session_id', $sessionId)->with('fruit')->get();
        $total = $cartItems->sum(function($item) {
            return $item->quantity * $item->fruit->price;
        });

        return view('orders.create', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $sessionId = session()->getId();
        $cartItems = Cart::where('session_id', $sessionId)->with('fruit')->get();
        $total = $cartItems->sum(function($item) {
            return $item->quantity * $item->fruit->price;
        });

        $order = Order::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'total' => $total,
        ]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'fruit_id' => $item->fruit_id,
                'quantity' => $item->quantity,
                'price' => $item->fruit->price,
            ]);
        }

        Cart::where('session_id', $sessionId)->delete();

        return redirect()->route('fruits.index')->with('success', 'Đơn hàng của bạn đã được đặt thành công!');
    }
    public function index()
{
    $orders = Order::orderBy('created_at', 'desc')->paginate(10);
    return view('orders.index', compact('orders'));
}

public function show(Order $order)
{
    return view('orders.show', compact('order'));
}
}