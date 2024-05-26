<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAllWithTrashed()
    {
        return $this->model->withTrashed()->get();
    }

    public function getAllWithPaginate($limit = 20)
    {
        return $this->model->paginate($limit);
    }

    public function all()
    {
        return $this->model->all();
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function update($id, array $attributes)
    {
        $record = $this->find($id);

        if ($record) {
            $record->update($attributes);
            return $record;
        }
        return false;
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function delete($id)
    {
        $record = $this->find($id);
        if ($record) {
            return $record->delete();
        }
        return false;
    }
}
