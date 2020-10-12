<?php

namespace App\View\Components;

use Illuminate\View\Component;

class standings extends Component
{
    public $stats;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($stats)
    {
        $this->stats = $stats;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.standings');
    }
}
