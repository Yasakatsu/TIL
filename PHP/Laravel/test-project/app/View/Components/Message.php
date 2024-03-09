<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Message extends Component
{
    public $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function render(): View|Closure|string
    {
        return view('components.message');
    }
}
