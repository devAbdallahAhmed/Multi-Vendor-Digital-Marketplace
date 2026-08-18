@if ($bannerSection)
    <section class="seller padding-y-120">
        <div class="container container-two">
            <div class="row gy-4">

                <div class="col-lg-6">
                    <div class="seller-item position-relative z-index-1"
                        style="background: url('{{ asset($bannerSection->banner_image_1 ?? 'assets/images/thumbs/seller-bg.png') }}');">
                        <h3 class="seller-item__title">{{ $bannerSection->banner_title_1 }}</h3>
                        <p class="seller-item__desc fw-500 text-heading">{{ $bannerSection->banner_subtitle_1 }}</p>

                        @if ($bannerSection->button_text_1)
                            <a href="{{ url($bannerSection->button_url_1 ?? '#') }}"
                                class="btn btn-static-outline-black fw-600">
                                {{ $bannerSection->button_text_1 }}
                            </a>
                        @endif
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="seller-item bg-two position-relative z-index-1"
                        style="background: url('{{ asset($bannerSection->banner_image_2 ?? 'assets/images/thumbs/seller-bg-two.png') }}');">
                        <h3 class="seller-item__title">{{ $bannerSection->banner_title_2 }}</h3>
                        <p class="seller-item__desc fw-500 text-heading">{{ $bannerSection->banner_subtitle_2 }}</p>

                        @if ($bannerSection->button_text_2)
                            <a href="{{ url($bannerSection->button_url_2 ?? '#') }}"
                                class="btn btn-static-outline-black fw-600">
                                {{ $bannerSection->button_text_2 }}
                            </a>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </section>
@endif
