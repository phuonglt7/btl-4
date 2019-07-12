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
        return $this->belongsToMany(User::class);
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

    public function trashed()
    {
        return $this->onlyTrashed()->paginate(5);
    }

    public function trashedFind($id)
    {
        return $this->onlyTrashed()->find($id);
    }

    public function getWhereTrashed($key, $value)
    {
        return $this->onlyTrashed()->where($key, $value)->get();
    }


    public function getWithTrashed()
    {
        return $this->withTrashed()->get();
    }
}
