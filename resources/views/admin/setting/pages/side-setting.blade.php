 <div class="page-body">
     <div class="container-xl">
         <div class="card">
             <div class="row g-0">
                 <div class="col-12 col-md-3 border-end">
                     <div class="card-body">
                         <h4 class="subheader">Business settings</h4>
                         <div class="list-group list-group-transparent">
                             <a href="{{ route('admin.setting.index') }}"
                                 class="list-group-item list-group-item-action d-flex align-items-center ">{{ __('General Settings') }}</a>
                             <a href="{{ route('admin.commission.setting') }}"
                                 class="list-group-item list-group-item-action d-flex align-items-center ">{{ __('Author Commission Settings') }}</a>

                             <a href="{{ route('admin.logo-setting.index') }}"
                                 class="list-group-item list-group-item-action d-flex align-items-center ">{{ __('Logo Settings') }}</a>

                             <a href="{{ route('admin.smtp-setting.index') }}"
                                 class="list-group-item list-group-item-action d-flex align-items-center ">
                                 {{ __('SMTP Settings') }}
                             </a>
                         </div>

                     </div>
                 </div>
