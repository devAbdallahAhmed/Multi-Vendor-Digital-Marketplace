@extends('frontend.layouts.master')

@section('content')
    <!-- ======================== Breadcrumb Two Section Start ===================== -->
    <section class="breadcrumb border-bottom p-0 d-block section-bg position-relative z-index-1"
        style="background: url({{ asset('assets/front/images/thumbs/breadcrumb_bg.jpg') }});">
        <div class="breadcrumb-two">
            <img src="assets/images/gradients/breadcrumb-gradient-bg.png" alt="" class="bg--gradient">
            <div class="container container-two">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="breadcrumb-two-content text-center">

                            <ul class="breadcrumb-list flx-align gap-2 mb-2 justify-content-center">
                                <li class="breadcrumb-list__item font-14 text-body">
                                    <a href="index.html" class="breadcrumb-list__link text-body hover-text-main">Home</a>
                                </li>
                                <li class="breadcrumb-list__item font-14 text-body">
                                    <span class="breadcrumb-list__icon font-10"><i class="fas fa-chevron-right"></i></span>
                                </li>
                                <li class="breadcrumb-list__item font-14 text-body">
                                    <span class="breadcrumb-list__text">Product details</span>
                                </li>
                            </ul>

                            <h3 class="breadcrumb-two-content__title mb-0 text-capitalize">Product details</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======================== Breadcrumb Two Section End ===================== -->

    <!-- ======================= Product Details Section Start ==================== -->
    <section class="wsus__product_details padding-y-120">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-7 ">
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
                        <ul class="nav nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                    aria-selected="true"><i class="ti ti-layers-intersect"></i> Description</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-profile" type="button" role="tab"
                                    aria-controls="pills-profile" aria-selected="false"><i class="far fa-comments"></i>
                                    Comments (43)</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-contact" type="button" role="tab"
                                    aria-controls="pills-contact" aria-selected="false"><i class="far fa-star"></i>
                                    Review</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                aria-labelledby="pills-home-tab" tabindex="0">
                                <div class="wsus__pro_description">
                                    <h4>Items Description Details</h4>
                                    {!! $items->description !!}
                                </div>

                            </div>
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                aria-labelledby="pills-profile-tab" tabindex="0">
                                <div class="wsus__pro_det_comment">
                                    <h4>Comments All</h4>
                                    <div class="wsus__single_comment">
                                        <div class="comment_footer d-flex flex-wrap">
                                            <div class="img">
                                                <img src="assets/images/thumbs/comment_img_1.png" alt="useer"
                                                    class="img-fluid w-100">
                                            </div>
                                            <div class="text">
                                                <h3>Abdur Rohman</h3>
                                                <p>London,UK</p>
                                            </div>
                                        </div>
                                        <p class="comment_des">Lorem Ipsum is simply dummy text of the printing and
                                            typesetting industry. Lorem Ipsum has been the industry's standard dummy
                                            text ever since the redi 1500s,</p>
                                        <p class="comment_date"> <span class="date"><i class="far fa-calendar-alt"></i>
                                                Octobor
                                                28,2018 At
                                                9.00am </span> <a href="#"><i class="fas fa-reply"></i>Reply</a>
                                        </p>
                                        <div class="wsus__single_comment reply">
                                            <div class="comment_footer d-flex flex-wrap">
                                                <div class="img">
                                                    <img src="assets/images/thumbs/comment_img_3.png" alt="useer"
                                                        class="img-fluid w-100">
                                                </div>
                                                <div class="text">
                                                    <h3>Shinzing Pang</h3>
                                                    <p>London,UK</p>
                                                </div>
                                            </div>
                                            <p class="comment_des">Lorem Ipsum is simply dummy text of the printing and
                                                typesetting industry. Lorem Ipsum has been the industry's standard dummy
                                                text ever since the redi 1500s,</p>
                                            <p class="comment_date"> <span class="date"><i
                                                        class="far fa-calendar-alt"></i>
                                                    Octobor
                                                    28,2018 At
                                                    9.00am </span> <a href="#"><i class="fas fa-reply"></i>
                                                    Reply</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="wsus__single_comment">
                                        <div class="comment_footer d-flex flex-wrap">
                                            <div class="img">
                                                <img src="assets/images/thumbs/comment_img_2.png" alt="useer"
                                                    class="img-fluid w-100">
                                            </div>
                                            <div class="text">
                                                <h3>Gurtokh Jhon</h3>
                                                <p>London,UK</p>
                                            </div>
                                        </div>
                                        <p class="comment_des">Lorem Ipsum is simply dummy text of the printing and
                                            typesetting industry. Lorem Ipsum has been the industry's standard dummy
                                            text ever since the redi 1500s,</p>
                                        <p class="comment_date"> <span class="date"><i class="far fa-calendar-alt"></i>
                                                Octobor
                                                28,2018 At
                                                9.00am </span> <a href="#"><i class="fas fa-reply"></i>
                                                Reply</a>
                                        </p>
                                    </div>
                                    <div class="wsus__single_comment">
                                        <div class="comment_footer d-flex flex-wrap">
                                            <div class="img">
                                                <img src="assets/images/thumbs/comment_img_1.png" alt="useer"
                                                    class="img-fluid w-100">
                                            </div>
                                            <div class="text">
                                                <h3>noyon bond</h3>
                                                <p>London,UK</p>
                                            </div>
                                        </div>
                                        <p class="comment_des">Lorem Ipsum is simply dummy text of the printing and
                                            typesetting industry. Lorem Ipsum has been the industry's standard dummy
                                            text ever since the redi 1500s,</p>
                                        <p class="comment_date"> <span class="date"><i class="far fa-calendar-alt"></i>
                                                Octobor
                                                28,2018 At
                                                9.00am </span> <a href="#"><i class="fas fa-reply"></i>
                                                Reply</a>
                                        </p>
                                    </div>
                                </div>

                                <nav aria-label="Page navigation example">
                                    <ul class="pagination common-pagination mt-0">
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                                        <li class="page-item">
                                            <a class="page-link flx-align gap-2 flex-nowrap" href="#">Next
                                                <span class="icon line-height-1 font-20"><i
                                                        class="las la-arrow-right"></i></span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>

                                <form class="wsus__comment_input_area">
                                    <h3>Leave a Comment</h3>
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="wsus__comment_single_input">
                                                <fieldset>
                                                    <legend>name*</legend>
                                                    <input type="text" placeholder="Name">
                                                </fieldset>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="wsus__comment_single_input">
                                                <fieldset>
                                                    <legend>email*</legend>
                                                    <input type="email" placeholder="Email">
                                                </fieldset>
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="wsus__comment_single_input">
                                                <fieldset>
                                                    <legend>message*</legend>
                                                    <textarea rows="7" placeholder="Type here.."></textarea>
                                                </fieldset>
                                            </div>
                                            <button class="btn btn-main btn-lg" type="submit">Submit Comment</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                aria-labelledby="pills-contact-tab" tabindex="0">
                                <div class="wsus__pro_det_review">
                                    <h3>Reviews</h3>
                                    <div class="wsus__single_comment">
                                        <div class="comment_footer d-flex flex-wrap">
                                            <div class="img">
                                                <img src="assets/images/thumbs/comment_img_1.png" alt="useer"
                                                    class="img-fluid w-100">
                                            </div>
                                            <div class="text">
                                                <h3>Abdur Rohman
                                                    <span>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </span>
                                                </h3>
                                                <p>London,UK</p>
                                            </div>
                                        </div>
                                        <p class="comment_des">Lorem Ipsum is simply dummy text of the printing and
                                            typesetting industry. Lorem Ipsum has been the industry's standard dummy
                                            text ever since the redi 1500s,</p>
                                        <p class="comment_date"> <span class="date"><i class="far fa-calendar-alt"></i>
                                                Octobor
                                                28,2018 At
                                                9.00am </span> <a href="#"><i class="fas fa-reply"></i> Reply</a>
                                        </p>
                                        <div class="wsus__single_comment reply">
                                            <div class="comment_footer d-flex flex-wrap">
                                                <div class="img">
                                                    <img src="assets/images/thumbs/comment_img_2.png" alt="useer"
                                                        class="img-fluid w-100">
                                                </div>
                                                <div class="text">
                                                    <h3>Shinzing Pang
                                                        <span>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                        </span>
                                                    </h3>
                                                    <p>London,UK</p>
                                                </div>
                                            </div>
                                            <p class="comment_des">Lorem Ipsum is simply dummy text of the printing and
                                                typesetting industry. Lorem Ipsum has been the industry's standard dummy
                                                text ever since the redi 1500s,</p>
                                            <p class="comment_date"> <span class="date"><i
                                                        class="far fa-calendar-alt"></i>
                                                    Octobor
                                                    28,2018 At
                                                    9.00am </span> <a href="#"><i class="fas fa-reply"></i>
                                                    Reply</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="wsus__single_comment">
                                        <div class="comment_footer d-flex flex-wrap">
                                            <div class="img">
                                                <img src="assets/images/thumbs/comment_img_3.png" alt="useer"
                                                    class="img-fluid w-100">
                                            </div>
                                            <div class="text">
                                                <h3>Gurtokh Jhon
                                                    <span>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </span>
                                                </h3>
                                                <p>London,UK</p>
                                            </div>
                                        </div>
                                        <p class="comment_des">Lorem Ipsum is simply dummy text of the printing and
                                            typesetting industry. Lorem Ipsum has been the industry's standard dummy
                                            text ever since the redi 1500s,</p>
                                        <p class="comment_date"> <span class="date"><i class="far fa-calendar-alt"></i>
                                                Octobor
                                                28,2018 At
                                                9.00am </span> <a href="#"><i class="fas fa-reply"></i>
                                                Reply</a>
                                        </p>
                                    </div>
                                    <div class="wsus__single_comment">
                                        <div class="comment_footer d-flex flex-wrap">
                                            <div class="img">
                                                <img src="assets/images/thumbs/comment_img_1.png" alt="useer"
                                                    class="img-fluid w-100">
                                            </div>
                                            <div class="text">
                                                <h3>noyon bond
                                                    <span>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </span>
                                                </h3>
                                                <p>London,UK</p>
                                            </div>
                                        </div>
                                        <p class="comment_des">Lorem Ipsum is simply dummy text of the printing and
                                            typesetting industry. Lorem Ipsum has been the industry's standard dummy
                                            text ever since the redi 1500s,</p>
                                        <p class="comment_date"> <span class="date"><i class="far fa-calendar-alt"></i>
                                                Octobor
                                                28,2018 At
                                                9.00am </span> <a href="#"><i class="fas fa-reply"></i>
                                                Reply</a>
                                        </p>
                                    </div>
                                </div>

                                <nav aria-label="Page navigation example">
                                    <ul class="pagination common-pagination mt-0">
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                                        <li class="page-item">
                                            <a class="page-link flx-align gap-2 flex-nowrap" href="#">Next
                                                <span class="icon line-height-1 font-20"><i
                                                        class="las la-arrow-right"></i></span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>

                                <form class="wsus__comment_input_area">
                                    <h3>Write Your Reviews</h3>
                                    <p>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <span>(0.0)</span>
                                    </p>
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="wsus__comment_single_input">
                                                <fieldset>
                                                    <legend>name*</legend>
                                                    <input type="text" placeholder="Name">
                                                </fieldset>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="wsus__comment_single_input">
                                                <fieldset>
                                                    <legend>email*</legend>
                                                    <input type="email" placeholder="Email">
                                                </fieldset>
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="wsus__comment_single_input">
                                                <fieldset>
                                                    <legend>message*</legend>
                                                    <textarea rows="7" placeholder="Type here.."></textarea>
                                                </fieldset>
                                            </div>
                                            <button class="btn btn-main btn-lg" type="submit">Submit Review</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="wsus__sidebar pl_30 xs_pl_0" id="sticky_sidebar">
                        <div class="wsus__sidebar_licence">

                            <h2><span>$</span> 56</h2>
                            <ul class="feature">
                                <li>{{ __('Life time access') }}</li>
                                <li>{{ __('Quality Checked by ') }} {{ config('settings.site_name') }}</li>
                                @if ($items->is_supported)
                                    <li>{{ __('Support available') }}</li>
                                @endif
                            </ul>
                            <ul class="button_area d-flex flex-wrap">
                                <li><a class="live" href="#">Live Proview</a></li>
                                <li><a class="add_cart" href="#">add to cart</a></li>
                            </ul>
                            <ul class="sell_rating mt_20 d-flex flex-wrap justify-content-between">
                                <li><i class="fas fa-shopping-basket"></i> 8541</li>
                                <li><i class="far fa-comments"></i> 45</li>
                                <li><i class="far fa-star"></i> 29</li>
                            </ul>
                        </div>

                        <div class="wsus__sidebar_author_info mt-4">
                            <h3>Auther Profile</h3>
                            <div class="wsus__sidebar_author_text">
                                <div class="img">
                                    <img src="{{ asset($items->author->avatar ?? 'defaults/boy.png') }}" alt="author"
                                        class="img-fluid w-100">
                                </div>
                                <div class="text">
                                    <h4>{{ $items->author->name }}</h4>
                                    <p>Member since: {{ $items->author->created_at->format('M Y') }}</p>
                                    <p>Total Approved Products:
                                        {{ statusCount() }}</p>
                                </div>

                            </div>
                            <ul class="d-flex flex-wrap justify-content-center">
                                <li>
                                    <h4> {{ statusCount() }}</h4>
                                    <p>products</p>
                                </li>
                                <li>
                                    <h4>255</h4>
                                    <p>sales</p>
                                </li>
                            </ul>
                            <button class="btn btn-main btn-lg"><i class="fal fa-stars"></i> Level 3</button>
                        </div>

                        <div class="wsus__sidebar_pro_info mt-4">
                            <h3>product Info</h3>
                            <ul>
                                <li><span>Relesaed</span> {{ formatDate($items->created_at) }}</li>
                                <li><span>Updated</span> {{ formatDate($items->updated_at) }}</li>
                                @if ($items->is_main_file_external === 1)
                                    <li><span>Source</span>URL</li>
                                @else
                                    <li><span>File Type</span> {{ explode('.', $items->main_file)[1] }}</li>
                                @endif
                                <li><span>High Resolution</span> YES</li>
                                <li><span>Cross browser</span> Compatibility</li>
                                <li><span>Documentation</span> Documented</li>
                                <li><span>Layout</span> Responsive</li>
                                <li><span>File Size</span>{{ getFileSize($items->main_file) }}</li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======================= Product Details Section End ==================== -->
@endsection
@push('scripts')
    <script>
        const player = new Plyr('#player')
    </script>
@endpush
