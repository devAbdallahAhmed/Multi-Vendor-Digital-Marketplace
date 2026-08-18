<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CounterSection;
use Illuminate\Http\Request;

class CounterSectionController extends Controller
{
    public function index()
    {
        $counterSection = CounterSection::first();

        return view('admin.sections.counter-section.index', compact('counterSection'));
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'label_1' => 'required|string|max:255',
            'counter_1' => 'required|numeric',
            'label_2' => 'required|string|max:255',
            'counter_2' => 'required|numeric',
            'label_3' => 'required|string|max:255',
            'counter_3' => 'required|numeric',
            'label_4' => 'required|string|max:255',
            'counter_4' => 'required|numeric',
        ]);

        CounterSection::updateOrCreate(
            ['id' => 1],
            $validatedData
        );

        return redirect()->back();
    }
}
