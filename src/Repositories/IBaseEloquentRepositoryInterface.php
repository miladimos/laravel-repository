<?php

namespace Miladimos\Repository\Repositories;

use Illuminate\Database\Eloquent\Model;

interface IBaseEloquentRepositoryInterface
{
    public function all($columns = ['*']): object;

    public function create(array $data);

    public function update(array $data, $id, $attribute = "id");

    public function find($id): object;

    public function findOrFail($id);

    public function findAllBy($field, $value, $columns = ['*']);

    public function findWhere(string $field, $condition, $columns);

    public function first();

    public function last();

    public function firstBy($attribute, $value = null);

    public function firstByOrFail($attribute, $value = null);

    public function firstOrCreate(array $attributes, array $values);

    public function whereIn($attribute, array $values);

    public function max($column);

    public function min($column);

    public function delete(int $id);

    public function truncate();

    public function count(): int;

    public function paginate($perPage = 8, $columns = ['*']);

    public function search($queries);

    public function pluck($value, $key = null);

    public function simplePaginate($limit = null, $columns = ['*']);

    public function toSql();

    public function setModel(Model $model);

    public function getModel();
}
