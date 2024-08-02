<?php

namespace App\Http\Controllers;

use App\Models\Fruit;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $fruits = Fruit::all();
        return view('admin.index', compact('fruits'));
    }

    public function orders()
    {
        
        $orders = Order::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.orders', compact('orders'));
    }

    public function stats()
    {
        
        $totalFruits = Fruit::count();
        $totalStock = Fruit::sum('stock');
        $averagePrice = Fruit::avg('price');

        return view('admin.stats', compact('totalFruits', 'totalStock', 'averagePrice'));
    }
    public function showOrder(Order $order)
    {
        return view('admin.order-detail', compact('order'));
    }

    public function deleteOrder(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders')->with('success', 'Đơn hàng đã được xóa thành công.');
    }
}