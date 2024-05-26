<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\CartRepository;

class CustomerController extends Controller
{
    protected $cartRepository;

    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function cartTotal()
    {
        return $this->cartRepository->getTotalCart();
    }

    public function cart(Request $request)
    {
        try {
            $this->cartRepository->saveCart($request->all());

            return response()->json([
                'status' => 'success',
                'msg' => 'Added cart successfully',
                'total_cart' => $this->cartRepository->getTotalCart()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'msg' => $e->getMessage()
            ]);
        }

    }
}
