<?php

namespace App\Repositories;

use App\Models\Merchant;

class MerchantRepository extends BaseRepository
{
    public function __construct(Merchant $merchant)
    {
        parent::__construct($merchant);
    }

    public function getMerchant()
    {
        return auth()->user()->merchant;
    }

    public function createMerchant(array $data)
    {
        return $this->create($data);
    }

    public function updateMerchant(array $data)
    {
        $id = auth()->user()->merchant->id;

        return $this->update($id, $data);
    }
}
