<?php

namespace App\View\Components;

use Illuminate\View\Component;

class LoginForm extends Component
{
    public $userType;
    public $actionRoute;
    public $registerRoute;

    public function __construct($userType, $actionRoute, $registerRoute)
    {
        $this->userType = $userType;
        $this->actionRoute = $actionRoute;
        $this->registerRoute = $registerRoute;
    }

    public function render()
    {
        return view('components.login-form');
    }
}

