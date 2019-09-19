<?php
namespace App\Repositories\Books;

use App\Repositories\EloquentRepository;
use Illuminate\Support\Carbon;

class BookEloquentRepository extends EloquentRepository implements BookRepositoryInterface
{
    public function getModel()
    {
        return \App\Book::class;
    }

    public function getPaginate()
    {
        return $this->_model->paginate(5);
    }

    public function getNonePaginate()
    {
        return $this->_model->where('book_status', CHUA_MUON_SACH)->paginate(5);
    }

    public function getBorrowPaginate()
    {
        return $this->_model->where('book_status', DA_MUON_SACH)->paginate(5);
    }

    public function getViewPaginate()
    {
        return $this->_model->where('book_status', DANG_XEM_SACH)->paginate(5);
    }

    public function getWherePaginate($key, $value)
    {
        return $this->_model->where($key, $value)->paginate(5);
    }

    public function getWhere($key, $value)
    {
        return $this->_model->where($key, $value)->get();
    }

    public function getIdAuthor($id)
    {
        return $this->_model->onlyTrashed()->select('author_id')->find($id);
    }

    public function trashed()
    {
        return $this->_model->onlyTrashed()->paginate(5);
    }

    public function trashedFind($id)
    {
        return $this->_model->withTrashed()->find($id);
    }

    public function getWhereTrashed($key, $value)
    {
        return $this->_model->onlyTrashed()->where($key, $value)->get();
    }

    public function getWithTrashed()
    {
        return $this->_model->withTrashed()->first();
    }

    public function deleteForce($id)
    {
        return $this->_model->onlyTrashed()->find($id)->forceDelete();
    }
}