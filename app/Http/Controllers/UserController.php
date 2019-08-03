<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Repositories\Users\UserRepositoryInterface;

class UserController extends Controller
{
    protected $users;

    public function __construct(UserRepositoryInterface $users)
    {
        $this->users = $users;
    }

    public function index()
    {
        $view = $this->users->paginateUser();
        $page = $view->currentPage();
        return view('users.index', compact('view', 'page'));
    }
}
