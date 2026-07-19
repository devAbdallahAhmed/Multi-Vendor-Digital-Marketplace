@extends('frontend.dashboard.layouts.master')

@section('content')
    <div class="container-xl py-4">
        <div class="card border-0 shadow-sm rounded-4 mb-4">

            <div class="card-header border-0 bg-white p-4 d-flex justify-content-between align-items-center">
                <h4 class="fw-bold mb-0 text-dark">{{ __('License Informations') }}</h4>
                <a href="{{ route('orders.index') }}" class="btn btn-primary">{{ __('Go Back') }}</a>
            </div>

            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td class="fw-bold" style="width: 250px;">{{ __('Licensor / Author Name') }}</td>
                                <td class="text-start">{{ $order->item->author->name }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">{{ __('Licensee') }}</td>
                                <td class="text-start">{{ $order->user->name }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">{{ __('Item ID') }}</td>
                                <td class="text-start">#{{ $order->item->id }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">{{ __('Item Name') }}</td>
                                <td class="text-start">
                                    <a href="{{ route('product.details', $order->item->slug) }}" class="text-decoration-none">
                                        {{ $order->item->name }}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">{{ __('Purchase Code') }}</td>
                                <td class="text-start">{{ $order->purchase_key }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">{{ __('Purchase Date') }}</td>
                                <td class="text-start">{{ $order->created_at->format('M d, Y') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
