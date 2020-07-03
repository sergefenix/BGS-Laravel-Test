<?php

namespace App\Repositories;

use App\Repositories\Contract\RepositoryContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Exception;

/**
 * Class BaseRepository.
 */
abstract class BaseRepository implements RepositoryContract
{

    /**
     * The repository model.
     *
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @throws Exception
     */
    public function __construct()
    {
        $this->makeModel();
    }

    /**
     * @return Model|mixed
     * @throws Exception
     */
    public function makeModel()
    {
        $model = app()->make($this->model());

        if (!$model instanceof Model) {
            throw new \RuntimeException("Class {$this->model()} must be an instance of " . Model::class);
        }

        return $this->model = $model;
    }

    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    abstract public function model();

    /**
     * @return Collection|Model[]
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * @return mixed
     */
    public function first()
    {
        return $this->model->first();
    }

    /**
     * @param int $limit
     *
     * @return mixed
     */
    public function paginate($limit = 10)
    {
        return $this->model->paginate($limit);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function delete($id)
    {
        $model = $this->model->find($id);
        return $model->delete();
    }

    /**
     * @param $param
     * @param $need
     *
     * @return mixed
     */
    public function where($param, $need)
    {
        return $this->model->where($param, $need)->get();
    }

}
