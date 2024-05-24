<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ProductForm extends Component
{
    public $producto;
    public $actionRoute;
    public $categorias;
    public $buttonText;

    public function __construct($actionRoute, $categorias, $buttonText, $producto = null)
    {
        $this->actionRoute = $actionRoute;
        $this->producto = $producto;
        $this->categorias = $categorias;
        $this->buttonText = $buttonText;
    }

    public function render()
    {
        return view('components.product-form');
    }
}
