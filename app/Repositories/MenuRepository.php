<?php

namespace App\Repositories;

use App\Models\Menu;

class MenuRepository extends BaseRepository
{
    public function __construct(Menu $menu)
    {
        parent::__construct($menu);
    }

    public function getAll($limit = 20)
    {
        return $this->getAllWithPaginate($limit);
    }

    public function getById($id)
    {
        return $this->find($id);
    }
}
