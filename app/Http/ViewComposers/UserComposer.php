<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\User;

class AuthorComposer
{
    protected $users;

    public function __construct(User $users){
        $this->users = $users;
    }

    public function compose(View $view)
    {
        $user = $this->users->get();
        $view->with('userList', $user);
    }
}