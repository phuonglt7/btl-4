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

    public function books()
    {
        return $this->hasMany('app\Book', 'author_id', 'id');
    }
}
