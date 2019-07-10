<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;
use App\Book;

class TrashedController extends Controller
{
    public function viewAuthor()
    {
        $view = Author::onlyTrashed()->get();
        return view('trashed', compact('view'));
    }
}
