<?php


namespace Miladimos\Repository\Repositories;


class BaseRepository implements IBaseRepositoryInterface
{
    protected $model;

    public function __construct($model)
    {
        return $this->model = $model;
    }

    public function all(): object
    {
        return $this->model->all();
    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
    }

    public function update(array $data)
    {
        return $this->model->update($data);
    }

    public function find($id): object
    {
        return $this->find($id);
    }

    public function findOrFail($id)
    {
        // TODO: Implement findOrFail() method.
    }

    public function delete()
    {
        return $this->model->delete();
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
}
