<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateStatusBook implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $book;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        sleep(5);
        Book::find($this->book)->update(['book_status' => 1]);
    }
}
