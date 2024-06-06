<?php

namespace App\Http\Services;

use App\Http\Resources\OrderResource;
use App\Models\Book;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderService
{
    public function index()
    {
        $allOrder = OrderResource::collection(Order::all());
        return $allOrder;
    }

    public function store(Request $request)
    {
        $authUserId = auth()->user()->id;

        $storedOrder = Order::create([
            'client_id' => $authUserId,
            'book_id' => $request->book_id,
            'status' => 'waiting',
            'takDate' => $request->takDate,
            'retDate' => $request->retDate
        ]);

        $book = Book::find($request->book_id);
        $book->status = 1;
        $book->save();

        return  $storedOrder;
    }

    public function update(Request $request, Order $order)
    {
        $updatedOrder = $order->update([
            'status' => $request->status,
            'retDate' => $request->retDate

        ]);

        return $updatedOrder;
    }

    public function destroy(Order $order)
    {
        $order->delete();
    }

    public function ClientOrders()
    {
        $authId = auth()->user()->id;
        $orders = Order::where('client_id', $authId)->get();
        return $orders;
    }
}
