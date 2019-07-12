<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;
use App\Book;

class TrashedController extends Controller
{
    protected $books, $authors;

    public function __construct(Book $books, Author $authors){
        $this->books = $books;
        $this->authors = $authors;
    }

    public function viewAuthor()
    {
        $view = $this->authors->trashed();
        return view('trashed.indexAuthor', compact('view'));
    }

    public function viewBook()
    {
        $authorList = $this->authors->getWithTrashed();
        $view = $this->books->trashed();
        return view('trashed.indexBook', compact('view', 'authorList'));
    }

    public function restoreBook(Request $request)
    {
        $book_id = $this->books->getIdAuthor($request->input('book_id'));
        $countAuthor = $this->authors->find($book_id);
        if ($countAuthor->count()) {
            $book = $this->books->trashedFind($request->input('book_id'));
            if($book->restore())
                return redirect(route('trash-book'))->with('status', 'Sách phục hồi thành công');
            else
                return redirect(route('trash-book'))->with('error', 'Sách phục hồi không thành công');
        } else {
            return redirect(route('trash-book'))->with('error', 'Tác gỉa sách không tồn tại');
        }
    }

    public function restoreAuthor(Request $request)
    {
        $author = $this->authors->trashedFindAuthor($request->input('author_id'));
        if ($author->restore())
            return redirect(route('trash-author'))->with('status', 'Tác gỉa phục hồi thành công');
        else
            return redirect(route('trash-author'))->with('status', 'Tác gỉa phục hồi không thành công');
    }

    public function deleteAuthor(Request $request)
    {
        $author = $this->authors->trashedFindAuthor($request->input('book_id'));
        $databook = $this->books->getWhereTrashed('author_id', $request->input('author_id'));
        foreach ($databook as $book)
        {
            $this->books->trashedFind($book->id)->forceDelete();
        }
        if ($author->forceDelete())
            return redirect(route('trash-author'))->with('status', 'Xóa tác giả thành công');
        else
            return redirect(route('trash-author'))->with('error', 'Xóa tác giả không thành công');

    }

    public function deleteBook(Request $request)
    {
        $book = $this->books->trashedFind($request->input('book_id'));
        if ($book->forceDelete())
            return redirect(route('trash-author'))->with('status', 'Sách xóa thành công');
        else
            return redirect(route('trash-author'))->with('error', 'Sách xóa không thành công');
    }

    public function updateAjax(BookEditRequest $request, $id)
    {
        
    }
}
