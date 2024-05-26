<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\User;

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
                ->withTrashed()
                ->paginate($limit);

        return $orders;
    }

    public function getAllOrders(string $search = null, int $limit = 10)
    {
        $orders = Order::with(['orderDetails'])
                    ->orderBy('id', 'desc')
                    ->withTrashed();

        if ($search) {
            $userIds = User::where('name', 'like', '%'.$search.'%')
                        ->pluck('id')
                        ->toArray();

            $orders->where('user_id', $userIds)
                ->orWhere('status', 'like', '%'.$search.'%');
        }

        return $orders->paginate($limit);
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
        $user =  $this->model
                ->with(['orderDetails'])
                ->where('id', $orderId)
                ->withTrashed();

        if (auth()->user()->role == 'merchant') {
            return $user->first();
        }

        return $user->where('user_id', auth()->user()->id)->first();
    }
}
