<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Author;

class AuthorComposer
{
    protected $authors;

    public function __construct(Author $authors){
        $this->authors = $authors;
    }

    public function compose(View $view)
    {
        $author = $this->authors->get();
        $view->with('authorList', $author);
    }
}