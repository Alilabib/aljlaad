<?php


namespace App\Repositories\Provider;


use App\Models\User;
use Illuminate\Support\Arr;
use App\Models\Token;
use JWTAuth;

class ProviderRepository implements ProviderInterface
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function getAll()
    {
        // TODO: Implement getAll() method.
        return $this->model->where('type','!=','user')->get();
    }

    public function getByID($id)
    {
        // TODO: Implement getByID() method.
        return $this->model->findOrFail($id);
    }

    public function create(array $attributes)
    {
        // TODO: Implement create() method.
        $attributes['type'] = 'provider';
        $provider = $this->model->create(Arr::except($attributes,['area_id']));
        $provider->areas()->sync($attributes['area_id']);
        $token = new Token();
        $token->user_id = $provider->id;
        $token->jwt = JWTAuth::fromUser($provider);
        $token->is_logged_in = 'false';
        $token->save();

        return $provider;
    }

    public function update($id, array $attributes)
    {
        // TODO: Implement update() method.
        $provider = $this->model->findOrFail($id);
        $provider->update(Arr::except($attributes,['area_id']));
        $provider->save();
        $provider->areas()->sync($attributes['area_id']);
        return $provider;
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
        $provider = $this->getByID($id);
        return $provider->delete();
    }
}