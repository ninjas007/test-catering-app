<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function saveUser(array $data)
    {
        return $this->create($data);
    }

    public function updateUser($id, array $data)
    {
        $data = $this->handleRequestPassword($data);

        return $this->update($id, $data);
    }

    private function handleRequestPassword(array $data)
    {
        if (isset($data['password']) || empty($data['password'])) {
            if ($data['password'] == '') {
                unset($data['password']);
            } else {
                $data['password'] = Hash::make($data['password2']);
            }
        }

        return $data;
    }
}
