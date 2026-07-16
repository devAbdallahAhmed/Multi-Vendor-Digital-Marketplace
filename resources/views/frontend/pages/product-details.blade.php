@extends('frontend.layouts.master')

@section('content')
    <section class="prem-breadcrumb"
        style="background: url('{{ asset('assets/front/images/thumbs/breadcrumb_bg.jpg') }}') center center/cover no-repeat;">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-12">
                    <h3 class="prem-breadcrumb-title">{{ __('Product Details') }}</h3>
                </div>
            </div>
        </div>
    </section>

    <section class="wsus__product_details padding-y-120 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-7">
                    <div class="prem-product-card">
                        <div class="wsus__product_details_img">

                            @if ($items->preview_type === 'image')
                                <img src="{{ asset($items->preview_image) }}" alt="product" class="img-fluid w-100">
                            @elseif ($items->preview_type === 'video')
                                <video id="player" playsinline controls class="w-100">

                                    <source src="{{ asset($items->preview_video ?? $items->main_file) }}" alt="product"
                                        type="video/mp4" />

                                </video>
                            @elseif ($items->preview_type === 'audio')
                                <audio id="player" controls class="w-100">

                                    <source src="{{ asset($items->main_file) }}" type="audio/mp3" />

                                </audio>
                            @endif

                        </div>

                        <div class="wsus__product_details_text">
                            <ul class="nav nav-pills mb-4" id="pills-tab" role="tablist">
                                <li class="nav-item"><button class="nav-link active" data-bs-toggle="pill"
                                        data-bs-target="#pills-home" type="button"><i class="ti ti-layers-intersect"></i>
                                        Description</button></li>
                                <li class="nav-item"><button class="nav-link" data-bs-toggle="pill"
                                        data-bs-target="#pills-profile" type="button"><i class="far fa-comments"></i>
                                        Comments</button></li>
                            </ul>

                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-home">
                                    <div class="wsus__pro_description">
                                        <h4>Items Description Details</h4>
                                        <div class="text-secondary mt-3">{!! $items->description !!}</div>
                                    </div>
                                </div>
                                <!-- يمكنك إضافة باقي التابز هنا بنفس النمط -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-5">
                    <div class="wsus__sidebar" id="sticky_sidebar">
                        <div class="wsus__sidebar_licence text-center">
                            <h2 class="mb-3"><span>$</span> {{ $items->price }}</h2>
                            <ul class="feature text-start p-0">
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>
                                    {{ __('Life time access') }}</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>
                                    {{ __('Quality Checked') }}</li>
                            </ul>
                            <ul class="button_area d-flex flex-wrap gap-2 justify-content-center mt-4">
                                <li><a class="btn btn-outline-dark px-4" href="#">Live Preview</a></li>
                                <li><a class="btn btn-main px-4 add-cart" data-id="{{ $items->id }}"  hrefja">Add to Cart</a></li>
                            </ul>
                        </div>

                        <div class="wsus__sidebar_author_info">
                            <h3>Author Profile</h3>
                            <div class="d-flex align-items-center mt-3 gap-3">
                                <img src="{{ asset($items->author->avatar ?? 'defaults/boy.png') }}" alt="author"
                                    style="width:60px; height:60px; border-radius:50%;">
                                <div>
                                    <h4 class="mb-0">{{ $items->author->name }}</h4>
                                    <p class="small text-muted">Member since
                                        {{ $items->author->created_at->format('M Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        const player = new Plyr('#player')
    </script>
@endpush
