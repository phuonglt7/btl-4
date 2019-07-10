<?php

namespace App\Http\Controllers;

use Illuminate\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Book;

class BookController extends Controller
{
    protected $books;

    public function __construct(Book $books){
        $this->books = $books;
    }

    public function index()
    {
        $view = Book::all();
        return view('books.index', compact('view'));
    }

    public function show($id){

    }
}
