@extends('admin.layouts.master')

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="col-14">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ __(' Edit User') }}</h3>
                            <div class="card-actions">
                                <a href="{{ route('admin.role-users.index') }}" class="btn btn-primary">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-arrow-narrow-left"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M5 12l14 0" /><path d="M5 12l4 4" /><path d="M5 12l4 -4" /></svg>

                                    {{ __('Back') }}
                                </a>
                            </div>
                        </div>
                     <form action="{{ route('admin.role-users.update', $admin->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="card-body">
        <div class="row">

            <div class="col-md-6 mb-3">
                <x-admin.input-text name="name" label="{{ __('Name') }}" placeholder="Enter Full Name"  :value="old('name', $admin->name)" />
            </div>

            <div class="col-md-6 mb-3">
                <x-admin.input-text name="email" type="email" label="{{ __('Email Address') }}" placeholder="admin@example.com"  :value="old('email', $admin->email)" />
            </div>

            <div class="col-md-6 mb-3">
                <x-admin.input-text name="password" type="password" label="{{ __('Password') }}"   />
            </div>

            <div class="col-md-6 mb-3">
                <x-admin.input-text name="password_confirmation" type="password" label="{{ __('Confirm Password') }}"  />
            </div>

            <div class="col-md-12 mb-3">
                <x-admin.input-select name="role_id" label="{{ __('Assign Role') }}" >
       @foreach($roles as $role)
    <option value="{{ $role->id }}" @selected($admin->hasRole($role->name))>
        {{ $role->name }}
    </option>
@endforeach

    </x-admin.input-select>
            </div>

        </div>
    </div>

            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="ti ti-plus me-1"></i> {{ __('Update & Assign') }}
                </button>
            </div>
                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

