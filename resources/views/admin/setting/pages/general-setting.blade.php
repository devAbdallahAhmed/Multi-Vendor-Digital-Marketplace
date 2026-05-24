<div class="card shadow-sm border-0 rounded-3">

    {{-- Header --}}
    <div class="card-header bg-white border-bottom py-3 px-4">

        <div class="d-flex align-items-center">

            <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                style="width:45px; height:45px; background: rgba(13,110,253,.1);">

                <i class="bi bi-gear-fill text-primary fs-5"></i>

            </div>

            <div>

                <h3 class="card-title mb-0 fw-bold">
                    {{ __('General Settings') }}
                </h3>

                <small class="text-muted">
                    {{ __('Manage your platform basic configuration') }}
                </small>

            </div>

        </div>

    </div>

    {{-- Form --}}
    <form action="{{ route('admin.general.setting.update') }}" method="POST">

        @csrf
        @method('PUT')

        <div class="card-body p-4">

            <div class="row g-4">

                {{-- Site Name --}}
                <div class="col-md-6">

                    <div class="border rounded-3 p-3 bg-light">

                        <x-admin.input-text name="site_name" label="{{ __('Site Name') }}"
                            value="{{ config('settings.site_name') }}" placeholder="e.g. My Digital Market" />

                        <small class="text-muted d-block mt-2">
                            {{ __('This name will appear across the marketplace.') }}
                        </small>

                    </div>

                </div>

                {{-- Site Email --}}
                <div class="col-md-6">

                    <div class="border rounded-3 p-3 bg-light">

                        <x-admin.input-text name="site_email" label="{{ __('Site Email') }}"
                            value="{{ config('settings.site_email') }}" placeholder="e.g. support@example.com" />

                        <small class="text-muted d-block mt-2">
                            {{ __('Primary email for notifications and support.') }}
                        </small>

                    </div>

                </div>

            </div>

        </div>

        {{-- Footer --}}
        <div class="card-footer bg-white border-top px-4 py-3">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                <div class="text-muted small">

                    <i class="bi bi-shield-lock me-1"></i>

                    {{ __('Only administrators can update these settings.') }}

                </div>

                <div class="d-flex align-items-center gap-2">

                    <a href="{{ url()->previous() }}" class="btn btn-light border rounded-3 px-4">

                        {{ __('Cancel') }}

                    </a>

                    <button type="submit" class="btn btn-primary rounded-3 px-4">

                        <i class="bi bi-check-circle me-1"></i>

                        {{ __('Save Settings') }}

                    </button>

                </div>

            </div>

        </div>

    </form>

</div>
