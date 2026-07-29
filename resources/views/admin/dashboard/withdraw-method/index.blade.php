@extends('admin.layouts.master')

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('All Withdrawal Methods') }}</h3>
                            <div class="card-actions">
                                <a href="{{ route('admin.withdraw-method.create') }}" class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M12 5l0 14"></path>
                                        <path d="M5 12l14 0"></path>
                                    </svg>
                                    {{ __('Add New') }}
                                </a>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                    <tr>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Minimum Amount') }}</th>
                                        <th>{{ __('Maximum Amount') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th class="w-8">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($methods as $method)
                                        <tr>
                                            <td>{{ $method->name }}</td>

                                            <td>{{ currencyPosition($method->minimum_amount) }}</td>

                                            <td>{{ currencyPosition($method->maximum_amount) }}</td>

                                            <td>
                                                @if ($method->status == 1)
                                                    <span class="badge bg-success text-white">{{ __('Active') }}</span>
                                                @else
                                                    <span class="badge bg-danger text-white">{{ __('Inactive') }}</span>
                                                @endif
                                            </td>

                                            <td>

                                                <div class="d-flex align-items-center justify-content-center gap-2">

                                                    <a href="{{ route('admin.withdraw-method.edit', $method->id) }}"
                                                        class="btn btn-icon btn-sm btn-light border rounded-3 action-btn"
                                                        data-bs-toggle="tooltip" title="{{ __('View Method') }}">

                                                        <i class="bi bi-eye text-primary"></i>

                                                    </a>
                                                    <!-- Delete -->
                                                    <form
                                                        action="{{ route('admin.withdraw-method.destroy', $method->id) }}"
                                                        method="POST" class="m-0 delete-forms">

                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit"
                                                            class="btn btn-icon btn-sm btn-light border rounded-3 action-btn"
                                                           title="{{ __('Delete Method') }}">

                                                            <i class="bi bi-trash3 text-danger"></i>

                                                        </button>

                                                    </form>

                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">{{ __('No Data Found') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.body.addEventListener('submit', function (e) {

        if (e.target && e.target.classList.contains('delete-forms')) {

            e.preventDefault();



            const form = e.target;
            const url = form.getAttribute('action');
            const token = form.querySelector('input[name="_token"]').value;
            const tableRow = form.closest('tr');

            fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    tableRow.remove();
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Something went wrong!');
            });
        }
    });
});
</script>
