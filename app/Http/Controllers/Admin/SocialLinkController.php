<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    public function index()
    {
        $socialLinks = SocialLink::all();
        return view('admin.social-link.index', compact('socialLinks'));
    }

    public function create()
    {
        return view('admin.social-link.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'required|string|max:255',
            'url'  => 'required|url',
        ]);

        $link = new SocialLink();
        $link->icon = $request->icon;
        $link->url = $request->url;
        $link->save();

        return redirect()->route('admin.social-links.index')->with('success', 'Social Link created successfully');
    }

    public function edit(SocialLink $socialLink)
    {
        return view('admin.social-link.edit', compact('socialLink'));
    }

    public function update(Request $request, SocialLink $socialLink)
    {
        $request->validate([
            'icon' => 'required|string|max:255',
            'url'  => 'required|url',
        ]);

        $socialLink->icon = $request->icon;
        $socialLink->url = $request->url;
        $socialLink->save();

        return redirect()->route('admin.social-links.index')->with('success', 'Social Link updated successfully');
    }

    public function destroy(SocialLink $socialLink)
    {
        try {
            $socialLink->delete();
            return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => 'Something went wrong!']);
        }
    }
}
