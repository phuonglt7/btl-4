<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class StatusBookComposer
{
    public $status = [];

    public function __construct()
    {
        $this->status = ['1', '2' , '3'];
    }

    public function compose(View $view)
    {
        $view->with('status', $this->status);
    }
}