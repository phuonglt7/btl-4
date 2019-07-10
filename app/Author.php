<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
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

    public function get()
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

}
