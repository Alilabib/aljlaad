<?php


namespace App\Repositories\Offer;


use App\Models\Offer;
use Illuminate\Support\Arr;

class OfferRepository implements OfferInterface
{
    public function __construct(Offer $offer)
    {
        $this->model = $offer;
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
        if (Arr::exists($attributes,'image')) {
            $image_name = time(). $attributes['image']->getClientOriginalName();
            $attributes['image']->move(storage_path('app/public/uploads/offer/'),$image_name);
            $attributes['img'] = $image_name;    
        }
        if(Arr::exists($attributes,'back_image')){
            $image_name2 = time(). $attributes['back_image']->getClientOriginalName();
            $attributes['back_image']->move(storage_path('app/public/uploads/offer/'),$image_name2);
            $attributes['back_img'] = $image_name2;
        }
        return $this->model->create(Arr::except($attributes,['image','back_image']));
    }

    public function update($id, array $attributes)
    {
        // TODO: Implement create() method.
        
        if (Arr::exists($attributes,'image')) {
            $image_name = time(). $attributes['image']->getClientOriginalName();
            $attributes['image']->move(storage_path('app/public/uploads/offer/'),$image_name);
            $attributes['img'] = $image_name;    
        }
        if(Arr::exists($attributes,'back_image')){
            $image_name2 = time(). $attributes['back_image']->getClientOriginalName();
            $attributes['back_image']->move(storage_path('app/public/uploads/offer/'),$image_name2);
            $attributes['back_img'] = $image_name2;
        }
        $module = $this->model->findOrFail($id);
        $module->update(Arr::except($attributes,['image','back_image']));
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