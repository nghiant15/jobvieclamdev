@extends('templates.vietstar.layouts.app') @section('content')
<!-- Header start -->
@include('templates.vietstar.includes.header')
<!-- Header end -->
<!-- Inner Page Title start -->
@include('templates.vietstar.includes.inner_page_title', ['page_title'=>__('Cvs Search Packages')])
<!-- Inner Page Title end -->
<?php $company = Auth::guard('company')->user(); ?>
<div class="listpgWraper">
    <div class="container">
        @include('flash::message')
        <div class="row">
            @include('templates.vietstar.includes.company_dashboard_menu')
            <div class="col-md-9">
                @if(null!==($success_package) && !empty($success_package))
                    @php
                        $language = \App::getLocale();
                        $currency = \App\Country::where('lang', $language)->first()->currency ?? 'vnd';
                        $curr = isset($success_package) ? $success_package->currency : $currency;
                        $price = $curr == 'vnd' ? number_format($success_package->package_price, 0, ',', '.') : number_format($success_package->package_price, 2, '.', ',');
                        $formatDate = $language == 'vi' ? 'd-m-Y' : 'd M, Y';
                    @endphp
                    <div class="instoretxt">
                        <div class="credit">{{__('Your Package is')}}: <strong>{{$success_package->package_title}} - {{$price}} ({{$success_package->currency }})</strong></div>
                        <div class="credit">
                            {{__('Package Duration')}} : <strong>{{Auth::guard('company')->user()->package_start_date->format($formatDate)}}</strong> : <strong>{{Auth::guard('company')->user()->package_end_date->format($formatDate)}}</strong>
                        </div>
                        <div class="credit">{{__('Availed quota')}} :  <strong>{{Auth::guard('company')->user()->availed_jobs_quota}}</strong> / <strong>{{Auth::guard('company')->user()->jobs_quota}}</strong></div>
                    </div>
                @endif

                <div class="paypackages">
                    <!---four-paln-->
                    <?php
                    $package = Auth::guard('company')->user()->cvs_getPackage(); ?> @if(null!==($package))
                        <div class="card widget-dashboard mb-3 w-100 shadow-sm">
                            <div class="card-body">
                                <div class="paypackages">
                                    <div class="four-plan">
                                        <h3 class="title text-left">{{__('Upgrade Package')}}</h3>
                                        <div class="our-packages">
                                            <div class="row">
                                                @foreach($packages as $package)
                                                    <div class="col-md-4 col-sm-6 col-xs-12 item-package">
                                                        <div class="package package-center">
                                                            <div class="icon"><i class="fa fa-paper-plane" aria-hidden="true"></i></div>
                                                            <h3 class="package-title">{{$package->package_title}}</h3>
                                                            <div class="price"><small>$</small>{{$package->package_price}}</div>

                                                            <ul>
                                                                @if($package->package_for=='cv_search')
                                                                    <li class="plan-pages">{{__('Can search seekrs')}} : {{$package->package_num_listings}}</li>
                                                                @else
                                                                    <li class="plan-pages">{{__('Can post jobs')}} : {{$package->package_num_listings}}</li>
                                                                @endif
                                                                <li class="plan-pages">{{__('Package Duration')}} : {{$package->package_num_days}} {{__('Days')}}</li>

                                                                @if((bool)$siteSetting->is_paypal_active)
                                                                    <li class="order paypal">
                                                                        <a href="{{route('order.upgrade.package', $package->id)}}"><i class="fab fa-cc-paypal" aria-hidden="true"></i> {{__('pay with paypal')}}</a>
                                                                    </li>
                                                                @endif @if((bool)$siteSetting->is_stripe_active)
                                                                    <li class="order">
                                                                        <a href="{{route('stripe.order.form', [$package->id, 'upgrade'])}}"><i class="fab fa-cc-stripe" aria-hidden="true"></i> {{__('pay with stripe')}}</a>
                                                                    </li>
                                                                @endif @if((bool)$siteSetting->is_payu_active)
                                                                    <li class="order payu"><a href="{{route('payu.order.cvsearch.package', ['package_id='.$package->id, 'type=upgrade'])}}">{{__('pay with PayU')}}</a></li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="card widget-dashboard mb-3 w-100 shadow-sm">
                            <div class="card-body">
                                <div class="paypackages">
                                    <div class="four-plan">
                                        <h3>{{__('Our Cvs Search Packages')}}</h3>
                                        <div class="row">
                                            @foreach($packages as $package)
                                                <div class="col-md-4 col-sm-6 col-xs-12">
                                                    <ul class="boxes">
                                                        <li class="icon"><i class="fa fa-paper-plane" aria-hidden="true"></i></li>
                                                        <li class="plan-name">{{$package->package_title}}</li>
                                                        <li>
                                                            <div class="main-plan">
                                                                <div class="plan-price1-1">{{ $siteSetting->default_currency_code }}</div>
                                                                <div class="plan-price1-2">{{$package->package_price}}</div>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                        </li>
                                                        @if($package->package_for == 'cv_search')
                                                            <li class="plan-pages">{{__('Can search seekrs')}} : {{$package->package_num_listings}}</li>
                                                        @else
                                                            <li class="plan-pages">{{__('Can post jobs')}} : {{$package->package_num_listings}}</li>
                                                        @endif
                                                        <li class="plan-pages">{{__('Package Duration')}} : {{$package->package_num_days}} {{__('Days')}}</li>
                                                        @if($package->package_price > 0) @if((bool)$siteSetting->is_paypal_active)
                                                            <li class="order paypal">
                                                                <a href="{{route('order.package', $package->id)}}"><i class="fa fa-cc-paypal" aria-hidden="true"></i> {{__('pay with paypal')}}</a>
                                                            </li>
                                                        @endif @if((bool)$siteSetting->is_stripe_active)
                                                            <li class="order">
                                                                <a href="{{route('stripe.order.form', [$package->id, 'new'])}}"><i class="fa fa-cc-stripe" aria-hidden="true"></i> {{__('pay with stripe')}}</a>
                                                            </li>
                                                        @endif @if((bool)$siteSetting->is_payu_active)
                                                            <li class="order payu"><a href="{{route('payu.order.cvsearch.package', ['package_id='.$package->id, 'type=new'])}}">{{__('pay with PayU')}}</a></li>
                                                        @endif @else
                                                            <li class="order paypal"><a href="{{route('order.free.package', $package->id)}}"> {{__('Subscribe Free Package')}}</a></li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                @endif
                <!---end four-paln-->
                </div>
            </div>
        </div>
    </div>
</div>
@include('templates.vietstar.includes.footer')
@endsection
@push('scripts')
    @include('templates.vietstar.includes.immediate_available_btn')
@endpush
