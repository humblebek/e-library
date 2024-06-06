<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientOrdersResource;
use App\Http\Resources\OrderResource;
use App\Http\Services\OrderService;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
        $dataIndex = $this->orderService->index();
        return $dataIndex;
    }


    public function store(Request $request)
    {
        $dataStore = $this->orderService->store($request);
        return response()->json(['message' => 'Order created successfully', 'Order' => $dataStore], 201);
    }

    public function show(Order $order)
    {
        return new OrderResource($order);
    }

    public function update(Request $request, Order $order)
    {
        $dataUpdate = $this->orderService->update($request, $order);
        return response()->json(['message' => 'Order updated successfully', 'Order' => $dataUpdate], 201);
    }
    public function destroy(Order $order)
    {
        $this->orderService->destroy($order);
        return response()->json(['message' => 'Order deleted successfully'], 201);
    }

    public function ClientOrders()
    {
        $dataClientOrder = $this->orderService->ClientOrders();
        return ClientOrdersResource::collection($dataClientOrder);
    }
}
