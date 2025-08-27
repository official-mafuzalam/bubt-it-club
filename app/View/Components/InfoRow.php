<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InfoRow extends Component
{
    /**
     * Create a new component instance.
     */
    public $label;
    public $value;
    public $capitalize;

    public function __construct($label, $value, $capitalize = false)
    {
        $this->label = $label;
        $this->value = $value;
        $this->capitalize = $capitalize;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.info-row');
    }
}
