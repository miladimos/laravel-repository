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

    abstract public function model();

    final public function makeModel()
    {
        return $this->setModel($this->model());
    }

    /**
     * @param $column
     * @return mixed
     */
    final public function setModel(Model $model)
    {
        $this->newInstanseModel = $this->app->make($model);

        if (!$this->newInstanseModel instanceof Model)
            throw new Exception("Class {$this->newInstanseModel} must be an instance of Illuminate\\Database\\Eloquent\\Model");

        return $this->model = $this->newInstanseModel;
    }

    /**
     * return current model
     *
     * @return Model
     */
    public function getModel(): Model
    {
        return $this->model;
    }

    /**
     * @param $column
     * @return mixed
     */
    public function all($columns = ['*']): object
    {
        return $this->model->all($columns);
    }

    /**
     * @param $column
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * @param $column
     * @return mixed
     */
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

    /**
     * @param $column
     * @return mixed
     */
    public function find($id): object
    {
        return $this->model->find($id);
    }

    /**
     * @param $column
     * @return mixed
     */
    public function findOrFail($id): ?object
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param $column
     * @return mixed
     */
    public function findWhere(string $field, $condition, $columns)
    {
        return $this->model->where($field, $condition, $columns);
    }

    /**
     * @param $column
     * @return mixed
     */
    public function first(): object
    {
        return $this->model->first();
    }

    /**
     * @param $column
     * @return mixed
     */
    public function last(): object
    {
        return $this->model->latest()->first();
    }

    /**
     * @param $column
     * @return mixed
     */
    public function firstOrCreate($attributes, $values)
    {
        //
    }

    /**
     * @param $column
     * @return mixed
     */
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

    /**
     * @param $column
     * @return mixed
     */
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

    /**
     * @param $column
     * @return mixed
     */
    public function truncate()
    {
        return $this->model->truncate();
    }

    /**
     * @param $column
     * @return mixed
     */
    public function count($columns = ['*']): int
    {
        return $this->model->count($columns);
    }

    /**
     * @param $column
     * @return mixed
     */
    public function paginate($perPage = 8, $columns = ['*'])
    {
        return $this->model->paginate($perPage, $columns);
    }

    /**
     * @param $column
     * @return mixed
     */
    public function simplePaginate($limit = null, $columns = ['*'])
    {
        return $this->model->simplePaginate($limit, $columns);
    }

    /**
     * @param $column
     * @return mixed
     */
    public function search($query, $columns = ["*"])
    {
        //
    }

    /**
     * @param $value
     * @param $key
     * @return mixed
     */
    public function pluck($value, $key = null)
    {
        $lists = $this->model->pluck($value, $key);

        if (is_array($lists)) {
            return $lists;
        }

        return $lists->all();
    }

    /**
     * @param $column
     * @return mixed
     */
    public function toSql()
    {
        return $this->model->toSql();
    }

    /**
     * Eager load database relationships
     * @param $column
     * @return mixed
     */
    public function with($relations)
    {
        return $this->model->with($relations);
    }
}
