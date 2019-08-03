<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;
use App\Repositories\Users\UserRepositoryInterface;

class HomeController extends Controller
{
    protected $users;

    public function __construct(UserRepositoryInterface $users)
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
              return response()->json(['success' => 'Sửa thông tin thành công']);
        } else {
            return response()->json(['error' => 'sửa thông tin không thành công']);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('login'));
    }
}
