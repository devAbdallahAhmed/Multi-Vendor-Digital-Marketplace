@extends('admin.layouts.master')

@section('content')
<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        {{ __('Role Users Management') }}
                    </h2>
                    <div class="text-secondary mt-1">{{ __('Manage your team and their assigned roles') }}</div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="d-flex">
                        <a href="{{ route('admin.role-users.create') }}" class="btn btn-primary shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                            {{ __('Create New User') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="card shadow-sm">
                <div class="card-body border-bottom py-3">
                    <div class="d-flex align-items-center">
                        <div class="text-secondary">
                            Show
                            <div class="mx-2 d-inline-block">
                                <input type="text" class="form-control form-control-sm" value="10" size="3" aria-label="Entries count">
                            </div>
                            entries
                        </div>
                        <div class="ms-auto text-secondary">
                            Search:
                            <div class="ms-2 d-inline-block">
                                <input type="text" class="form-control form-control-sm" aria-label="Search user">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                        <thead>
                            <tr>
                                <th>{{ __('User') }}</th>
                                <th>{{ __('Role') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Created At') }}</th>
                                <th class="text-center">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                            <tr>
                                <td>
                                    <div class="d-flex py-1 align-items-center">
                                        <span class="avatar me-2 rounded-circle bg-primary-lt fw-bold">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </span>
                                        <div class="flex-fill">
                                            <div class="font-weight-medium">{{ $user->name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-outline text-blue fw-bold">
                                        {{ $user->roles->first()->name ?? __('No Role') }}
                                    </span>
                                </td>
                                <td>
                                    <span class="text-secondary">{{ $user->email }}</span>
                                </td>
                                <td>
                                    <span class="text-muted">{{ $user->created_at->format('d M, Y') }}</span>
                                </td>
                                <td>
                                <div class="d-flex justify-content-center gap-2">


                                @if ($user->roles->first()->name != 'super admin')
                                {{-- Edit Button --}}
                                <a href="{{ route('admin.role-users.edit', $user->id) }}"
                                class="btn btn-icon btn-ghost-primary btn rounded-2"
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="{{ ('Edit User') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit-character" width="35px" height="35px" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M14 6l7 7l-4 4"></path>
                                        <path d="M5.828 18.172a2.828 2.828 0 0 0 4 0l10.5 -10.5a2.828 2.828 0 0 0 -4 -4l-10.5 10.5a2.828 2.828 0 0 0 0 4z"></path>
                                        <path d="M4 20l.5 -1.5"></path>
                                    </svg>
                                </a>

                                {{-- Delete Button --}}
                                <form action="{{ route('admin.role-users.destroy', $user->id) }}" method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-icon btn-ghost-danger btn rounded-2"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            title="{{ ('Delete User') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="35px" height="35px" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M4 7l16 0"></path>
                                            <path d="M10 11l0 6"></path>
                                            <path d="M14 11l0 6"></path>
                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                        </svg>
                                    </button>
                                </form>
                                  @endif
                                </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <div class="text-muted">{{ __('No users found in the system.') }}</div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex align-items-center">
                    <p class="m-0 text-secondary">Showing <span>{{ $users->firstItem() ?? 0 }}</span> to <span>{{ $users->lastItem() ?? 0 }}</span> of <span>{{ $users->total() }}</span> entries</p>
                    <div class="ms-auto">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
