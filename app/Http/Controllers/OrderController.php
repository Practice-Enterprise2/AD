<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())->get();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        return view('orders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'item' => 'required',
            'quantity' => 'required',
            'purchase_date' => 'required',
            'price' => 'required',
        ]);

        $OrderID = Order::max('order_id') + 1;
        $UserID = auth()->id();
        $CustomerName = auth()->user()->name;
        $request->merge(['order_id' => $OrderID, 'user_id' => $UserID, 'customer_name' => $CustomerName]);

        Order::create($request->all());

        return redirect()->route('orders.index')
            ->with('success', 'Order created successfully.');
    }

    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        return view('orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'item' => 'required',
            'quantity' => 'required',
            'purchase_date' => 'required',
            'price' => 'required',
        ]);
        $order->update($request->all());

        return redirect()->route('orders.index')
            ->with('success', 'Order updated successfully');
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index')
            ->with('success', 'Order deleted successfully');
    }

}
