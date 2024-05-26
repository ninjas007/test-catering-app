<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HelperController;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderRepository;
    private $typeMenu;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->typeMenu = 'order';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['orders'] = $this->orderRepository->getAllOrders()->paginate(20);
        $data['type_menu'] = $this->typeMenu;

        return view('merchant.pages.order.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['type_menu'] = $this->typeMenu;

        return view('merchant.pages.order.add', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['type_menu'] = $this->typeMenu;
        $data['order'] = $this->orderRepository->getOrderById($id);

        return view('merchant.pages.order.show', $data);
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

        $this->orderRepository->create($request->all());

        return redirect()->route('order.index')->with('success', 'Added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort(404);
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

        $this->orderRepository->update($id, $request->all());

        return redirect()->route('order.index')->with('success', 'Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->orderRepository->delete($id);

        return redirect()->back()->with('success', 'Deleted successfully');
    }

    public function complete($id)
    {
        $this->orderRepository->complete($id);

        return redirect()->back()->with('success', 'Updated successfully');
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
        if ($request->hasFile('order_image')) {
            app(HelperController::class)->storeImage($request, 'order_image', 'order');
        }
    }
}
