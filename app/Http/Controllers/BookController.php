<?php

namespace App\Http\Controllers;

use Illuminate\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\BookRequest;
use App\Book;

class BookController extends Controller
{
    protected $books;

    public function __construct(Book $books){
        $this->books = $books;
    }

    public function index()
    {
        $view = $this->books->getPaginate();
        return view('books.index', compact('view'));
    }

    public function show($id){
        $view = $this->books->getWhere('book_status', $id);
        return view('books.index', compact('view'));
    }

    public function store(BookRequest $request)
    {
        $view = $this->books->create($request->all());
        return redirect(route('book.index'))->with('status', 'Thêm sách thành công');
    }


    public function update(BookRequest $request, $id)
    {
        $author = Book::find($id)->update($request->all());
        return response()->json($author);
    }

    public function destroy($id)
    {
        if (Book::find($id)->delete())
            return redirect(route('author.index'))->with('status', 'Xóa sách thành công');
        else
            return redirect(route('author.index'))->with('error', 'Xóa sách tác giả không thành công');
    }
}
