<?php


namespace Miladimos\Repository\Repositories;


interface IBaseRepositoryInterface
{
    public function all() : object ;

    public function create(array $data);

    public function update(array $data);

    public function find($id) : object ;

    public function findOrFail($id);

    public function findWhere(string $field, $condition, $columns);

    public function delete();

    public function count() : int;

}
