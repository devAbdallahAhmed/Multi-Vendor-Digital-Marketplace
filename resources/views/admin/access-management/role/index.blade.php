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
                            <div class="card d-flex flex-column shadow-sm border-0">
                                <div class="card-status-start bg-primary"></div>

                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <span class="avatar avatar-md rounded-circle bg-primary-lt fw-bold">
                                            {{ strtoupper(substr($role->name, 0, 2)) }}
                                        </span>
                                        <div class="ms-3">
                                            <h3 class="card-title m-0 fw-bold">{{ $role->name }}</h3>
                                            <div class="text-secondary small">
                                                <i class="ti ti-lock"></i> {{ $role->permissions->count() }}
                                                {{ __('Permissions') }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3" style="min-height: 80px;">
                                        <div class="d-flex flex-wrap gap-1">
                                            @foreach ($role->permissions->take(5) as $permission)
                                                <span class="badge badge-outline text-blue fw-medium">
                                                    {{ str_replace('_', ' ', $permission->name) }}
                                                </span>
                                            @endforeach
                                            @if ($role->permissions->count() > 5)
                                                <span
                                                    class="badge badge-soft-secondary">+{{ $role->permissions->count() - 5 }}
                                                    More</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="text-secondary small mt-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline me-1" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                            <path d="M16 3v4" />
                                            <path d="M8 3v4" />
                                            <path d="M4 11h16" />
                                            <path d="M11 15h1" />
                                            <path d="M12 15v3" />
                                        </svg>
                                        {{ __('Created:') }} {{ $role->created_at->format('M d, Y') }}
                                    </div>
                                </div>

                                <div class="card-footer bg-light-subtle d-flex align-items-center">
                                    {{-- Edit Button --}}
                                    <a href="{{ route('admin.roles.edit', $role->id) }}"
                                        class="btn btn-outline-primary btn-sm flex-fill fw-bold">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4"></path>
                                            <path d="M13.5 6.5l4 4"></path>
                                        </svg>
                                        {{ __('Edit') }}
                                    </a>

                                    {{-- Delete Form --}}
                                    <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST"
                                        class="ms-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm shadow-sm"
                                            onclick="return confirm('{{ __('Are you sure you want to delete this role?') }}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon m-0" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M4 7l16 0"></path>
                                                <path d="M10 11l0 6"></path>
                                                <path d="M14 11l0 6"></path>
                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="card card-md border-dashed">
                                <div class="card-body text-center py-5">
                                    <div class="mb-3">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-lock-off text-muted" width="40"
                                            height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M15 11v-1a3 3 0 0 0 -3 -3m-2.75 1.188a3 3 0 0 0 -0.25 1.812v1" />
                                            <path d="M8 11h-2a2 2 0 0 0 -2 2v5a2 2 0 0 0 2 2h12" />
                                            <path d="M16 16l0 .01" />
                                            <path d="M3 3l18 18" />
                                        </svg>
                                    </div>
                                    <h3>{{ __('No roles found') }}</h3>
                                    <p class="text-secondary">{{ __('You have not created any roles yet.') }}</p>
                                    <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">
                                        {{ __('Add your first role') }}
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
