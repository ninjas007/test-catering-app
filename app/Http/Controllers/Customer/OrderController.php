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
        $data['menu'] = 'cart';
        $data['orders'] = $this->orderRepository->getAllWithPaginate(10);

        return view('customer.pages.cart.index', $data);
    }
}
