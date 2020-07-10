<?php


namespace App\Repositories\Slider;


use App\Models\Slider;
use Illuminate\Support\Arr;

class SliderRepository implements SliderInterface
{
    public function __construct(Slider $slider)
    {
        $this->model = $slider;
    }

    public function getAll()
    {
        // TODO: Implement getAll() method.
        return $this->model->all();
    }

    public function getByID($id)
    {
        // TODO: Implement getByID() method.
        return $this->model->findOrFail($id);
    }

    public function create(array $attributes)
    {
        // TODO: Implement create() method.
        $image_name = time(). $attributes['image']->getClientOriginalName();
        $attributes['image']->move(storage_path('app/public/uploads/slider/'),$image_name);
        $attributes['img'] = $image_name;
        return $this->model->create(Arr::except($attributes,['image']));
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