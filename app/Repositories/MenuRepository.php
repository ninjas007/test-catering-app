<?php

namespace App\Repositories;

use App\Models\Menu;
use App\Models\Merchant;

class MenuRepository extends BaseRepository
{
    public function __construct(Menu $menu)
    {
        parent::__construct($menu);
    }

    public function search(string $search, int $limit = 10)
    {
        $merchantIds = Merchant::where('name', 'like', '%' . $search . '%')
                            ->pluck('id')
                            ->toArray();

        return $this->model
            ->with('merchant')
            ->where('name', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->orWhereIn('merchant_id', $merchantIds)
            ->paginate($limit);
    }

    public function searchMenu(string $search, int $limit = 10)
    {
        return $this->model
            ->with('merchant')
            ->where('merchant_id', auth()->user()->merchant->id)
            ->where('name', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->paginate($limit);
    }

    public function getAll($limit = 10)
    {
        $user = auth()->user();
        if ($user->role == 'merchant') {
            return $this->model->where('merchant_id', $user->merchant->id)->paginate($limit);
        }

        return $this->model->with('merchant')->paginate($limit);
    }

    public function getById($id)
    {
        return $this->find($id);
    }
}
