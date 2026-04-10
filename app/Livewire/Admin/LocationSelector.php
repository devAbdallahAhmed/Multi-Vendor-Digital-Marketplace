<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class LocationSelector extends Component
{
    public $countries = [];
    public $states = []; 
    public $selectedCountry = null;
    public $selectedState = null;

    public function mount($selectedCountry = null, $selectedState = null)
    {
        $this->countries = config('option.countries', []);
        $this->selectedCountry = $selectedCountry;
        $this->selectedState = $selectedState;

        if ($this->selectedCountry) {
            $this->fetchStates($this->selectedCountry);
        }
    }

    public function updatedSelectedCountry($value)
    {
        $this->selectedState = null;
        $this->states = [];
        if (!empty($value)) {
            $this->fetchStates($value);
        }
    }

    protected function fetchStates($countryName)
    {
        try {
            $response = Http::post('https://countriesnow.space/api/v0.1/countries/states', [
                'country' => $countryName
            ]);
            if ($response->successful()) {
                $data = $response->json()['data']['states'] ?? [];
                $this->states = collect($data)->pluck('name')->toArray();
            }
        } catch (\Exception $e) {
            $this->states = [];
        }
    }

    public function render()
    {
        return view('livewire.admin.location-selector');
    }
}