@extends('templates.vietstar.layouts.app')
@section('content')
<!-- Header start -->
@include('templates.vietstar.includes.header')
<!-- Header end --> 
<!-- Inner Page Title start -->
@include('templates.vietstar.includes.inner_page_title', ['page_title'=>__('Page Expired')])
<!-- Inner Page Title end -->
<div class="about-wraper"> 
    <!-- About -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{{__('Page Expired')}}</h2>
                <p>{{__('The page has expired due to inactivity. Please refresh and try again.')}}</p>
            </div>      
        </div>
    </div>  
</div>
@include('templates.vietstar.includes.footer')
@endsection
