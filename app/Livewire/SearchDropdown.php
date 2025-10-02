<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class SearchDropdown extends Component
{
    public $query = '';
    public $results = [];
    public $highlightIndex = 0;

    public function updatedQuery()
    {
        $this->results = [];

        if (strlen($this->query) > 1) {
            $this->results = Product::where('name', 'like', '%' . $this->query . '%')
                ->orWhere('brand', 'like', '%' . $this->query . '%')
                ->take(8)
                ->get();
        }

        $this->highlightIndex = 0; // reset selection
    }

    public function incrementHighlight()
    {
        if (count($this->results) === 0) return;
        $this->highlightIndex = ($this->highlightIndex + 1) % count($this->results);
    }

    public function decrementHighlight()
    {
        if (count($this->results) === 0) return;
        $this->highlightIndex = ($this->highlightIndex - 1 + count($this->results)) % count($this->results);
    }

    public function selectHighlighted()
    {
        if (count($this->results) > 0 && isset($this->results[$this->highlightIndex])) {
            return redirect()->route('shop.show', $this->results[$this->highlightIndex]);
        }

        // If no item highlighted, run full search
        return $this->search();
    }

    public function search()
    {
        if ($this->query) {
            return redirect()->route('shop.index', ['search' => $this->query]);
        }
    }

    public function render()
    {
        return view('livewire.search-dropdown');
    }
}
