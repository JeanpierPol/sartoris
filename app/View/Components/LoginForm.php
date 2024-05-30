<?php

namespace App\View\Components;

use Illuminate\View\Component;

class LoginForm extends Component
{
    public $userType;
    public $actionRoute;
    public $registerRoute;
    public $googleRoute;

    public function __construct($userType, $actionRoute, $registerRoute, $googleRoute)
    {
        $this->userType = $userType;
        $this->actionRoute = $actionRoute;
        $this->registerRoute = $registerRoute;
        $this->googleRoute = $googleRoute;
    }

    public function render()
    {
        return view('components.login-form');
    }
}

