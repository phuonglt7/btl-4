<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Book;

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

  
}
