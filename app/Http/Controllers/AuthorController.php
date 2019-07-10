<?php

namespace App\Http\Controllers;

use Illuminate\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Author;
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

    public function store(Request $request)
    {
        $author = $this->authors->create($request->only(['author_name']));
        return redirect(route('author.index'))->with('status', "Thêm tác giả thành công");
    }

    public function update(Request $request, $id)
    {
        $author = Author::find($id)->update($request->all());
        return response()->json($author);
    }

    public function destroy($id)
    {
        Author::find($id)->delete();
        return response()->json(['done']);
    }
}