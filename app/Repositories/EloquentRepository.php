<?php

namespace App\Repositories;

abstract class EloquentRepository
{
    protected $model;

    public function __construct()
    {
        $this->setModel();
    }

    public abstract function getModel();

    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, $data)
    {
        $record = $this->model->find($id);
        return $record->update($data);
    }

    public function delete($id)
    {
        $record = $this->model->find($id);
        return $record->delete();
    }
}
