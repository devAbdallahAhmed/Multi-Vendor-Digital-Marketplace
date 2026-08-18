@extends('admin.layouts.master')

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="col-12">
                    <div class="card shadow-sm border-0" style="border-radius: 12px;">
                        <div class="card-header bg-transparent border-0 px-4 pt-4 pb-0">
                            <h3 class="card-title fw-bold">{{ __('Update Footer Section') }}</h3>
                        </div>

                        <div class="card-body p-0">
                            <form action="{{ route('admin.footer-section.update', 1) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="card-body p-4">
                                    <div class="row g-4">
                                        <div class="col-md-12">
                                            <div class="border rounded-3 p-3 bg-light">
                                                <x-admin.input-textarea name="description"
                                                    label="{{ __('Footer Description') }}"
                                                    value="{{ old('description', $footerSection->description ?? '') }}"
                                                    rows="4" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="border rounded-3 p-3 bg-light">
                                                <x-admin.input-text name="item_sold" label="{{ __('Total Items Sold') }}"
                                                    value="{{ old('item_sold', $footerSection->item_sold ?? '') }}" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="border rounded-3 p-3 bg-light">
                                                <x-admin.input-text name="community_earnings"
                                                    label="{{ __('Community Earnings') }}"
                                                    value="{{ old('community_earnings', $footerSection->community_earnings ?? '') }}" />
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="border rounded-3 p-3 bg-light">
                                                <x-admin.input-text name="copyright" label="{{ __('Copyright Text') }}"
                                                    value="{{ old('copyright', $footerSection->copyright ?? '') }}"
                                                    placeholder="Copyright © 2026 YourSite. All rights reserved." />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer bg-white border-top px-4 py-3"
                                    style="border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;">
                                    <button type="submit" class="btn btn-primary rounded-3 px-4">
                                        <i class="ti ti-device-floppy me-1"></i>
                                        {{ __('Save Changes') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
