@extends('frontend.layouts.master')

@section('content')
    <section class="prem-breadcrumb" style="background-image: url('{{ asset(config('settings.breadcrumb')) }}');">
        <div class="container container-two">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-center">
                    <ul class="prem-breadcrumb-list">
                        <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                        <li><span><i class="fas fa-chevron-right font-10"></i></span></li>
                        <li>
                            <span>
                                {{ $highlightedSection->title ?? __('Highlighted Products') }}
                            </span>
                        </li>
                    </ul>
                    <h3 class="prem-breadcrumb-title">
                        {{ $highlightedSection->title ?? __('Highlighted Products') }}
                    </h3>
                    @if (isset($highlightedSection) && !empty($highlightedSection->subtitle))
                        <p class="text-white mt-2">{{ $highlightedSection->subtitle }}</p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="prem-shop-section">
        <div class="container container-two">
            <div class="row">

                <div class="col-lg-12">
                    <div class="prem-filter-top border-bottom pb-3 mb-4">
                        <ul class="prem-nav-pills nav" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-product-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-product" type="button"
                                    role="tab">{{ __('All Highlighted Items') }}</button>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-product" role="tabpanel">
                            <div class="row gy-4">
                                @forelse ($highlightedProducts as $product)
                                    <x-frontend.product-card :item="$product" />
                                @empty
                                    <div class="col-12 text-center mt-5">
                                        <div class="p-5 bg-light rounded-3">
                                            <h5 class="text-muted mb-0">
                                                {{ __('No products found in this section at the moment.') }}</h5>
                                        </div>
                                    </div>
                                @endforelse
                            </div>

                            @if (isset($highlightedProducts) && $highlightedProducts->hasPages())
                                <div class="mt-5 d-flex justify-content-center">
                                    <x-frontend.pagination :paginator="$highlightedProducts" />
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
