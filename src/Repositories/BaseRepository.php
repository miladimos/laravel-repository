<?php

namespace Miladimos\Repository\Repositories;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Miladimos\Repository\Repositories\IBaseEloquentRepositoryInterface;

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

    // public function create(array $attributes)
    // {
    //     return call_user_func_array("{$this->model}::create", [ $attributes ]);
    // }

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

    public function first()
    {
        return $this->model->first();
    }

    public function last()
    {
        return $this->model->last();
    }

    public function whereIn($attribute, array $values)
    {
        return $this->model->whereIn($attribute, $values)->get();
    }

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

    public function findWhere(string $field, $condition, $columns)
    {
        return $this->model->where($field, $columns, $columns);
    }

    public function count($columns = ['*']): int
    {
        return $this->model->count($columns);
    }

    public function pluck($value, $key = null)
    {
        $lists = $this->model->pluck($value, $key);

        if (is_array($lists)) {
            return $lists;
        }

        return $lists->all();
    }

    public function findAllBy($field, $value, $columns = ['*'])
    {
        return $this->model->toSql();
    }

    public function truncate()
    {
        return $this->model->truncate();
    }

    public function paginate($perPage = 8, $columns = ['*'])
    {
        return $this->model->paginate($perPage, $columns);
    }

    public function simplePaginate($limit = null, $columns = ['*'])
    {
        return $this->model->simplePaginate();
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
