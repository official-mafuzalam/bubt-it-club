<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InfoStatus extends Component
{
    /**
     * Create a new component instance.
     */
    public $label;
    public $status;
    public $trueColor;
    public $falseColor;
    public $trueText;
    public $falseText;

    public function __construct($label, $status, $trueColor = 'green', $falseColor = 'gray', $trueText = 'Active', $falseText = 'Inactive')
    {
        $this->label = $label;
        $this->status = $status;
        $this->trueColor = $trueColor;
        $this->falseColor = $falseColor;
        $this->trueText = $trueText;
        $this->falseText = $falseText;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.info-status');
    }
}
