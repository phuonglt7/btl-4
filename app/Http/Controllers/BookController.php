<?php

namespace App\Http\Controllers;

use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\BookRequest;
use App\Http\Requests\BookEditRequest;
use App\Book;
use App\Author;
use App\User;

class BookController extends Controller
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
        $authorList = $this->authors->getAll();
        $view = $this->books->paginateBook();
        $page = $view->currentPage();
        return view('books.index', compact('view', 'authorList', 'page'));
    }

    public function show($id)
    {
        $authorList = $this->authors->getAll();
        $view = $this->books->getWherePaginate('book_status', $id);
        $page = $view->currentPage();
        return view('books.show', compact('view', 'authorList', 'page'));
    }

    public function store(BookRequest $request)
    {
        $view = $this->books->create($request->all());
        if ($view) {
            return redirect(route('book.index'))->with('status', 'Thêm sách thành công');
        } else {
            return redirect(route('book.index'))->with('status', 'Thêm sách không thành công');
        }
    }

    public function destroyAjax(Request $request)
    {
        $book = $this->books->find($request->id);
        $checkBook = $book->users()->get();
        if ($checkBook->count() == 0) {
            if ($book->delete()) {
                return response()->json(['success' => 'Xóa sách thành công']);
            } else {
                return response()->json(['error' => 'Xóa sách tác giả không thành công']);
            }
        } else {
            return response()->json(['error' => 'Sách này đang có người mượn']);
        }
    }

    public function updateAjax(BookRequest $request)
    {
        $book = $this->books->updateBookAjax($request->id, $request->except('id'));
        if ($book) {
            return response()->json(['success' => 'Sửa tác giả thành công']);
        } else {
            return response()->json(['error' => 'Sửa tác giả không thành công']);
        }
    }
}
