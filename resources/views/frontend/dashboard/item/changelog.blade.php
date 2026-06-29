@extends('frontend.dashboard.layouts.master')

@section('content')
    <div class="page-wrapper py-4">
        <div class="container-fluid">

            <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="fw-bold mb-1">{{ __('Product Change Log') }}</h4>
                            <p class="text-muted mb-0">{{ __('Publish new versions and release notes for this asset.') }}</p>
                        </div>
                        <a href="{{ route('user.items.index') }}"
                            class="btn btn-primary d-flex align-items-center gap-2 text-white" style="border-radius: 8px;">
                            {{ __('Back To Items') }}
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-end icon-2">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 12l14 0" />
                                <path d="M13 18l6 -6" />
                                <path d="M13 6l6 6" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <ul class="nav nav-pills mt-4 mb-4">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.items.edit', $item->id) }}">Edit Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('user.item.changelog', $item->id) }}">Change Log</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.item.history', $item->id) }}">History</a>
                </li>
            </ul>

            <div class="row">
                <div class="col-md-8">
                    @if ($item->status === 'approved' || $item->status === 'active')
                        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
                            <div class="card-body p-4">
                                <div class="mb-4">
                                    <h5 class="fw-semibold text-dark mb-1">{{ __('Create Release Version') }}</h5>
                                    <div style="width: 40px; height: 3px; background-color: #0061ff; border-radius: 2px;">
                                    </div>
                                </div>

                                <form action="{{ route('user.item.changelog', $item->id) }}" method="POST"
                                    id="changelog_form">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-md-12">
                                            <x-frontend.input-text name="version" label="{{ __('Version') }}"
                                                placeholder="e.g., V1.0.1 or V2.0.0" required :value="old('version')" />
                                        </div>
                                        <div class="col-md-12">
                                            <x-frontend.textarea id="editor" name="description"
                                                label="{{ __('What is new in this version?') }}"
                                                placeholder="Describe your fixes or new features..." required
                                                :value="old('description')" />
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end border-top pt-4 mt-4">
                                        <button type="submit"
                                            class="btn btn-primary px-5 py-2 fw-bold d-flex align-items-center gap-2"
                                            style="background-color: #0061ff; border: none; border-radius: 8px;">
                                            <i class="ti ti-device-floppy fs-5"></i>
                                            {{ __('Submit Version') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
                            <div class="card-body p-5 text-center">
                                <div class="text-warning mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-alert-circle" width="48" height="48"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                        <path d="M12 8v4"></path>
                                        <path d="M12 16h.01"></path>
                                    </svg>
                                </div>
                                <h5 class="fw-semibold text-dark">{{ __('This item is not approved yet.') }}</h5>
                                <p class="text-muted mb-0">You can publish release changelogs once the reviewer approves
                                    this product.</p>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px; position: sticky; top: 20px;">
                        @include('frontend.dashboard.layouts.partials.Item-Info')
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
