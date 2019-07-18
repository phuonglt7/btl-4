<?php

namespace App\Http\Controllers;

use Illuminate\Routing\ResponseFactory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Author;
use App\Book;
use App\Http\Requests\AuthorRequest;

class AuthorController extends Controller
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
        $view = $this->authors->getPaginate();
        $page = $view->currentPage();
        return view('authors.index', compact('view', 'page'));
    }

    public function store(AuthorRequest $request)
    {
        $author = $this->authors->create($request->all());
        if ($author) {
            return response()->json(['success'=>"Thêm tác giả thành công"]);
        } else {
            return response()->json(['error' => "Thêm tác giả không thành công"]);
        }
    }

    public function updateAjax(AuthorRequest $request)
    {
        $author = Author::find($request->id)->update($request->only('author_name'));
        if ($author) {
            return response()->json(['success'=>'Sửa tác giả thành công']);
        } else {
            return response()->json(['error'=>'Sửa tác giả không thành công']);
        }
    }

    public function destroyAjax(Request $request)
    {
        $findBook = $this->books->where('author_id', $request->id)->get();
        foreach ($findBook as $book) {
            $checkBook = $this->books->find($book->id)->users()->get();
            if ($checkBook->count() > 0) {
                return response()->json(['error' => 'Sách tác giả này đã có người mượn']);
                break;
            }
        }
        if ($this->authors->deleteAuthor($request->id)) {
            return response()->json(['success' => 'Xóa tác giả thành công']);
        } else {
            return response()->json(['error' => 'Xóa tác giả không thành công']);
        }
    }
}
