<?php

namespace Miladimos\Repository\Repositories;

use Illuminate\Database\Eloquent\Model;

interface IBaseEloquentRepositoryInterface
{

    public function setModel(Model $model);

    public function getModel(): Model;

    public function all($columns = ['*']): object;

    public function create(array $data);

    public function update(array $data, $id, $attribute = "id");

    public function find($id): object;

    public function findOrFail($id): ?object;

    public function findWhere(string $field, $condition, $columns);

    public function first(): object;

    public function last(): object;

    public function next($id): object;

    public function before($id): object;

    public function firstOrCreate(array $attributes, array $values);

    public function whereIn($attribute, array $values);

    public function max($column);

    public function min($column);

    public function avg($column);

    public function delete(int $id);

    public function truncate();

    public function count(): int;

    public function paginate($columns = ['*'], $perPage = 8);

    public function simplePaginate($limit = null, $columns = ['*']);

    public function search(array $query, $columns = ["*"]);

    public function pluck($value, $key = null);

    public function with($relations);

    public function toSql();
}
