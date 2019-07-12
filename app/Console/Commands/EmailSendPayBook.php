<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailPayBook;
use App\BorrowBook;
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
        $find = BorrowBook::whereRaw('Date(pay_day) < CURDATE()')
            ->where('borrow_status', 1)->get();
        foreach ($find as $user)
        {
            $user = User::find($user->user_id);
            Mail::to($user->email)->send(new SendMailPayBook());
        }
    }
}
