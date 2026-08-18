<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ContactInfoUpdateRequest;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use App\Models\Setting;

class ContactInfoSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Setting::whereIn('key', [
            'contact_phone_1',
            'contact_phone_2',
            'contact_email_1',
            'contact_email_2',
            'contact_link_1',
            'contact_link_2',
            'contact_map'
        ])->pluck('value', 'key')->toArray();

        return view('admin.sections.contact-section.index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ContactInfoUpdateRequest $request, string $id = null)
    {
        $validatedData = $request->validated();
        foreach ($validatedData as $key => $value) {
            Setting::updateOrCreate(
                ['key' => 'contact_' . $key],
                ['value' => $value]
            );
        }
        NotificationService::updated('Contact Information Updated Successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
