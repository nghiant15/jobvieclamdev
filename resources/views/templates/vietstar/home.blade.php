@extends('templates.vietstar.layouts.app')
@section('content')
<!-- Header start -->
@include('templates.vietstar.includes.header')
<!-- Header end -->
<!-- Inner Page Title start -->

<!-- Inner Page Title end -->
<div class="wrapper">
    @include('flash::message')
    @include('templates.vietstar.includes.user_dashboard_menu')
    @include('templates.vietstar.includes.user_dashboard_content')
</div>
@include('templates.vietstar.includes.footer')
@endsection
@push('scripts')
@include('templates.vietstar.includes.immediate_available_btn')
@endpush