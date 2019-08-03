<?php

namespace App\Http\Controllers;

use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\BookRequest;
use App\Http\Requests\BookEditRequest;
use App\Repositories\Books\BookRepositoryInterface;
use App\Repositories\Authors\AuthorRepositoryInterface;
use App\User;

class BookController extends Controller
{
    protected $books;
    protected $authors;

    public function __construct(BookRepositoryInterface $books, AuthorRepositoryInterface $authors)
    {
        $this->books = $books;
        $this->authors = $authors;
    }

    public function index(Request $request)
    {
        $authorList = $this->authors->getAll();
        $view = $this->books->getPaginate();
        $page = $view->currentPage();
        if ($request->ajax()) {
            return view('books.table', compact('view', 'authorList', 'page'));
        }
        return view('books.index', compact('view', 'authorList', 'page'));
    }

    public function listBookView(Request $request)
    {
        $authorList = $this->authors->getAll();
        $view = $this->books->getViewPaginate();
        $page = $view->currentPage();
        if ($request->ajax()) {
            return view('books.table', compact('view', 'authorList', 'page'));
        }
        return view('books.index', compact('view', 'authorList', 'page'));
    }

    public function listBookBorrow(Request $request)
    {
        $authorList = $this->authors->getAll();
        $view = $this->books->getBorrowPaginate();
        $page = $view->currentPage();
        if ($request->ajax()) {
            return view('books.table', compact('view', 'authorList', 'page'));
        }
        return view('books.index', compact('view', 'authorList', 'page'));
    }

    public function listBookNone(Request $request)
    {
        $authorList = $this->authors->getAll();
        $view = $this->books->getNonePaginate();
        $page = $view->currentPage();
        if ($request->ajax()) {
            return view('books.table', compact('view', 'authorList', 'page'));
        }
        return view('books.index', compact('view', 'authorList', 'page'));
    }
    public function show(Request $request, $id)
    {
        $authorList = $this->authors->getAll();
        $view = $this->books->getWherePaginate('book_status', $id);
        $page = $view->currentPage();
        if ($request->ajax()) {
            return view('books.table', compact('view', 'authorList', 'page'));
        }
        return view('books.index', compact('view', 'authorList', 'page'));
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
            $book = $this->books->update($request->id, $request->except('id'));
            if ($book) {
                return response()->json(['success' => 'Sửa tác giả thành công']);
            } else {
                return response()->json(['error' => 'Sửa tác giả không thành công']);
            }
        }
    }
}
