<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Repositories\MerchantRepository;
use Illuminate\Http\Request;

class MerchantController extends Controller
{
    protected $merchantRepository;

    public function __construct(MerchantRepository $merchantRepository)
    {
        $this->merchantRepository = $merchantRepository;
    }

    public function update(Request $request)
    {
        $this->merchantRepository->updateMerchant($request->all());

        return redirect()->back()->with('success', 'Successfully saved');
    }
}
