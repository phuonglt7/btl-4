<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Book;
use App\Author;
use App\User;

class PayController extends Controller
{
    protected $books;
    protected $authors;

    public function __construct(Book $books, Author $authors)
    {
        $this->books = $books;
        $this->authors = $authors;
    }

    public function index()
    {
        $book = $this->books->all();
        $view = User::find(Auth::id())->books()->get();
        return view('pay.index', compact('view', 'book'));
    }

    public function payBook(Request $request)
    {
        $deleteBorrow = User::find(Auth::id())->books()
                            ->detach($request->book_id);
        Book::find($request->book_id)->update(['book_status' => 1]);
        if ($deleteBorrow) {
            return redirect(route('pay.index'))
                        ->with('status', 'Trả sách thành công');
        } else {
            return redirect(route('pay.index'))
                        ->with('error', 'Trả sách thành công');
        }
    }
}
