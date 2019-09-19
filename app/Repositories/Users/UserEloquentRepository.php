<?php
namespace App\Repositories\Users;

use App\Repositories\EloquentRepository;
use Illuminate\Support\Carbon;

class UserEloquentRepository extends EloquentRepository implements UserRepositoryInterface
{
    public function getModel()
    {
        return \App\User::class;
    }

    public function paginateUser()
    {
        return $this->_model->paginate(5);
    }

    public function findPivot($id)
    {
        return $this->_model->find($id)->books();
    }

    public function updateUser($id, array $attributes)
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }
        return false;
    }
}