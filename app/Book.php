<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;

    protected $table = 'books';

    protected $fillable = [
        'book_name', 'author_id', 'book_status',
    ];

    public $timestamps = true;

    protected $dates = ['deleted_at'];

    public function authors()
    {
        return $this->belongsTo('App\Author', 'author_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'book_user')->withPivot('borrow_day', 'pay_day');
    }

    public function bookUser()
    {
        return $this->hasOne('App\BookUser', 'book_id', 'id');
    }

    public function getAll()
    {
        return $this->all();
    }

    public function paginateBook()
    {
        return $this->paginate(5);
    }

    public function getWherePaginate($key, $value)
    {
        return $this->where($key, $value)->paginate(5);
    }

    public function getWhere($key, $value)
    {
        return $this->where($key, $value)->get();
    }

    public function getIdAuthor($id)
    {
        return $this->onlyTrashed()->select('author_id')->find($id);
    }

    public function updateBook($id, array $attributes)
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }
        return false;
    }

    public function updateBookAjax($id, array $value)
    {
        return $this->find($id)->update($value);
    }

    public function trashed()
    {
        return $this->onlyTrashed()->paginate(5);
    }

    public function trashedFind($id)
    {
        return $this->withTrashed()->find($id);
    }

    public function getWhereTrashed($key, $value)
    {
        return $this->onlyTrashed()->where($key, $value)->get();
    }

    public function getWithTrashed()
    {
        return $this->withTrashed()->first();
    }
}
