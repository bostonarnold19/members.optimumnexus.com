<?php

namespace Modules\Core\Repositories;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Interfaces\EloquentRepositoryInterface;

abstract class AbstractEloquentRepository implements EloquentRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    public function where($field, $value)
    {
        return $this->model->where($field, $value);
    }

    public function save(array $data)
    {
        $this->model->fill($data)->save();
        return $this->model;
    }

    public function create(array $data)
    {
        $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $this->model->findOrFail($id)->update($data);
        return $this->model->findOrFail($id);
    }

    public function delete($id)
    {
        return $this->model->findOrFail($id)->delete();
    }

    public function attach($model_id, $relation, $relation_id)
    {
        return $this->model->findOrFail($model_id)->{$relation}()->attach($relation_id);
    }

    public function detach($model_id, $relation, $relation_id)
    {
        return $this->model->findOrFail($model_id)->{$relation}()->detach($relation_id);
    }
}
