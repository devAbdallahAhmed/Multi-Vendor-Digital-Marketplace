@push('styles')
    <style>
        .star-rating input[type="radio"] {
            display: none !important;
        }

        .star-rating label {
            cursor: pointer;
            font-size: 26px;
            padding: 0 3px;
            margin: 0;
            line-height: 1;
        }

        .star-rating .solid-star {
            display: none;
            color: #e59819;
        }

        .star-rating .empty-star {
            display: inline-block;
            color: #d1d5db;
        }

        .star-rating label:hover .solid-star,
        .star-rating label:hover~label .solid-star,
        .star-rating input[type="radio"]:checked~label .solid-star {
            display: inline-block;
        }

        .star-rating label:hover .empty-star,
        .star-rating label:hover~label .empty-star,
        .star-rating input[type="radio"]:checked~label .empty-star {
            display: none;
        }
    </style>
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
                                    <img src="{{ asset($items->preview_image ?? $items->main_file) }}" alt="product"
                                        class="img-fluid w-100">
                                @elseif ($items->preview_type === 'video')
                                    <video id="player" playsinline controls class="w-100">
                                        <source src="{{ asset($items->preview_video ?? $items->main_file) }}"
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
                                            data-bs-target="#pills-home" type="button" role="tab"
                                            aria-controls="pills-home" aria-selected="true">
                                            <i class="ti ti-layers-intersect"></i> {{ __('Description') }}
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-profile" type="button" role="tab"
                                            aria-controls="pills-profile" aria-selected="false">
                                            <i class="far fa-comments"></i> {{ __('Comments') }} ({{ count($comments) }})
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-contact" type="button" role="tab"
                                            aria-controls="pills-contact" aria-selected="false">
                                            <i class="far fa-star"></i> {{ __('Review') }}
                                        </button>
                                    </li>
                                </ul>

                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-home">
                                        <div class="wsus__pro_description">
                                            <h4>{{ __('Item Description Details') }}</h4>
                                            <div class="text-secondary mt-3">{!! $items->description !!}</div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                        aria-labelledby="pills-profile-tab" tabindex="0">
                                        <div class="wsus__pro_det_comment">
                                            <h4>{{ __('Comments All') }}</h4>

                                            @forelse ($comments as $comment)
                                                <div class="wsus__single_comment">
                                                    <div class="comment_footer d-flex align-items-center mb-3 gap-3">
                                                        <div class="img">
                                                            <img src="{{ asset($comment->user->avatar ?? 'defaults/boy.png') }}"
                                                                alt="user avatar" class="shadow-sm"
                                                                style="width:60px; height:60px; border-radius:50%; object-fit: cover;">
                                                        </div>
                                                        <div class="text">
                                                            <h5 class="mb-1 fw-bold">{{ $comment->user->name }}</h5>

                                                            @if ($comment->user->city || $comment->user->country)
                                                                <div
                                                                    class="text-muted small mt-1 d-inline-flex align-items-center gap-1">
                                                                    <i class="fas fa-map-marker-alt"></i>
                                                                    <span>{{ collect([$comment->user->city, $comment->user->country])->filter()->implode(', ') }}</span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <p class=" text-bold comment_des">{{ $comment->body }}</p>
                                                    <p class="comment_date">
                                                        <span class="date">
                                                            <i class="far fa-calendar-alt"></i>
                                                            {{ $comment->created_at->format('M d, Y') }}
                                                        </span>
                                                        <a href="javascript:void(0);"><i class="fas fa-reply"></i>
                                                            {{ __('Reply') }}</a>
                                                    </p>
                                                </div>
                                            @empty
                                                <h4 class="text-muted">{{ __('No Comments Yet') }}</h4>
                                            @endforelse
                                        </div>

                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination common-pagination mt-0">
                                                {{ $comments->links() }}
                                            </ul>
                                        </nav>

                                        @auth
                                            <form action="{{ route('item-comment.store', $items->id) }}" method="POST">
                                                @csrf
                                                <div class="col-xl-12 mt-4">
                                                    <div class="wsus__comment_single_input">
                                                        <fieldset>
                                                            <x-frontend.textarea placeholder="Type here.." name="message"
                                                                label="{{ __('Message') }} *" />
                                                        </fieldset>
                                                    </div>
                                                    <button class="btn btn-main btn-lg mt-3" type="submit">
                                                        {{ __('Submit Comment') }}
                                                    </button>
                                                </div>
                                            </form>
                                        @endauth

                                        @guest
                                            <div class="alert alert-info mt-4 text-center">
                                                {{ __('Please login to submit a comment.') }}
                                            </div>
                                        @endguest
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-5">
                        <div class="wsus__sidebar" id="sticky_sidebar">

                            <!-- Product Price & Action Card -->
                            <div class="card border-0 shadow-sm rounded-4 mb-4">
                                <div class="card-body p-4">
                                    <div class="price-box text-center mb-4">
                                        @if (isset($items->discount_price) && $items->discount_price > 0)
                                            <h2 class="fw-bold mb-0 text-primary">
                                                {{ currencyPosition($items->discount_price) }}
                                                <span
                                                    class="text-muted text-decoration-line-through fs-6 ms-2">{{ currencyPosition($items->price) }}</span>
                                            </h2>
                                        @else
                                            <h2 class="fw-bold mb-0 text-primary">{{ currencyPosition($items->price) }}</h2>
                                        @endif
                                    </div>

                                    <div class="d-grid gap-2 mb-4">
                                        <a class="btn btn-main btn-lg add-cart fw-bold d-flex justify-content-center align-items-center gap-2"
                                            data-id="{{ $items->id }}" href="javascript:void(0);">
                                            <i class="fas fa-shopping-cart"></i> {{ __('Add to Cart') }}
                                        </a>

                                        @if ($items->demo_link)
                                            <a class="btn btn-outline-dark btn-lg fw-bold d-flex justify-content-center align-items-center gap-2"
                                                href="{{ $items->demo_link }}" target="_blank">
                                                <i class="fas fa-external-link-alt"></i> {{ __('Live Preview') }}
                                            </a>
                                        @endif
                                    </div>

                                    <ul class="list-group list-group-flush small">
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center px-0 text-muted">
                                            <span><i class="fas fa-shopping-basket me-2"></i> {{ __('Total Sales') }}</span>
                                            <span class="fw-bold text-dark">{{ $items->sales_count ?? 0 }}</span>
                                        </li>
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center px-0 text-muted">
                                            <span><i class="fas fa-comments me-2"></i> {{ __('Comments') }}</span>
                                            <span class="fw-bold text-dark">{{ $items->comments_count ?? 0 }}</span>
                                        </li>
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center px-0 text-muted">
                                            <span><i class="fas fa-star me-2 text-warning"></i> {{ __('Reviews') }}</span>
                                            <span class="fw-bold text-dark">{{ $items->reviews_count ?? 0 }}</span>
                                        </li>
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center px-0 text-muted">
                                            <span><i class="fas fa-folder-open me-2"></i> {{ __('Category') }}</span>
                                            <span
                                                class="fw-bold text-dark">{{ $items->category->name ?? __('General') }}</span>
                                        </li>
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center px-0 text-muted">
                                            <span><i class="fas fa-sync-alt me-2"></i> {{ __('Last Update') }}</span>
                                            <span class="fw-bold text-dark">{{ $items->updated_at->format('d M, Y') }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Author Profile Card -->
                            <div class="card border-0 shadow-sm rounded-4">
                                <div class="card-body p-4">
                                    <h5 class="fw-bold mb-4 border-bottom pb-3">{{ __('Author Profile') }}</h5>

                                    <div class="d-flex align-items-center mb-4">
                                        <img src="{{ asset($items->author->avatar ?? 'defaults/boy.png') }}" alt="author"
                                            class="shadow-sm"
                                            style="width:70px; height:70px; border-radius:50%; object-fit: cover;">
                                        <div class="ms-3">
                                            <h5 class="mb-1 fw-bold">{{ $items->author->name }}</h5>
                                            <p class="small text-muted mb-0">
                                                <i class="fas fa-calendar-alt me-1"></i> {{ __('Member since') }}
                                                {{ $items->author->created_at->format('M Y') }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="d-grid">
                                        <a href="#" class="btn btn-outline-secondary fw-bold">
                                            <i class="fas fa-user me-1"></i> {{ __('View Portfolio') }}
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab"
                        tabindex="0">
                        <div class="wsus__pro_det_review">
                            <h3>Reviews</h3>
                            @forelse ($reviews as $review)
                                <div class="wsus__single_comment">
                                    <div class="comment_footer d-flex flex-wrap">
                                        <div class="img">
                                            <img src="{{ asset($review->user->avatar ?? 'defaults/boy.png') }}"
                                                alt="user" class="img-fluid w-100 h-100">
                                        </div>
                                        <div class="text">
                                            <h3>{{ $review->user->name }}
                                                <span class="text-warning ms-2">
                                                    @for ($i = 1; $i <= $review->stars; $i++)
                                                        <i class="fas fa-star"></i>
                                                    @endfor
                                                    @for ($i = $review->stars + 1; $i <= 5; $i++)
                                                        <i class="far fa-star"></i>
                                                    @endfor
                                                </span>
                                            </h3>
                                            @if ($review->user->city || $review->user->country)
                                                <div class="text-muted small mt-1 d-inline-flex align-items-center gap-1">
                                                    <i class="fas fa-map-marker-alt"></i>
                                                    <span>{{ collect([$review->user->city, $review->user->country])->filter()->implode(', ') }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        <p class="comment_des w-100 mt-3">{{ $review->body }}</p>
                                        <p class="comment_date w-100">
                                            <span class="date">
                                                <i class="far fa-calendar-alt"></i>
                                                {{ $review->created_at->format('M d, Y \A\t h:i a') }}
                                            </span>
                                            <a href="#"><i class="fas fa-reply"></i> {{ __('Reply') }}</a>
                                        </p>
                                    </div>
                                </div>
                            @empty
                                <h4 class="text-muted">{{ __('No Reviews Yet') }}</h4>
                            @endforelse
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
                                        <span class="icon line-height-1 font-20"><i class="las la-arrow-right"></i></span>
                                    </a>
                                </li>
                            </ul>
                        </nav>

                        @auth
                            <form action="{{ route('item-review.store', $items->id) }}" method="POST"
                                class="wsus__comment_input_area mt-5">
                                @csrf

                                <h3 class="mb-3">{{ __('Write Your Review') }}</h3>

                                <div class="rating-wrapper mb-4">
                                    <label class="fw-bold mb-2">{{ __('Select Rating') }} *</label>

                                    <div class="star-rating d-inline-flex flex-row-reverse align-items-center">
                                        @for ($i = 5; $i >= 1; $i--)
                                            <input type="radio" id="star{{ $i }}" name="rating"
                                                value="{{ $i }}" {{ old('rating') == $i ? 'checked' : '' }}
                                                {{ $i == 5 ? 'required' : '' }} />
                                            <label for="star{{ $i }}" title="{{ $i }}">
                                                <i class="far fa-star empty-star"></i>
                                                <i class="fas fa-star solid-star"></i>
                                            </label>
                                        @endfor
                                    </div>

                                    @error('rating')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="wsus__comment_single_input mb-3">
                                            <fieldset>
                                                <x-frontend.textarea placeholder="{{ __('Type your review here..') }}"
                                                    name="review" label="{{ __('Message') }} *" />
                                            </fieldset>
                                        </div>

                                        <button class="btn btn-main btn-lg" type="submit">{{ __('Submit Review') }}</button>
                                    </div>
                                </div>
                            </form>
                        @else
                            <div class="alert alert-info mt-5 text-center">
                                {{ __('Please login to submit a review.') }}
                                <a href="{{ route('login') }}" class="fw-bold text-decoration-underline">{{ __('Login') }}</a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </section>
    @endsection

    @push('scripts')
        <script>
            const player = new Plyr('#player');
        </script>
    @endpush
