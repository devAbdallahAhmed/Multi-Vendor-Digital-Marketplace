
<section class="premium-categories-section">
    <div class="container">

        <div class="premium-categories-header">
            <h2 class="premium-categories-title">Frequently Used Categories</h2>
            <a href="all-product.html" class="premium-explore-link">
                Explore More
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </a>
        </div>

        <div class="premium-categories-grid">
            @forelse ( $featuredCategories as $category )
            <a href="{{route('products', ['category'=> $category->slug])}}" class="premium-category-card">
                <div class="premium-category-icon">
                    <i class="{{ $category->icon }}"></i>
                </div>
                <h3 class="premium-category-name">{{ $category->name }}</h3>
                <span class="premium-category-qty">{{ $category->items_count }}</span>
            </a>

            @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">

                                <div class="d-flex flex-column align-items-center">

                                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mb-3"
                                        style="width:80px;height:80px;">

                                        <i class="ti ti-folder-off fs-1 text-secondary"></i>

                                    </div>

                                    <h5 class="fw-semibold mb-1">
                                        No Categories Found
                                    </h5>


                                </div>

                            </td>
                        </tr>
            @endforelse



        </div>
    </div>
</section>
