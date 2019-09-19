<?php

namespace App\Http\Controllers;

use Illuminate\Routing\ResponseFactory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\Books\BookRepositoryInterface;
use App\Repositories\Authors\AuthorRepositoryInterface;
use App\Http\Requests\AuthorRequest;

class AuthorController extends Controller
{
    protected $books;
    protected $authors;

    public function __construct(BookRepositoryInterface $books, AuthorRepositoryInterface $authors)
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

    public function indexPagenate(Request $request)
    {
        $view = $this->authors->getPaginate();
        $page = $view->currentPage();
        if ($request->ajax()) {
            return view('authors.table', compact('view', 'page'));
        }
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
        $author = $this->authors->update($request->id, $request->only('author_name'));
        if ($author) {
            return response()->json(['success'=>'Sửa tác giả thành công']);
        } else {
            return response()->json(['error'=>'Sửa tác giả không thành công']);
        }
    }

    public function deleteBook($id)
    {
        $getBook =  $this->books->getWhere('author_id', $id);
        foreach ($getBook as $book) {
            $this->books->delete($book->id);
        }
    }

    public function destroyAjax(Request $request)
    {
        $findBook = $this->books->getWhere('author_id', $request->id);
        foreach ($findBook as $book) {
            $checkBook = $this->books->find($book->id)->users()->get();
            if ($checkBook->count() > 0) {
                return response()->json(['error' => 'Sách tác giả này đã có người mượn']);
                break;
            }
        }
        $this->deleteBook($request->id);
        if ($this->authors->delete($request->id)) {
            return response()->json(['success' => 'Xóa tác giả thành công']);
        } else {
            return response()->json(['error' => 'Xóa tác giả không thành công']);
        }
    }
}
