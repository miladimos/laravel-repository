<?php


namespace Miladimos\Repository\Repositories;


use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements IBaseRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        if ($model instanceof Model)
            $this->model = $model;
    }

    abstract function model();

    public function all(): object
    {
        return $this->model->all();
    }

    public function create(array $data)
    {
        return $this->create($data);
    }

    public function update(array $data, $id)
    {
        $record = $this->find($id);
        return $record->update($data);

//        $result = $this->find($id);
//        if($result) {
//            $result->update($attributes);
//            return $result;
//        }
//        return false;
    }

    public function find($id): object
    {
        return $this->find($id);
    }


    public function findOrFail($id)
    {
        return $this->findOrFail($id);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->delete($id);
    }

    public function findWhere(string $field, $condition, $columns)
    {
        return $this->model->where($field, $columns, $columns);
    }

    /**
     * Count the number of specified model records in the database.
     *
     * @return int
     */
    public function count() : int
    {
        return $this->model->get()->count();
    }

    // Eager load database relationships
    public function with($relations)
    {
        return $this->model->with($relations);
    }

    // Get the associated model
    public function getModel()
    {
        return $this->model;
    }

    // Set the associated model
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }
}
