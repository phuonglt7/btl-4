<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;
use App\Repositories\Books\BookRepositoryInterface;
use App\Repositories\Authors\AuthorRepositoryInterface;

class TrashedController extends Controller
{
    protected $books;
    protected $authors;

    public function __construct(BookRepositoryInterface $books, AuthorRepositoryInterface $authors)
    {
        $this->books = $books;
        $this->authors = $authors;
    }

    public function viewAuthor(Request $request)
    {
        $view = $this->authors->trashed();
        $page = $view->currentPage();
        $status ="author";
        if ($request->ajax()) {
            return view('trashed.indexAuthor', compact('view', 'page', 'status'));
        }
        return view('trashed.layouts', compact( 'view', 'page', 'status'));
    }

    public function viewBook(Request $request)
    {
        $authorList = $this->authors->getWithTrashed();
        $viewBook= $this->books->trashed();
        $page = $viewBook->currentPage();
        $status="book";
        if ($request->ajax()) {
            return view('trashed.indexBook', compact('viewBook', 'authorList', 'page', 'status'));
        }
        return view('trashed.layouts', compact('viewBook', 'authorList', 'page', 'status'));
    }

    public function restoreBook(Request $request)
    {
        $book_id = $this->books->getIdAuthor($request->id);
        $countAuthor = $this->authors->find($book_id);
        if ($countAuthor->count()) {
            $book = $this->books->trashedFind($request->id);
            if ($book->restore()) {
                return response()->json(['success' =>'Sách phục hồi thành công']);
            } else {
                return response()->json(['error' => 'Sách phục hồi không thành công']);
            }
        } else {
            return response()->json(['error' => 'Tác gỉa sách không tồn tại']);
        }
    }

    public function restoreAuthor(Request $request)
    {
        $author = $this->authors->trashedFindAuthor($request->id);
        if ($author->restore()) {
            return response()->json(['success' => 'Tác gỉa phục hồi thành công']);
        } else {
            return response()->json(['error' => 'Tác gỉa phục hồi không thành công']);
        }
    }

    public function deleteAuthor(Request $request)
    {
        $author = $this->authors->trashedFindAuthor($request->id);
        $databook = $this->books
        ->getWhereTrashed('author_id', $request->id);
        foreach ($databook as $book) {
            $this->books->deleteForce($book->id);
        }
        if ($this->authors->deleteForce($request->id)) {
            return response()->json(['success' => 'Xóa tác giả thành công']);
        } else {
            return response()->json(['error' => 'Xóa tác giả không thành công']);
        }
    }

    public function deleteBook(Request $request)
    {
        if ($this->books->deleteForce($request->id)) {
            return response()->json(['success' => 'Sách xóa thành công']);
        } else {
            return response()->json(['error' => 'Sách xóa không thành công']);
        }
    }
}
