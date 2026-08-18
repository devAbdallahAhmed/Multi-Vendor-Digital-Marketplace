<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use Illuminate\Http\Request;
use App\Models\Item;

class HeroSectionController extends Controller
{
    public function index()
    {
        $hero = HeroSection::firstOrCreate(
            ['id' => 1],
            [
                'title' => 'Discover premium digital assets',
                'subtitle' => 'WordPress themes, PHP scripts, HTML templates, and mobile UI kits.',
            ]
        );

        return view('admin.sections.hero.index', compact('hero'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'badge' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string',
        ]);

        $tags = [];

        if ($request->filled('trending_tags')) {
            $tagsInput = $request->trending_tags;
            $decodedTags = json_decode($tagsInput, true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($decodedTags)) {
                if (isset($decodedTags[0]['value'])) {
                    $tags = array_column($decodedTags, 'value');
                } else {
                    $tags = $decodedTags;
                }
            } else {
                $tags = array_filter(array_map('trim', explode(',', $tagsInput)));
            }
        }

        $hero = HeroSection::findOrFail($id);

        $hero->update([
            'badge' => $request->badge,
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'trending_tags' => $tags,
        ]);

        return redirect()->back()->with('success', 'Hero Section updated successfully');
    }

    public function productSearch(Request $request)
    {
        $search = $request->q ?? $request->search;
        $products = Item::where('name', 'like', "%{$search}%")
            ->paginate(30)
            ->withQueryString();

        $formattedProducts = $products->map(function ($item) {
            return [
                'id' => $item->id,
                'text' => $item->name,
            ];
        });

        return response()->json([
            'results' => $formattedProducts,
            'pagination' => [
                'more' => $products->hasMorePages()
            ]
        ]);
    }
    public function destroy(string $id)
    {
        //
    }
}
