<?php

namespace App\Repositories\Contract;

/**
 * Interface RepositoryContract.
 */
interface RepositoryContract
{
    public function all();

    public function delete($id);

    public function first();

    public function create(array $data);

    public function paginate($limit = 10);

    public function where($param, $data);
}
