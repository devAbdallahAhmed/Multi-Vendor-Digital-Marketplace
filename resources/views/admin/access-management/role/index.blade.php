@extends('admin.layouts.master')

@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            {{ __('Roles & Permissions') }}
                        </h2>
                        <div class="text-secondary mt-1">{{ __('Manage user roles and their access levels') }}</div>
                    </div>
                    <div class="col-auto ms-auto d-print-none">
                        <div class="d-flex">
                            <a href="{{ route('admin.roles.create') }}" class="btn btn-primary shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M12 5l0 14"></path>
                                    <path d="M5 12l14 0"></path>
                                </svg>
                                {{ __('Create New Role') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
           <div class="row row-cards">
    @forelse($roles as $role)
        <div class="col-md-6 col-lg-4">
            <div class="card d-flex flex-column shadow-sm border-0 rounded-3 overflow-hidden hover-shadow"
                 style="transition: all 0.3s ease; background: #ffffff; min-height: 200px;">

                <div class="card-status-start bg-primary"></div>

                <div class="card-body p-3 d-flex flex-column">
                    <!-- Header: Avatar + Title -->
                    <div class="d-flex align-items-center mb-3">
                        <span class="avatar avatar-sm rounded-2 bg-primary-lt fw-bold text-primary shadow-none">
                            {{ strtoupper(substr($role->name, 0, 2)) }}
                        </span>
                        <div class="ms-3">
                            <h4 class="m-0 fw-bold text-dark" style="font-size: 0.95rem;">
                                {{ ucwords($role->name) }}
                            </h4>
                            <small class="text-muted" style="font-size: 0.7rem;">
                                @if($role->name == 'super admin')
                                    <span class="text-blue"><i class="ti ti-crown me-1"></i>Full Control</span>
                                @else
                                    <i class="ti ti-shield me-1"></i>{{ $role->permissions->count() }} Permissions
                                @endif
                            </small>
                        </div>
                    </div>

                    <!-- Permissions Tags -->
                    <div class="flex-grow-1 mb-3">
                        <div class="d-flex flex-wrap gap-1">
                            @forelse ($role->permissions->take(4) as $permission)
                                <span class="badge badge-outline text-secondary fw-medium px-2 py-1"
                                      style="font-size: 10px; border-color: #eee; background: #fafafa; color: #666 !important;">
                                    {{ str_replace('_', ' ', $permission->name) }}
                                </span>
                            @empty
                                <span class="text-muted small italic" style="font-size: 11px;">No specific permissions</span>
                            @endforelse

                            @if ($role->permissions->count() > 4)
                                <span class="badge bg-light text-primary fw-bold" style="font-size: 10px;">
                                    +{{ $role->permissions->count() - 4 }} More
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Footer: Date + Actions (Edit/Delete) -->
                    <div class="d-flex align-items-center justify-content-between pt-3 border-top border-light">
                        <div class="text-muted" style="font-size: 11px;">
                            <i class="ti ti-calendar-event me-1"></i>{{ $role->created_at->format('d M Y') }}
                        </div>

                        <div class="d-flex gap-2">
                            @if ($role->name != 'super admin')
                                {{-- Edit Button --}}
                                <a href="{{ route('admin.roles.edit', $role->id) }}"
                                   class="btn btn-icon btn-sm btn-ghost-primary rounded-2"
                                   style="width: 32px; height: 32px;"
                                   data-bs-toggle="tooltip" title="Edit Role">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" /><path d="M13.5 6.5l4 4" /></svg>
                                </a>

                                {{-- Delete Button --}}
                                <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" class="m-0 delete-form">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-icon btn-sm btn-ghost-danger rounded-2"
                                            style="width: 32px; height: 32px;"
                                            data-bs-toggle="tooltip" title="Delete Role">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                    </button>
                                </form>
                            @else
                                <span class="badge bg-blue-lt border-0 px-2 py-1" style="font-size: 10px;">
                                    <i class="ti ti-lock me-1"></i>Protected
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="card border-dashed bg-transparent shadow-none py-5">
                <div class="card-body text-center">
                    <h3 class="text-muted fw-bold">No roles available</h3>
                    <a href="{{ route('admin.roles.create') }}" class="btn btn-primary rounded-2 px-4 mt-2">
                        <i class="ti ti-plus me-2"></i>Create New Role
                    </a>
                </div>
            </div>
        </div>
    @endforelse
</div>


            </div>
        </div>
    </div>
@endsection
