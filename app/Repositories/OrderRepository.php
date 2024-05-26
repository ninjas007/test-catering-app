<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository extends BaseRepository
{
    public function __construct(Order $order)
    {
        parent::__construct($order);
    }

    public function getTotal()
    {
        return $this->model->sum('total');
    }

    public function getOrderCustomer($limit = 10)
    {
        $orders = Order::with(['orderDetails'])
                ->orderBy('id', 'desc')
                ->where('user_id', auth()->user()->id)
                ->paginate($limit);

        return $orders;
    }

    public function getAllOrders()
    {
        $orders = Order::with(['orderDetails'])->orderBy('id', 'desc')->withTrashed();

        return $orders;
    }

    public function getOrderById(int $id)
    {
        $order = Order::where('id', $id)
                ->with(['orderDetails'])
                ->first();

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

    public function getOrderByCustomerId(int $orderId)
    {
        return $this->model
                ->with(['orderDetails'])
                ->where('id', $orderId)
                ->where('user_id', auth()->user()->id)
                ->first();
    }
}
