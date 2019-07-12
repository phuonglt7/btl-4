<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    protected $users;

    public function __construct(User $users){
        $this->users = $users;
    }

    public function index()
    {
        $view = $this->users->paginateUser();
        return view('users.index', compact('view'));
    }

    public function store(Request $request, $id)
    {
        $view = $this->users->create($request->all());
        return redirect(route('user.index'))->with('status', 'Thêm tài khoản thành công');
    }

    public function destroy($id)
    {
        $payBook = User::find(Auth::id())->books();
        if ($payBook->count() == 0) {
            if (User::find($id)->delete())
                return redirect(route('user.index'))->with('status', 'Xóa tài khoản thành công');
            else
                return redirect(route('user.index'))->with('error', 'Xóa tài khoản không thành công');
        } else {
            return redirect(route('user.index'))->with('error', 'Tài khoản này chưa trả sách');
        }
    }
}
