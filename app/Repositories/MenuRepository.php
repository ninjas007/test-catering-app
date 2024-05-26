<?php

namespace App\Repositories;

use App\Models\Menu;

class MenuRepository extends BaseRepository
{
    public function __construct(Menu $menu)
    {
        parent::__construct($menu);
    }

    public function getAll()
    {
        return $this->getAllWithPaginate();
    }

    public function getById($id)
    {
        return $this->find($id);
    }
}
