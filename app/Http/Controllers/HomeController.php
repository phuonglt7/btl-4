<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;

class HomeController extends Controller
{
    protected $users;

    public function __construct(User $users)
    {
        $this->users = $users;
    }

    public function index()
    {
        return view('home');
    }

    public function information()
    {
        $view = $this->users->find(Auth::id());
        return view('auth.information', compact('view'));
    }

    public function updateInformation(UserRequest $request)
    {
        $user = $this->users->find(Auth::id());
        if ($user->update($request->only('fullname'))) {
            return redirect(route('book.index'))->with('status', 'Đổi thông tin tài khoản thành công');
        } else {
            return redirect(route('book.index'))->with('status', 'Đổi thông tin tài khoản không thành công');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('login'));
    }
}
