<?php

namespace App\View\Components;

use App\Models\Store;
use Closure;
use GuzzleHttp\Psr7\Request;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SearchComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public $store;
    public function __construct(Request $request, Store $store)
    {
        $this->store = $store;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.search-component', compact('stores'));
    }
}