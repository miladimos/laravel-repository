<?php


namespace Miladimos\Repository\Repositories;


class BaseRepository implements IBaseRepositoryInterface
{
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function all(): object
    {
        // TODO: Implement all() method.
    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
    }

    public function update(array $data)
    {
        // TODO: Implement update() method.
    }

    public function find($id): object
    {
        // TODO: Implement find() method.
    }

    public function findOrFail($id)
    {
        // TODO: Implement findOrFail() method.
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }
}
