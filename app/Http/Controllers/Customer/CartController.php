<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\CartRepository;

class CartController extends Controller
{
    protected $cartRepository;

    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function index()
    {
        $data['menu'] = 'cart';
        $data['carts'] = $this->cartRepository->getAllWithPaginate(10);
        $data['cartTotal'] = $this->cartRepository->getTotalCart();

        return view('customer.pages.cart.index', $data);
    }

    public function cartTotal()
    {
        return $this->cartRepository->getCountCart();
    }

    public function cart(Request $request)
    {
        try {
            $this->cartRepository->saveCart($request->all());

            return response()->json([
                'status' => 'success',
                'msg' => 'Added cart successfully',
                'total_cart' => $this->cartRepository->getCountCart()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'msg' => $e->getMessage()
            ]);
        }

    }

    public function addQtyCart(Request $request)
    {
        try {
            $this->cartRepository->addQtyCart($request->cart_id);

            return response()->json([
                'status' => 'success',
                'msg' => 'Added qtys successfully',
                'total_cart' => $this->cartRepository->getCountCart()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'msg' => $e->getMessage()
            ]);
        }
    }

    public function removeCart(Request $request)
    {
        try {
            $this->cartRepository->delete($request->cart_id);

            return response()->json([
                'status' => 'success',
                'msg' => 'Removed cart successfully',
                'total_cart' => $this->cartRepository->getCountCart()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'msg' => $e->getMessage()
            ]);
        }
    }

    public function checkout()
    {
        if ($this->cartRepository->checkout()) {
            return redirect('order')->with('success', 'Checkout successfully');
        }

        return redirect()->back()->with('error', 'Checkout failed');
    }
}
