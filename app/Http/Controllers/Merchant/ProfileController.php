<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Http\Requests\UserRequest;

class ProfileController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $data['type_menu'] = 'profile';
        $data['user'] = auth()->user();
        $data['merchant'] = auth()->user()->merchant;

        return view('merchant.pages.profile.index', $data);
    }

    public function update(UserRequest $request)
    {
        // save to user by userrepository
        $this->userRepository->updateUser(auth()->user()->id, $request->all());

        // return back with session success
        return redirect()->back()->with('success', 'Successfully saved');
    }

}
