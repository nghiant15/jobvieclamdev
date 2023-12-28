@extends('templates.vietstar.layouts.app')
@section('content')
<!-- Header start -->
@include('templates.vietstar.includes.header')
<!-- Header end -->
<!-- Inner Page Title start -->
<!-- Inner Page Title end -->
@include('templates.vietstar.includes.mobile_dashboard_menu')
<div class="user-wrapper">
    @include('flash::message')
    @include('templates.vietstar.includes.default_sidebar_menu')
    <div class="content">
     

            <div class="myads">
                <h3>{{__('Applied Jobs')}}</h3>
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
                                        <h3 class="job-title-name"><a href="{{route('job.detail', [$job->slug])}}" title="Nhân viên bất động sản">{{$job->title}}</a></h3>
                                    </div>
                                    <p class="card-news__content-detail mb-2 status-apply" status="{{ ($job->appliedUsers) ? __(\App\JobApply::getListStatus()[$job->status_job_apply]) : '' }}">
                                        {{ ($job->appliedUsers) ? __(\App\JobApply::getListStatus()[$job->status_job_apply]) : '' }}
                                    </p>
                                </div>
                                <!-- Title  End-->
    
                                <!-- companyName Start-->
                                <div class="info-item companyName" bis_skin_checked="1"><a href="/cong-ty/{{$company->slug}}" 
                                title="{{$company->name}}">{{$company->name}}</a>
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
    
                                    <!--meta-city-->
    
    
    
                                    <!-- Bán thời gian -->
                                </div>
                                <!--Rank-salary and place End-->
    
                                <!--Day update and place Start-->
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


                         $datetime1 =   Carbon\Carbon::parse($job->applyDate);
                         $timeCurrent = Carbon\Carbon::now();
                         $numberDate1 = $timeCurrent->diffInDays($datetime1);
                          $datetimeText1 ="";
                         if($numberDate1 < 1)
                         {
                            $datetimeText1 = "Hôm nay";
                         }
                         else if($numberDate1 < 2){
                            $datetimeText1 = "Hôm qua";
                         }
                         else 
                         {
                            $datetimeText1 =  $datetime1->format('d-m-Y');
                         }
                                @endphp
                                <div class="info-item day-update" bis_skin_checked="1">
                                  Ngay đăng tuyển: {{$datetimeText}}
                                </div>

                                <div class="info-item day-update" bis_skin_checked="1">
                                  Ngày nộp: {{$datetimeText1}}
                                </div>
                                <!-- <div class="info-item Interview" bis_skin_checked="1">
                                    <i class="iconmoon icon-calendar-icon1"></i>Interview at: 16:30 20/07/2022
                                </div> -->
                                <!--Day update and place End-->
    
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
                                    <a class="btn-view-details" href="{{route('job.detail', [$job->slug])}}"></span> {{__('View Details')}}</a>
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
<script>
    const apply_status = document.querySelectorAll(".status-apply");
    apply_status.forEach((item) => {
        // console.log(item.getAttribute('status'));
        switch (item.getAttribute('status')) {
            case "CV tiếp nhận":
                item.classList.add('accept');
                item.classList.remove('reject');
                break;
            case "Từ chối":
                item.classList.remove('accept');
                item.classList.add('reject');
                break;
            default:
                break;
        }
    })
</script>
@endpush
@push('scripts')
@include('templates.vietstar.includes.immediate_available_btn')
@endpush