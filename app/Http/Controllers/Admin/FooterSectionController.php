<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterSection;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class FooterSectionController extends Controller
{
    public function index()
    {
        $footerSection = FooterSection::first();
        return view('admin.sections.footer-section.index', compact('footerSection'));
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'description' => 'nullable|string|max:2500',
            'item_sold' => 'nullable|string|max:255',
            'community_earnings' => 'nullable|string|max:255',
            'copyright' => 'required|string|max:255',
        ]);

        FooterSection::updateOrCreate(
            ['id' => 1],
            $validatedData
        );
        NotificationService::created('Footer Section Updated Successfully');
        return redirect()->back();
    }
}
