<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function index()
    {
        $data['menu'] = 'order';
        $data['orders'] = $this->orderRepository->getOrderCustomer(10);
        $data['orderTotal'] = $this->orderRepository->getTotal();

        return view('customer.pages.order.index', $data);
    }

    public function print()
    {
        $orderId = request()->get('order_id');
        $data['order'] = $this->orderRepository->getOrderByCustomerId($orderId);

        if (!$data['order']) {
            return abort(404);
        }

        return view('customer.pages.order.print', $data);
    }
}
