<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model
{
    use SoftDeletes;

    protected $table = 'authors';

    protected $fillable = [
        'author_name',
    ];

    public $timestamps = true;

    protected $dates = ['deleted_at'];

    public function books()
    {
        return $this->hasMany('App\Book', 'author_id', 'id');
    }

    public function getPaginate()
    {
        return $this->paginate(5);
    }

    public function getAll()
    {
        return $this->all();
    }

    public function getWhere($key, $value)
    {
        return $this->where($key, $value)->paginate(5);
    }


    public function create(array $value)
    {
        return $this->insert($value);
    }

    public function trashed()
    {
        return $this->onlyTrashed()->paginate(5);
    }

    public function trashedFindAuthor($id)
    {
        return $this->onlyTrashed()->find($id);
    }

    public function getWithTrashed()
    {
        return $this->withTrashed()->get();
    }
}
