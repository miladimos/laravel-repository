<?php

namespace Miladimos\Repository\Repositories;

use Illuminate\Database\Eloquent\Model;
use Miladimos\Repository\Repositories\IBaseEloquentRepositoryInterface;
use Exception;

abstract class BaseRepository implements IBaseEloquentRepositoryInterface
{
    private $app;

    private $model;

    protected $newInstanseModel;

    public function __construct()
    {
        $this->app = app();
        $this->makeModel();
    }

    // public function __construct(Model $model)
    // {
    //     $this->model = $model;
    // }

    abstract public function model();

    final public function makeModel()
    {
        return $this->setModel($this->model());
    }

    final public function setModel($model)
    {
        $this->newInstanseModel = $this->app->make($model);

        if (!$this->newInstanseModel instanceof Model)
            throw new Exception("Class {$this->newInstanseModel} must be an instance of Illuminate\\Database\\Eloquent\\Model");

        return $this->model = $this->newInstanseModel;
    }

    /**
     * return current modle
     *
     * @return Model
     */
    public function getModel()
    {
        return $this->model;
    }

    public function all($columns = ['*']): object
    {
        return $this->model->all($columns);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id, $attribute = "id")
    {
        $keys = ['_token', '_method', 'XDEBUG_SESSION_START'];
        foreach ($keys as $key) {
            if (array_key_exists($key, $data)) {
                unset($data[$key]);
            }
        }
        $updated = $this->model
            ->where($attribute, '=', $id)
            ->update($data);

        if (!$updated) {
            throw new Exception(
                "Update model {$this->model()} was unsuccessful"
            );
        }

        return $updated;
    }

    public function find($id): object
    {
        return $this->model->find($id);
    }

    public function findOrFail($id): ?object
    {
        return $this->model->findOrFail($id);
    }

    public function findWhere(string $field, $condition, $columns)
    {
        return $this->model->where($field, $condition, $columns);
    }

    public function first(): object
    {
        return $this->model->first();
    }

    public function last(): object
    {
        return $this->model->latest()->first();
    }

    public function firstOrCreate($attributes, $values)
    {
        //
    }

    public function whereIn($attribute, array $values)
    {
        return $this->model->whereIn($attribute, $values)->get();
    }

    /**
     * @param $column
     * @return mixed
     */
    public function max($column)
    {
        return $this->modelQuery->max($column);
    }

    /**
     * @param $column
     * @return mixed
     */
    public function min($column)
    {
        return $this->modelQuery->min($column);
    }

    public function delete($id)
    {
        $status = $this->model->destroy($id);
        if (!$status and !is_array($id) and !empty($id)) {
            throw new Exception(
                "Unable to delete {$this->model()} with id: {$id}"
            );
        }
        return $status;
    }

    public function truncate()
    {
        return $this->model->truncate();
    }

    public function count($columns = ['*']): int
    {
        return $this->model->count($columns);
    }

    public function paginate($perPage = 8, $columns = ['*'])
    {
        return $this->model->paginate($perPage, $columns);
    }

    public function simplePaginate($limit = null, $columns = ['*'])
    {
        return $this->model->simplePaginate($limit, $columns);
    }

    public function search($query, $columns = ["*"])
    {
        //
    }

    public function pluck($value, $key = null)
    {
        $lists = $this->model->pluck($value, $key);

        if (is_array($lists)) {
            return $lists;
        }

        return $lists->all();
    }

    public function toSql()
    {
        return $this->model->toSql();
    }

    // Eager load database relationships
    public function with($relations)
    {
        return $this->model->with($relations);
    }
}
