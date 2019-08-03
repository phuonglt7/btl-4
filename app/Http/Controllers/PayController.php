<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Authors\AuthorRepositoryInterface;
use App\Repositories\Books\BookRepositoryInterface;
use App\Repositories\Users\UserRepositoryInterface;

class PayController extends Controller
{
    protected $books;
    protected $authors;
    protected $users;

    public function __construct(BookRepositoryInterface $books, AuthorRepositoryInterface $authors, UserRepositoryInterface $users)
    {
        $this->books = $books;
        $this->authors = $authors;
        $this->users = $users;
    }

    public function index()
    {
        $book = $this->books->getAll();
        $view = $this->users->find(Auth::id())->books()->get();
        return view('pay.index', compact('view', 'book'));
    }

    public function payBook(Request $request)
    {
        $deleteBorrow = $this->users->find(Auth::id())->books()
                            ->detach($request->book_id);
        $this->books->update($request->book_id, ['book_status' => 1]);
        if ($deleteBorrow) {
            return redirect(route('pay.index'))
                        ->with('status', 'Trả sách thành công');
        } else {
            return redirect(route('pay.index'))
                        ->with('error', 'Trả sách thành công');
        }
    }
}
