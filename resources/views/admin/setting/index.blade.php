@extends('admin.layouts.master')

@section('content')
    <div class="page-wrapper">
        <!-- BEGIN PAGE HEADER -->
        <div class="page-header d-print-none" aria-label="Page header">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">{{ __("Account Settings") }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE HEADER -->
        <!-- BEGIN PAGE BODY -->
        @include('admin.setting.pages.side-setting')
        <!-- END PAGE BODY -->
        <div class="col-12 col-md-9 d-flex flex-column">
            @include('admin.setting.pages.general-setting')
        </div>
    </div>
    </div>
    </div>
    </div>

    </div>
@endsection
