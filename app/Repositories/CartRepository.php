<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class CartRepository extends BaseRepository
{
    public function __construct(Cart $cart)
    {
        parent::__construct($cart);
    }

    public function getCarts()
    {
        $userId = auth()->user()->id;

        return $this->model->where('user_id', $userId)->get();
    }

    public function getTotalCart()
    {
        $userId = auth()->id();
        $total = $this->model->where('user_id', $userId)->with('menu')->get()
                        ->sum(function($cart) {
                            return $cart->menu->price * $cart->qty;
                        });

        return $total;
    }

    public function getCountCart()
    {
        $userId = auth()->user()->id;

        return $this->model->where('user_id', $userId)->count();
    }

    public function addQtyCart(int $id)
    {
        $data['qty'] = $this->model->find($id)->qty + 1;

        return $this->update($id, $data);
    }

    public function saveCart(array $data)
    {
        $userId = auth()->user()->id;
        $cart = $this->model
                    ->where('menu_id', $data['menu_id'])
                    ->where('user_id', $userId)
                    ->first();

        // update keranjang user jika menu sudah ada dikeranjang
        if ($cart) {
            $data['quantity'] = $cart->quantity + 1;
            return $this->update($cart->id, $data);
        } else {
            $data['user_id'] = $userId;
            return $this->create($data);
        }
    }

    public function checkout(array $data)
    {
        try {
            DB::beginTransaction();
            $userId = auth()->user()->id;
            $order = Order::create([
                'user_id' => $userId,
                'status' => 'pending',
                'delivery_date' => $data['delivery_date'],
                'delivery_time' => $data['delivery_time'],
                'total' => $this->getTotalCart(),
            ]);

            $orderDetail = [];
            foreach ($this->getCarts() as $cart) {
                $orderDetail[] = [
                    'menu_id' => $cart->menu_id,
                    'quantity' => $cart->qty,
                    'order_id' => $order->id,
                    'subtotal' => $cart->menu->price * $cart->qty,
                    'created_at' => now()
                ];
            }

            DB::table('order_details')->insert($orderDetail);

            // remove carts
            $this->model->where('user_id', $userId)->delete();

            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();

            return false;
        }
    }
}
