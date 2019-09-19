<?php
namespace App\Repositories\Authors;

use App\Repositories\EloquentRepository;
use Illuminate\Support\Carbon;

class AuthorEloquentRepository extends EloquentRepository implements AuthorRepositoryInterface
{
    public function getModel()
    {
        return \App\Author::class;
    }

      public function getPaginate()
    {
        return $this->_model->paginate(5);
    }

    public function getAll()
    {
        return $this->_model->all();
    }

    public function getWhere($key, $value)
    {
        return $this->_model->where($key, $value)->paginate(5);
    }

    public function create(array $value)
    {
        return $this->_model->insert($value);
    }

    public function trashed()
    {
        return $this->_model->onlyTrashed()->paginate(5);
    }

    public function trashedFindAuthor($id)
    {
        return $this->_model->onlyTrashed()->find($id);
    }

    public function getWithTrashed()
    {
        return $this->_model->withTrashed()->get();
    }

    public function deleteForce($id)
    {
        return $this->_model->withTrashed()->find($id)->forceDelete();
    }
}