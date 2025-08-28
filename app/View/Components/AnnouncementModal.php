<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AnnouncementModal extends Component
{
    public $announcement;

    /**
     * Create a new component instance.
     *
     * @param array|null $announcement
     */
    public function __construct($announcement = null)
    {
        $this->announcement = $announcement;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.announcement-modal');
    }
}
