<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PageHeader extends Component
{
    public string $title;
    public ?string $actionRoute;
    public ?string $actionLabel;
    public ?string $actionClass = 'btn-primary';
    //
    /**
     * Create a new component instance.
     */
    public function __construct(
        string $title,
        string $actionRoute = null,
        string $actionLabel = null,
        string $actionClass = 'btn-primary'
    ) {
        $this->title = $title;
        $this->actionRoute = $actionRoute;
        $this->actionLabel = $actionLabel;
        $this->actionClass = $actionClass;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.page-header');
    }
}
