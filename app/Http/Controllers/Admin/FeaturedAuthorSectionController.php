<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeaturedAuthorSection;
use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class FeaturedAuthorSectionController extends Controller
{
    public function index()
    {
        $authors = User::where([
            ['user_type', 'author'],
            ['kyc_status', 1]
        ])->get();

        $featuredAuthor = FeaturedAuthorSection::first();

        return view('admin.sections.featured-author.index', compact('authors', 'featuredAuthor'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'author' => 'required|numeric|exists:users,id',
        ]);

        FeaturedAuthorSection::updateOrCreate(
            ['id' => 1],
            [
                'title' => $request->title,
                'subtitle' => $request->subtitle,
                'author_id' => $request->author,
            ]
        );

        NotificationService::updated();
        return redirect()->back();
    }
}
