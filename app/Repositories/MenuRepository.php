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
        $merchantIds = Merchant::where('name', 'like', '%' . $search . '%')->pluck('id')->toArray();

        // get menu
        $menus = $this->model
            ->with('merchant')
            ->where('name', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->orWhereIn('merchant_id', $merchantIds)
            ->paginate($limit);


        return $menus;
    }

    public function getAll($limit = 20)
    {
        return $this->model->with('merchant')->paginate($limit);
    }

    public function getById($id)
    {
        return $this->find($id);
    }
}
