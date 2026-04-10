<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Str;

class InputText extends Component
{
   public string $name;
    public string $label;
    public ?string $value;
    public ?string $placeholder;
    public ?string $type;
    /**
     * Create a new component instance.
     */
    public function __construct(string $name, string $label, string $type = "text", string $value = null, string $placeholder = null )
    {
        $this->name = $name;
        $this->label = $label ?? \Str::title(str_replace('_', ' ', $name));
        $this->value = old($name, $value);
        $this->placeholder = $placeholder;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.input-text');
    }
}
