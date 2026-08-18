<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BannerSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BannerSectionController extends Controller
{
    public function index()
    {
        $bannerSection = BannerSection::first();
        return view('admin.sections.banner-section.index', compact('bannerSection'));
    }

    public function update(Request $request, string $id)
    {
        $bannerSection = BannerSection::firstOrCreate(['id' => 1]);
        $data = $request->except(['_token', '_method']);

        if ($request->hasFile('banner_image_1')) {
            if (File::exists(public_path($bannerSection->banner_image_1))) {
                File::delete(public_path($bannerSection->banner_image_1));
            }
            $image = $request->file('banner_image_1');
            $imageName = 'banner_1_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/banners'), $imageName);
            $data['banner_image_1'] = 'uploads/banners/' . $imageName;
        }

        if ($request->hasFile('banner_image_2')) {
            if (File::exists(public_path($bannerSection->banner_image_2))) {
                File::delete(public_path($bannerSection->banner_image_2));
            }
            $image = $request->file('banner_image_2');
            $imageName = 'banner_2_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/banners'), $imageName);
            $data['banner_image_2'] = 'uploads/banners/' . $imageName;
        }

        $bannerSection->update($data);

        return redirect()->back()->with('success', 'Banner Section Updated Successfully');
    }
}
