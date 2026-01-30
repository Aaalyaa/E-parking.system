<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormAction extends Component
{
    public string $cancelRoute;

    /**
     * Create a new component instance.
     */
    public function __construct(string $cancelRoute = null)
    {
        $this->cancelRoute = $cancelRoute ?? url()->previous();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-action');
    }
}
