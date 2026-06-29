  <div class="card-body p-4">
                                <div class="mb-4">
                                    <h5 class="fw-semibold text-dark mb-1">{{ __('Product Information') }}</h5>
                                    <div style="width: 40px; height: 3px; background-color: #20c997; border-radius: 2px;">
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-12 d-flex justify-content-between align-items-center">
                                        <span class="fw-bold text-secondary">{{ __('Asset ID') }}</span>
                                        <span class="text-muted">#{{ $item->id }}</span>
                                    </div>

                                    <div class="col-12 d-flex justify-content-between align-items-center">
                                        <span class="fw-bold text-secondary">{{ __('Status') }}</span>
                                        <div>
                                            @if ($item->status === 'active' || $item->status === 'approved')
                                                <span class="badge bg-success text-white">{{ __('Approved') }}</span>
                                            @elseif($item->status === 'pending')
                                                <span class="badge bg-warning text-dark">{{ __('Pending') }}</span>
                                            @elseif($item->status === 'soft_reject')
                                                <span class="badge bg-info text-white">{{ __('Soft Reject') }}</span>
                                            @elseif($item->status === 'rejected')
                                                <span class="badge bg-danger text-white">{{ __('Rejected') }}</span>
                                            @elseif($item->status === 'resubmitted')
                                                <span class="badge bg-primary text-white">{{ __('Resubmitted') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr class="my-2 text-muted">
                                    </div>

                                    <div class="col-12">
                                        <p class="mb-1 fw-bold text-secondary">{{ __('Product Name') }}</p>
                                        <span class="text-dark fw-medium d-block text-truncate"
                                            title="{{ $item->name }}">{{ $item->name }}</span>
                                    </div>

                                    <div class="col-12">
                                        <p class="mb-1 fw-bold text-secondary">{{ __('Category') }}</p>
                                        <span class="text-muted small">
                                            {{ $item->category->name }} <i class="ti ti-chevron-right mx-1"></i>
                                            {{ $item->sub_category->name }}
                                        </span>
                                    </div>

                                    <div class="col-12">
                                        <p class="mb-1 fw-bold text-secondary">{{ __('Publish Date') }}</p>
                                        <span class="text-muted">{{ $item->created_at->format('M d, Y - H:i A') }}</span>
                                    </div>

                                    <div class="col-12">
                                        <hr class="my-2 text-muted">
                                    </div>

                                    <div class="col-12">
                                        <a href="{{ route('user.items.download', $item->id) }}"
                                            class="btn btn-primary w-100 d-flex align-items-center justify-content-center gap-2 py-2"
                                            style="border-radius: 8px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v2" />
                                                <path d="M7 11l5 5l5 -5" />
                                                <path d="M12 4l0 12" />
                                            </svg>
                                            {{ __('Download Source') }}
                                        </a>
                                    </div>
                                </div>
                            </div>