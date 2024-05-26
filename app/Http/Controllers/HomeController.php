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

    public function index()
    {
        $data['menu'] = 'home';
        $data['menus'] = $this->menuRepository->getAll(10);

        return view('customer.pages.home.index', $data);
    }
}
