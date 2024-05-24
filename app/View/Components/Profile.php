<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Profile extends Component
{
    public $userType;
    public $actionRoute;
    /**
     * Create a new component instance.
     */
    public function __construct($userType, $actionRoute)
    {
        $this->userType = $userType;
        $this->actionRoute = $actionRoute;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.profile');
    }
}
