<?php

namespace App\Repositories;

use App\Models\Cart;

class CartRepository extends BaseRepository
{
    public function __construct(Cart $cart)
    {
        parent::__construct($cart);
    }

    public function getTotalCart()
    {
        $userId = auth()->id(); // Lebih singkat daripada auth()->user()->id
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
}
