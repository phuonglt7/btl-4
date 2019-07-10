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
    protected $authors;

    public function __construct(Author $authors){
        $this->authors = $authors;
    }

    public function index()
    {
         $view = $this->authors->getPaginate();
        return view('authors.index', compact('view'));
    }

    public function store(AuthorRequest $request)
    {
        $author = $this->authors->create($request->all());
        return redirect(route('author.index'))->with('status', "Thêm tác giả thành công");
    }

    public function update(AuthorRequest $request, $id)
    {
        $author = Author::find($id)->update($request->all());
        return response()->json("Succsess");
    }

    public function destroy($id)
    {
        $findAuthor = Author::findOrFail($id);
        foreach ($findAuthor->books as $book)
        {
            Book::find($book['id'])->delete();
        }
        if ($findAuthor->delete())
            return redirect(route('author.index'))->with('status', 'Xóa tác giả thành công');
        else
            return redirect(route('author.index'))->with('error', 'Xóa tác giả không thành công');

    }
}
