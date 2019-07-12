<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Author;

class AuthorComposer
{
    public function compose(View $view)
    {
        $author = Author::all();
        $view->with('listAuthor', $author);
    }
}