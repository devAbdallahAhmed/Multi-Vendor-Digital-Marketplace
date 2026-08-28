@extends('admin.layouts.master')

@section('content')
    <div class="page-wrapper bg-light min-vh-100">
        <div class="page-header d-print-none py-4">
            <div class="container-xl">
                <h2 class="fw-bold text-danger">Wipe Database</h2>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <div class="alert alert-danger mb-4" role="alert">
                            <h4 class="alert-heading fw-bold">Warning!</h4>
                            <p class="mb-0">Are you sure you want to wipe the database? This action cannot be undone and
                                all dummy data will be permanently deleted.</p>
                        </div>

                        <form class="wipe-database-form" action="{{ route('admin.wipe-database.destroy') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger px-4 py-2 rounded-3 wipe-database-btn">
                                Wipe Database Now
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const form = document.querySelector('.wipe-database-form');

            form.addEventListener('submit', function (e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        Swal.fire({
                            title: 'Please wait',
                            html: 'Processing your request...',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        let formData = new FormData(form);

                        fetch(form.action, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'X-HTTP-Method-Override': 'DELETE',
                                'Accept': 'application/json'
                            },
                            body: formData
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.status === 'success') {
                                window.location.reload();
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire('Error', 'Something went wrong!', 'error');
                        });
                    }
                });
            });
        });
    </script>
@endpush
