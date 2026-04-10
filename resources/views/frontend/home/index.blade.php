@extends('frontend.layouts.master')

@section('content')
    <!--========================== Banner Section Start ==========================-->
    @include('frontend.sections.banner')
    <!--========================== Banner Section End ==========================-->

    <!-- ======================== popular Section Start =========================== -->
    @include('frontend.sections.popular')
    <!-- ======================== popular Section End =========================== -->

    <!-- =========================== Arrival Product Section Start ========================== -->
    @include('frontend.sections.arrival')
    <!-- =========================== Arrival Product Section End ========================== -->

    <!-- ======================= Featured Products Start =============================== -->
    @include('frontend.sections.featured')
    <!-- ======================= Featured Products End =============================== -->

    <!-- ======================= Selling Products Start ========================= -->
    @include('frontend.sections.selling')
    <!-- ======================= Selling Products End ========================= -->

    <!-- ======================= To Featured Author Start =============================== -->
    @include('frontend.sections.featured-author')
    <!-- ======================= To Featured Author End =============================== -->

    <!-- ======================= Top performance Author Start =============================== -->
    @include('frontend.sections.performance')
    <!-- ======================= Top performance Author End =============================== -->

    <!-- ======================= Become seller section start ==================== -->
   @include('frontend.sections.become-seller')
    <!-- ======================= Become seller section End ==================== -->
@endsection
