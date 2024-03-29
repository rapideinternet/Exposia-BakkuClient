<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Menu extends Component
{
    /**
     * The slug for the menu
     *
     * @var
     */
    public $slug;

    /**
     * Create a new component instance.
     *
     * @param $slug
     */
    public function __construct($slug)
    {
        // Set the slug for the view
        $this->slug = $slug;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render(): View|Closure|string
    {
        return view('components.menu');
    }
}
