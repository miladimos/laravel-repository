<?php


namespace Miladimos\Repository\Repositories;


use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements IBaseRepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->makeModel();
    }

    public abstract function model();


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

    public function update2(array $data, $id, $attribute = "id")
    {
        return $this->model->where($attribute, '=', $id)->update($data);
    }

    public function find($id): object
    {
        return $this->find($id);
    }


    public function findOrFail($id)
    {
        return $this->findOrFail($id);
    }

    public function paginate($perPage = 25, $columns = array('*'))
    {
        return $this->model->paginate($perPage, $columns);
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

        /**
     * @return \Illuminate\Database\Eloquent\Builder
     * @throws RepositoryException
     */
    public function makeModel()
    {
        return $this->setModel($this->model());
    }

    /**
     * Set Eloquent Model to instantiate
     *
     * @param $eloquentModel
     * @return Model
     * @throws RepositoryException
     */
    public function setModel($eloquentModel)
    {
        $this->newModel = $this->app->make($eloquentModel);

        if (!$this->newModel instanceof Model)
            throw new RepositoryException("Class {$this->newModel} must be an instance of Illuminate\\Database\\Eloquent\\Model");

        return $this->model = $this->newModel;
    }

    // Get the associated model
    public function getModel()
    {
        return $this->model;
    }

}
