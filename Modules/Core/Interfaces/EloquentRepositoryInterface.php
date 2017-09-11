<?php

namespace Modules\Core\Interfaces;

interface EloquentRepositoryInterface
{
    public function all();

    public function find($id);

    public function findOrFail($id);

    public function where($column_name, $value);

    public function save(array $data);

    public function update($id, array $data);

    public function delete($id);

    public function attach($model_id, $relation, $relation_id);

    public function detach($model_id, $relation, $relation_id);
}
