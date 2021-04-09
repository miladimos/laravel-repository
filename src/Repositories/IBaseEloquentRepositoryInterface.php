<?php

namespace Miladimos\Repository\Repositories;

use Illuminate\Database\Eloquent\Model;

interface IBaseEloquentRepositoryInterface
{
    public function all(): object;

    public function create(array $data);

    public function update(Model $entity, array $attributes);

    public function find($id): object;

    public function findOrFail($id);

    public function findAllBy($field, $value, $columns = array('*'));

    public function findWhere(string $field, $condition, $columns);

    public function delete(int $id);

    public function truncate();

    public function count(): int;

    public function paginate($perPage = 1, $columns = array('*'));

    public function search($queries);

    public function pluck($value, $key = null);

    public function simplePaginate($limit = null, $columns = ['*']);

    public function toSql();

    public function setModel(Model $model);

    public function getModel();
}
