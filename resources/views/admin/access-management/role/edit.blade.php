@extends('admin.layouts.master')

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="col-12">
                    <form action="{{ route('admin.roles.update', $role->id) }}" method="POST" class="card">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h3 class="card-title">{{ __('Edit Role') }}</h3>
                            <div class="card-actions">
                                <a href="{{ route('admin.roles.index') }}" class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icon-tabler-arrow-narrow-left">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M5 12l14 0" />
                                        <path d="M5 12l4 4" />
                                        <path d="M5 12l4 -4" />
                                    </svg>
                                    {{ __('Back') }}
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12 mb-4">
                                <x-admin.input-text type="text" :placeholder="__('Role Name')" name="name" :label="__('Role Name')"
                                    value="{{ old('name', $role->name) }}" />


                                <hr>
                                <h4 class="mb-3">{{ __('Permissions') }}</h4>

                                <div class="row">
                                    @foreach ($permissions as $groupName => $groupPermissions)
                                        <div class="col-md-12 mb-4">
                                            <div class="card card-sm border">
                                                <div class="card-header bg-light">
                                                    <label class="form-check form-check-inline mb-0">
                                                        <input class="form-check-input group-checkbox" type="checkbox">
                                                        <span class="form-check-label fw-bold text-uppercase">
                                                            {{ str_replace('_', ' ', $groupName) }}
                                                        </span>
                                                    </label>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        @foreach ($groupPermissions as $permission)
                                                            <div class="col-md-3 mb-2">
                                                                <label class="form-check">
                                                                    <input class="form-check-input permission-checkbox"
                                                                        type="checkbox" name="permissions[]"
                                                                        value="{{ $permission->name }}"
                                                                        @checked($role->hasPermissionTo($permission->name))>
                                                                    <span
                                                                        class="form-check-label">{{ $permission->name }}</span>
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" onclick="" class="btn btn-success fw-bold">
                                    {{ __('Update Role') }}
                                </button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.querySelectorAll('.group-checkbox').forEach(function(groupCheckbox) {
                groupCheckbox.addEventListener('change', function() {
                    let container = this.closest('.card').querySelector('.card-body');
                    let checkboxes = container.querySelectorAll('.permission-checkbox');
                    checkboxes.forEach(cb => cb.checked = this.checked);
                });
            });

            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.card.border').forEach(function(groupCard) {
                    let checkboxes = groupCard.querySelectorAll('.permission-checkbox');
                    let groupCheckbox = groupCard.querySelector('.group-checkbox');

                    let allChecked = Array.from(checkboxes).every(cb => cb.checked);
                    if (checkboxes.length > 0) {
                        groupCheckbox.checked = allChecked;
                    }
                });
            });
        </script>
    @endpush
@endsection
