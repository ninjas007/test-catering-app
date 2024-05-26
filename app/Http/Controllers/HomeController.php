<?php

namespace App\Http\Controllers;

use App\Repositories\MenuRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $menuRepository;
    public function __construct(MenuRepository $menuRepository)
    {
        $this->menuRepository = $menuRepository;
    }

    public function index(Request $request)
    {
        $data['menu'] = 'home';

        if ($request->search !== null) {
            $data['menus'] = $this->menuRepository->search($request->search);
        } else {
            $data['menus'] = $this->menuRepository->getAll(10);
        }

        return view('customer.pages.home.index', $data);
    }
}
