@extends('frontend.layouts.master')

@section('content')
    <section class="prem-breadcrumb"
        style="background: url('{{ asset('assets/front/images/thumbs/breadcrumb_bg.jpg') }}') center center/cover no-repeat;">
        <div class="container container-two">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-center">
                    <ul class="prem-breadcrumb-list">
                        <li class="breadcrumb-item font-14"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item font-14"><span class="font-10"><i class="fas fa-chevron-right"></i></span>
                        </li>
                        <li class="breadcrumb-item font-14 active"><span
                                class="text-white opacity-50">{{ __('Contact') }}</span></li>
                    </ul>
                    <h3 class="prem-breadcrumb-title mb-0">{{ __('Contact Us') }}</h3>
                </div>
            </div>
        </div>
    </section>
    <section class="wsus__contact_us padding-y-120">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-md-6 col-lg-4">
                    <div class="wsus__contact_single_info">
                        <span><i class="fas fa-phone-alt"></i></span>
                        @if (!empty($settings['contact_phone_1']))
                            <a href="tel:{{ $settings['contact_phone_1'] }}">{{ $settings['contact_phone_1'] }}</a>
                        @endif
                        @if (!empty($settings['contact_phone_2']))
                            <a href="tel:{{ $settings['contact_phone_2'] }}">{{ $settings['contact_phone_2'] }}</a>
                        @endif
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-lg-4">
                    <div class="wsus__contact_single_info">
                        <span><i class="fas fa-envelope"></i></span>
                        @if (!empty($settings['contact_email_1']))
                            <a href="mailto:{{ $settings['contact_email_1'] }}">{{ $settings['contact_email_1'] }}</a>
                        @endif
                        @if (!empty($settings['contact_email_2']))
                            <a href="mailto:{{ $settings['contact_email_2'] }}">{{ $settings['contact_email_2'] }}</a>
                        @endif
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-lg-4">
                    <div class="wsus__contact_single_info">
                        <span><i class="fas fa-globe"></i></span>
                        @if (!empty($settings['contact_link_1']))
                            <a href="{{ $settings['contact_link_1'] }}"
                                target="_blank">{{ $settings['contact_link_1'] }}</a>
                        @endif
                        @if (!empty($settings['contact_link_2']))
                            <a href="{{ $settings['contact_link_2'] }}"
                                target="_blank">{{ $settings['contact_link_2'] }}</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row mt_120 xs_mt_80">
                <div class="col-xl-12 col-lg-12">
                    <form action="{{ route('contact.send') }}" method="POST"
                        class="wsus__contact_form wsus__comment_input_area">
                        @csrf

                        <h3>Feel Free to Get in Touch</h3>

                        <div class="row">
                            <div class="col-xl-12">
                                <x-frontend.input-text name="name" label="name" placeholder="Garikoka Thomash" />
                            </div>

                            <div class="col-xl-6">
                                <x-frontend.input-text type="email" name="email" label="email"
                                    placeholder="infoyour@gmail.com" />
                            </div>

                            <div class="col-xl-6">
                                <x-frontend.input-text name="subject" label="subject" placeholder="Your Subject" />
                            </div>

                            <div class="col-xl-12">
                                <x-frontend.textarea name="message" label="message" placeholder="Write a Message"
                                    rows="6" />

                                <button class="btn btn-main btn-lg mt-3" type="submit">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @if (!empty($settings['contact_map']))
            <div class="col-xl-12">
                <div class="wsus__contact_map">
                    {!! $settings['contact_map'] !!}
                </div>
            </div>
        @endif

    </section>
@endsection
