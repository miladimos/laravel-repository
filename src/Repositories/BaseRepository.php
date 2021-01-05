<?php


namespace Miladimos\Repository\Repositories;


use Exception;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements IBaseRepositoryInterface
{
    private $app;

    private $model;

    protected $modelInstance;

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

    final public function setModel($model)
    {
        $this->newInstanseModel = $this->app->make($model);

        if (!$this->newInstanseModel instanceof Model)
            throw new Exception("Class {$this->newInstanseModel} must be an instance of Illuminate\\Database\\Eloquent\\Model");

        return $this->model = $this->newInstanseModel;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function all(): object
    {
        return $this->model->all();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update2(array $data, $id, $attribute = "id")
    {
        return $this->model->where($attribute, '=', $id)->update($data);
    }

    public function find($id): object
    {
        return $this->model->find($id);
    }

    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    public function paginate($perPage = 25, $columns = array('*'))
    {
        return $this->model->paginate($perPage, $columns);
    }

    public function delete($id)
    {
        return $this->model->findOrFail($id)->delete();
    }

    public function findWhere(string $field, $condition, $columns)
    {
        return $this->model->where($field, $columns, $columns);
    }

    public function count($columns = ['*']) : int
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


    public function findAllBy($field, $value, $columns = array('*'))
    {
        return $this->model->toSql();
    }

    public function truncate()
    {
        return $this->model->truncate();
    }

    public function search($query)
    {
        return $this->model->toSql();
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
