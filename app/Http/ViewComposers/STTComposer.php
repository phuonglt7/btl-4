<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class STTComposer
{
    public $stt;

    public function __construct()
    {
        $this->stt = 1;
    }

    public function compose(View $view)
    {
        $view->with('i', $this->stt);
    }
}