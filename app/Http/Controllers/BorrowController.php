<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BorrowRequest;
use Carbon\Carbon;
use App\Book;
use App\Author;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Jobs\UpdateStatusBook;

class BorrowController extends Controller
{
    protected $books;
    protected $authors;
    protected $users;

    public function __construct(Book $books, Author $authors, User $users)
    {
        $this->books = $books;
        $this->authors = $authors;
        $this->users = $users;
    }


    public function index()
    {
        $authorList = $this->authors->all();
        $view = $this->books->getWherePaginate('book_status', CHUA_MUON_SACH);
        $page = $view->currentPage();
        return view('borrow.index', compact('view', 'authorList', 'page'));
    }

    public function show($id)
    {
        $this->books->find($id)->update(['book_status' => DANG_XEM_SACH]);
        $authorList = $this->authors->getAll();
        $view = $this->books->find($id);
        dispatch(new UpdateStatusBook($id))->delay(Carbon::now()->addMinutes(1));
        return view('borrow.show', compact('view', 'authorList'));
    }

    public function edit($id)
    {
        $authorList = $this->authors->getAll();
        $view = $this->books->find($id);
        return view('borrow.edit', compact('view', 'authorList'));
    }

    public function store(BorrowRequest $request)
    {
        if ($request->pay_day > Carbon::now()->toDateString()) {
            if ($request->pay_day < Carbon::now()->addDay(4)->toDateString()) {
                $payBook = $this->users->findPivot(Auth::id());
                if ($payBook->count() == 0) {
                    $create = $payBook->attach(
                        $request->book_id,
                        [
                            'borrow_day' => date('Y-m-d'),
                            'pay_day' => $request->pay_day
                        ]
                    );
                    $this->books->updateBook($request->book_id, ['book_status' => 3]);
                    return redirect(route('borrow.index'))->with('status', 'Mượn thành công');
                } else {
                    return redirect(route('borrow.index'))->with('error', 'Bạn chưa trả sách');
                }
            } else {
                return redirect()->back()->withInput()->with('error', 'Ban không được mượn quá 4 ngày');
            }
        } else {
            return redirect()->back()->withInput()->with('error', 'Ngày mượn phải sau ngày hôm nay');
        }
    }
}
