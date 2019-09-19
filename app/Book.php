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
}
