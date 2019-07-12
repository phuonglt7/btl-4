<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BorrowRequest;
use App\Book;
use App\Author;
use App\BorrowBook;
use App\User;
use Illuminate\Support\Facades\Auth;

class BorrowController extends Controller
{
    protected $books, $authors, $borrow;

    public function __construct(Book $books, Author $authors, BorrowBook $borrow){
        $this->books = $books;
        $this->authors = $authors;
        $this->borrow = $borrow;
    }

    public function index()
    {
        $authorList = $this->authors->getAll();
        $view = $this->books->getWherePaginate('book_status', 1);
        return view('borrow.index', compact('view', 'authorList'));
    }

    public function show($id)
    {
        $authorList = $this->authors->getAll();
        $view = $this->books->find($id);
        return view('borrow.show', compact('view', 'authorList'));
    }

    public function edit($id)
    {
        $authorList = $this->authors->getAll();
        $view = $this->books->find($id);
        return view('borrow.edit', compact('view', 'authorList'));
    }


    public function store(BorrowRequest $request)
    {
        $payBook = User::find(Auth::id())->books();
        if ($payBook->count() == 0) {
            $create = User::find(Auth::id())->books()
                        ->attach($request->book_id,
                            [
                                'borrow_day' => date('Y-m-d'),
                                'pay_day' => $request->pay_day,
                            ]);
            Book::find($request->book_id)->update('book_status', 3);
                return redirect(route('borrow.index'))->with('status', 'Mượn thành công');
        } else {
            return redirect(route('borrow.index'))->with('error', 'Bạn chưa trả sách');
        }
    }
}
