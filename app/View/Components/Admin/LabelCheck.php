<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Str;

class LabelCheck extends Component
{
    /**
     * Create a new component instance.
     */
   public string $name;
    public string $label;
    public ?bool $checked;
    public ?string $type;
    /**
     * Create a new component instance.
     */
    public function __construct(string $name, string $label,  $checked = false ,string $type = "text" )
    {
        $this->name = $name;
        $this->label = $label ?? Str::title(str_replace('_', ' ', $name));
        $this->type = $type;
        $this->checked =  old($name, $checked);    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.label-check');
    }
}
