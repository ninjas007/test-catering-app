<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository extends BaseRepository
{
    public function __construct(Order $order)
    {
        parent::__construct($order);
    }

    public function getAllOrders()
    {
        $orders = Order::with(['orderDetails'])->orderBy('id', 'desc')->withTrashed();

        return $orders;
    }

    public function getOrderById(int $id)
    {
        $order = Order::where('id', $id)->with(['orderDetails'])->first();

        return $order;
    }

    public function complete(int $id)
    {
        $order = $this->getOrderById($id);

        if ($order) {
            $order->status = 'completed';
            $order->save();
        }
    }

    public function getById($id)
    {
        return $this->find($id);
    }
}
