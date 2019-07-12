<?php

namespace App\Http\Controllers;

use Illuminate\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\BookRequest;
use App\Http\Requests\BookEditRequest;
use App\Book;
use App\Author;

class BookController extends Controller
{
    protected $books, $authors;

    public function __construct(Book $books, Author $authors){
        $this->books = $books;
        $this->authors = $authors;
    }

    public function index()
    {
        $authorList = $this->authors->getAll();
        $view = $this->books->paginateBook();
        return view('books.index', compact('view', 'authorList'));
    }

    public function show($id){
        $authorList = $this->authors->getAll();
        $view = $this->books->getWherePaginate('book_status', $id);
        return view('books.show', compact('view', 'authorList'));
    }

    public function store(BookRequest $request)
    {
        $view = $this->books->create($request->all());
        return redirect(route('book.index'))->with('status', 'Thêm sách thành công');
    }

    public function update(BookEditRequest $request, $id)
    {
        $author = Book::findOrFail($id);
        $update = $author->update($request->all());
        return response()->json($request->all());
    }

    public function destroy($id)
    {
        if (Book::find($id)->delete())
            return redirect(route('author.index'))->with('status', 'Xóa sách thành công');
        else
            return redirect(route('author.index'))->with('error', 'Xóa sách tác giả không thành công');
    }
}
