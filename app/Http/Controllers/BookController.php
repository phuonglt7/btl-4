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
            return response()->json(['success' => 'Thêm sách thành công']);
        } else {
            return response()->json(['error' => 'Thêm sách không thành công']);
        }
    }

    public function destroyAjax(Request $request)
    {
        $book = $this->books->find($request->id);
        if ($book->book_status == DA_MUON_SACH || $book->book_status == DANG_XEM_SACH) {
            return response()->json(['error' => 'Không được xóa']);
        } else {
            if ($book->delete()) {
                return response()->json(['success' => 'Xóa sách thành công']);
            } else {
                return response()->json(['error' => 'Xóa sách tác giả không thành công']);
            }
        }
    }

    public function updateAjax(BookRequest $request)
    {
        $book = $this->books->find($request->id);
        if ($book->book_status == DA_MUON_SACH || $book->book_status == DANG_XEM_SACH) {
            return response()->json(['error' => 'Không được sua']);
        } else {
            $book = $this->books->updateBookAjax($request->id, $request->except('id'));
            if ($book) {
                return response()->json(['success' => 'Sửa tác giả thành công']);
            } else {
                return response()->json(['error' => 'Sửa tác giả không thành công']);
            }
        }
    }
}
