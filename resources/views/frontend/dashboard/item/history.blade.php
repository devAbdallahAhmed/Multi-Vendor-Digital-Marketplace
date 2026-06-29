@extends('frontend.dashboard.layouts.master')

@section('content')
    <div class="page-wrapper py-4">
        <div class="container-fluid">

            <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="fw-bold mb-1">{{ __('Update Item') }}</h4>
                            <p class="text-muted mb-0">{{ __('Modify the details below to update your digital asset.') }}</p>
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

            <form action="{{ route('user.items.update', $item->id) }}" method="POST" id="product_form">
                @csrf
                @method('PUT')

                <ul class="nav nav-pills mt-4">
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="{{ route('user.items.edit', $item->id) }}">Edit
                            Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('user.item.changelog', $item->id) }}">ChangLog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('user.item.history', $item->id) }}">History</a>
                    </li>
                </ul>
                <div class="row">
                    <div class="col-md-8">

                        @forelse ($histories as $history)
                            <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
                                <div class="card-body p-4">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h6 class="fw-bold text-dark mb-0">{{ $history->title }}</h6>
                                        <small class="text-muted">
                                            <i class="ti ti-calendar me-1"></i>
                                            {{ $history->created_at->format('M d, Y - h:i A') }}
                                        </small>
                                    </div>

                                    <p class="text-muted mb-3" style="font-size: 14px; line-height: 1.6;">
                                        {{ $history->body }}
                                    </p>

                                    <div class="d-flex align-items-center gap-2 pt-2 border-top border-light">
                                        <span class="text-secondary small fw-medium">{{ __('Status:') }}</span>
                                        <span class="badge bg-light text-dark border px-2 py-1 small">
                                            {{ ucfirst(Str::replace('_', ' ', $history->status)) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
                                <div class="card-body p-5 text-center text-muted">
                                    <i class="ti ti-history fs-1 mb-2 d-block text-secondary"></i>
                                    <p class="mb-0 fw-medium">{{ __('No history logs available for this item yet.') }}</p>
                                </div>
                            </div>
                        @endforelse

                    </div>

                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px; position: sticky; top: 20px;">

                          <!-- Item Info  -->
                          @include('frontend.dashboard.layouts.partials.Item-Info')
                          
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end border-top pt-4 mt-4">
                    <button type="submit" class="btn btn-primary px-5 py-2 fw-bold d-flex align-items-center gap-2"
                        style="background-color: #0061ff; border: none; border-radius: 8px;">
                        <i class="ti ti-device-floppy fs-5"></i>
                        {{ __('Update Item') }}
                    </button>
                </div>
            </form>

        </div>
    </div>
@endsection
