@extends('templates.vietstar.layouts.app')
@section('content')
<!-- Header start -->
@include('templates.vietstar.includes.header')
<!-- Header end -->
<!-- Inner Page Title start -->
<!-- Inner Page Title end -->
@include('templates.vietstar.includes.mobile_dashboard_menu')
<div class="user-wrapper">
    
    @include('templates.vietstar.includes.default_sidebar_menu')
    <div class="content">

        <div class="myads">
            <h1 class="fs-25px">{{__('Favourite Jobs')}}</h1>
            @include('flash::message')
            <div class="searchList jobs-side-list">
                <!-- job start -->
                @if(isset($jobs) && count($jobs))
                @foreach($jobs as $job)
                @php $company = $job->getCompany(); @endphp
                @if(null !== $company)
                <div class="item-job mb-3">

                    <div class="logo-company">
                        <div class="pic">
                            {{$company->printCompanyImage()}}
                        </div>
                    </div>
                    <div class="jobinfo">
                        <div class="info" bis_skin_checked="1">
                            <!-- Title  Start-->
                            <div class="info-item job-title-box" bis_skin_checked="1">
                                <div class="job-title" bis_skin_checked="1">
                                    <!-- <span>Mới</span> -->
                                    <h3 class="job-title-name"><a
                                            href="/job/nhan-vien-bat-dong-san-40"
                                            title="Nhân viên bất động sản">Nhân viên bất động sản</a></h3>
                                </div>
                                @if(Auth::check() && Auth::user()->isFavouriteJob($job->slug))
                                <a class="remove_favouritejob"
                                    href="{{route('remove.from.favourite', $job->slug)}}">{{__('Delete')}}
                                </a>
                                @endif
                            </div>
                            <!-- Title  End-->

                            <!-- companyName Start-->
                            <div class="info-item companyName" bis_skin_checked="1"><a
                                    href="/cong-ty/{{$company->slug}}"
                                    title="{{$company->name}}">{{$company->name}}</a>
                           
                               @php 
                            
                                $datetime =   Carbon\Carbon::parse($job->created_at);
                         $timeCurrent = Carbon\Carbon::now();
                         $numberDate = $timeCurrent->diffInDays($datetime);
                                $datetimeText ="";
                         if($numberDate < 1)
                         {
                            $datetimeText = "Hôm nay";
                         }
                         else if($numberDate < 2){
                            $datetimeText = "Hôm qua";
                         }
                         else 
                         {
                            $datetimeText =  $datetime->format('d-m-Y');
                         }

                               @endphp
                               <div class="info-item day-update" bis_skin_checked="1">
                                {{$datetimeText}}
                              </div>
                            <!--Day update and place End-->
                                </div>
                            <!-- companyName End-->
                            <!--rank-salary and place Start-->
                            <div class="info-item box-meta" bis_skin_checked="1">
                            <div class="rank-salary" bis_skin_checked="1">
                                        <span class="fas fa-money-bill"></span>
                                      
                                        {{$job->salary_from.' '.$job->salary_currency}} -
                                        {{$job->salary_to.' '.$job->salary_currency}}
                                    </div>
                                <div class="navbar__link-separator" bis_skin_checked="1"></div>
                                <!--meta-city-->
                                <div class="meta-city" bis_skin_checked="1">
                                        <!-- <i class="fa-solid fa-location-dot"></i> -->
                                        {{$job->getCity('city')}}
                                    </div>


                                <!-- Bán thời gian -->
                            </div>
                            <!--Rank-salary and place End-->

                           

                            <!-- <div class="short-description">M&amp;ocirc; tả c&amp;ocirc;ng việc</div> -->
                        </div>
                        <div class="caption" bis_skin_checked="1">
                          @isset($job->industry)
                                   <div class="welfare" bis_skin_checked="1">
                                    <div class="box-meta" bis_skin_checked="1">
                                        <!-- <i class="fas fa-dollar-sign"></i>  -->
                                        <span>
                                            <!-- Chế độ thưởng -->
                                            {{$job->industry->industry}}
                                        </span>
    
                                    </div>
                                </div>
                             
                            @endisset
                            <div class="user-action" bis_skin_checked="1">
                                <a class="btn-view-details"
                                    href="{{route('job.detail', [$job->slug])}}"> {{__('View Details')}}</a>
                            </div>
                        </div>
                    </div>

                    <!-- <p>{{\Illuminate\Support\Str::limit(strip_tags($job->description), 150, '...')}}</p> -->
                </div>
                <!-- job end -->
                @endif
                @endforeach
                @endif
            </div>
        </div>
        <!-- Pagination -->
        <div class="pagiWrap">
            <nav aria-label="Page navigation example">
                @if(isset($jobs) && count($jobs))
                {{ $jobs->appends(request()->query())->links() }} @endif
            </nav>
        </div>


    </div>
</div>
@include('templates.vietstar.includes.footer')
@endsection
@push('scripts')
@include('templates.vietstar.includes.immediate_available_btn')
@endpush