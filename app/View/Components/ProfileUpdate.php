<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProfileUpdate extends Component
{
    public $userType;
    public $actionRoute;

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
        return view('components.profile-update');
    }
}
