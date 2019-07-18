<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailPayBook;
use App\Book;
use App\User;

class EmailSendPayBook extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:sendPayBook';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $getBook = Book::where('book_status', DA_MUON_SACH)->with('bookUser')->get();
        foreach ($getBook as $book) {
            if (date('Y-m-d') > $book->bookUser['pay_day']) {
                $user = User::find($book->bookUser['user_id']);
                $user_book = $user->books()->first();
                Mail::to($user->email)->send(new SendMailPayBook($user_book));
                Mail::to("admin@gmail.com")->send(new SendMailPayBook($user_book));
            }
        }
    }
}
