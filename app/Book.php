<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
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
        return $this->belongsToMany('App\User', 'borrow_books', 'user_id', 'book_id');
    }

    public function get()
    {
        return $this->all();
    }

    public function getPaginate()
    {
        return $this->paginate(5);
    }

    public function getWhere($key, $value)
    {
        return $this->where($key, $value)->paginate(5);
    }
}
