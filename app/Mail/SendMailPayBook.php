<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;

class SendMailPayBook extends Mailable
{
    use Queueable, SerializesModels;

    protected $user_book;

    public function __construct($user_book)
    {
        $this->user_book = $user_book;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $book = $this->user_book;

        $user = User::find($book->pivot->user_id);

        return $this->view('mails.payBook', compact('book', 'user'));
    }
}
