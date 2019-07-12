<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BorrowBook extends Model
{
    use SoftDeletes;

    protected $table = 'borrow_books';

    protected $fillable = [
        'book_id', 'user_id', 'borrow_day', 'pay_day', 'borrow_status',
    ];

    public $timestamps = true;

    protected $dates = ['deleted_at'];

    public function findIdUser($id)
    {
        return $this->where('user_id', $id)->where('borrow_status', 1)->first();
    }

    public function getWhere($key, $value)
    {
        return $this->where($key, $value)->get();
    }
}
