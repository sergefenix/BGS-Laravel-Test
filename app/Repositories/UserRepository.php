<?php

namespace App\Repositories;

use App\User;

class UserRepository extends BaseRepository
{

    /**
     * @return mixed
     */
    public function model()
    {
        return User::class;
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function create(array $data)
    {
    }
}
