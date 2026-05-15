<?php

namespace App\View\Components\Frontend;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Str;

class InputSelect extends Component
{
    public string $name;
    public string $label;
    public ?bool $required;
    /**
     * Create a new component instance.
     */
    public function __construct(string $name, string $label , ?bool $required = false)
    {
        $this->name = $name;
        $this->label = $label ?? Str::title(str_replace('_', ' ', $name));
        $this->required = $required;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.input-select');
    }
}
