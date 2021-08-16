<?php

namespace Miladimos\Repository\Repositories;

use Illuminate\Database\Eloquent\Model;

interface IBaseEloquentRepositoryInterface
{
    public function setModel(Model $model);

    public function getModel();

    public function all($columns = ['*']): object;

    public function create(array $data);

    public function update(array $data, $id, $attribute = "id");

    public function find($id): object;

    public function findOrFail($id): ?object;

    public function findWhere(string $field, $condition, $columns);

    public function first(): object;

    public function last(): object;

    public function firstOrCreate(array $attributes, array $values);

    public function whereIn($attribute, array $values);

    public function max($column);

    public function min($column);

    public function delete(int $id);

    public function truncate();

    public function count(): int;

    public function paginate($perPage = 8, $columns = ['*']);

    public function simplePaginate($limit = null, $columns = ['*']);

    public function search($query, $columns = ["*"]);

    public function pluck($value, $key = null);

    public function toSql();

    public function with($relations);
}
