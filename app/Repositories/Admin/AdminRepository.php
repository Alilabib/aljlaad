<?php


namespace App\Repositories\Admin;


use App\Models\Admin;

class AdminRepository implements AdminInterface
{
    public function __construct(Admin $admin)
    {
        $this->model = $admin;
    }

    public function getAll()
    {
        // TODO: Implement getAll() method.
        return $this->model->orderBy('id', 'DESC')->get();
    }

    public function getByID($id)
    {
        // TODO: Implement getByID() method.
        return $this->model->findOrFail($id);
    }

    public function create(array $attributes)
    {
        // TODO: Implement create() method.
        return $this->model->create($attributes);
    }

    public function update($id, array $attributes)
    {
        // TODO: Implement update() method.
        $module = $this->model->findOrFail($id);
        $module->update($attributes);
        $module->save();
        return $module;
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
        $module = $this->getByID($id);
        return $module->delete();
    }
}