<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HelperController;
use App\Repositories\MenuRepository;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    protected $menuRepository;
    private $typeMenu;

    public function __construct(MenuRepository $menuRepository)
    {
        $this->menuRepository = $menuRepository;
        $this->typeMenu = 'menu';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['menus'] = $this->menuRepository->getAll();
        $data['type_menu'] = $this->typeMenu;

        return view('merchant.pages.menu.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['type_menu'] = $this->typeMenu;

        return view('merchant.pages.menu.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateRequest($request);

        $this->handleUploadFile($request);

        $this->menuRepository->create($request->all());

        return redirect()->route('menu.index')->with('success', 'Added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['type_menu'] = $this->typeMenu;
        $data['menu'] = $this->menuRepository->getById($id);

        return view('merchant.pages.menu.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validateRequest($request);

        $this->handleUploadFile($request);

        $this->menuRepository->update($id, $request->all());

        return redirect()->route('menu.index')->with('success', 'Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->menuRepository->delete($id);

        return redirect()->back()->with('success', 'Deleted successfully');
    }

    private function validateRequest(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric|min:0',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    }

    private function handleUploadFile(Request $request) : void
    {
        if ($request->hasFile('menu_image')) {
            app(HelperController::class)->storeImage($request, 'menu_image', 'menu');
        }
    }
}
