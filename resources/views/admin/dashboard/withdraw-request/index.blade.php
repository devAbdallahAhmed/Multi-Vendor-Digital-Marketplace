@extends('admin.layouts.master')

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('All Withdrawal Requests') }}</h3>

                        </div>

                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                    <tr>
                                        <th>{{ __('NO') }}</th>
                                        <th>{{ __('Author') }}</th>
                                        <th>{{ __('Amount') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Date') }}</th>

                                        <th class="w-8">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($withdraws as $withdraw)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>

                                            <!-- Author Info -->
                                            <td>
                                                <div class="fw-bold text-dark">{{ $withdraw->author->name }}</div>
                                                <div class="text-muted small">{{ $withdraw->author->email }}</div>
                                            </td>

                                            <!-- Amount -->
                                            <td class="fw-semibold">
                                                {{ currencyPosition($withdraw->amount) }}
                                            </td>

                                            <!-- Status -->
                                            <td>
                                                @if ($withdraw->status === 'pending')
                                                    <span class="badge bg-warning text-white">{{ __('Pending') }}</span>
                                                @elseif ($withdraw->status === 'paid')
                                                    <span class="badge bg-success text-white">{{ __('Paid') }}</span>
                                                @elseif ($withdraw->status === 'rejected')
                                                    <span class="badge bg-danger text-white">{{ __('Rejected') }}</span>
                                                @endif
                                            </td>

                                            <!-- Date -->
                                            <td>
                                                {{ $withdraw->created_at->format('Y-m-d') }}
                                            </td>

                                            <!-- Action -->
                                            <td>
                                                <div class="d-flex align-items-center justify-content-center gap-2">
                                                    <a href="{{ route('admin.withdraw-request.show', $withdraw->id) }}"
                                                        class="btn btn-icon btn-sm btn-light border rounded-3 action-btn"
                                                        data-bs-toggle="tooltip" title="{{ __('View Request') }}">
                                                        <i class="bi bi-eye text-primary"></i>
                                                    </a>
                                                    @if ($withdraw->status === 'rejected')
                                                        <form
                                                            action="{{ route('admin.withdraw-request.destroy', $withdraw->id) }}"
                                                            method="POST" class="m-0 delete-forms">

                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="submit"
                                                                class="btn btn-icon btn-sm btn-light border rounded-3 action-btn"
                                                                title="{{ __('Delete Request') }}">

                                                                <i class="bi bi-trash3 text-danger"></i>
                                                            </button>

                                                        </form>
                                                    @endif

                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-4">{{ __('No Data Found') }}</td>
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
    document.addEventListener('DOMContentLoaded', function() {
        document.body.addEventListener('submit', function(e) {
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
                    .then(response => {
                        if (response.ok) {
                            tableRow.remove();
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }
        });
    });
</script>
