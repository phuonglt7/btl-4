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

    public function authors()
    {
        return $this->belongsTo('app\Author', 'author_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany('app\User', 'borrow_books', 'user_id', 'book_id');
    }

    public function get()
    {
        return $this->all();
    }

    public function get()
    {
        return $this->all();
    }


    public function getWhere($key, $value)
    {
        return $this->where($key, $value)->paginate(5);
    }}
