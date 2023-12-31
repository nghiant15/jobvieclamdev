@extends('templates.vietstar.layouts.app')
@inject('carbon', 'Carbon\Carbon')
@section('content')
    <!-- Header start -->
    @include('templates.vietstar.includes.header')
    <!-- Header end -->
    <!-- Inner Page Title start -->
    @include('templates.vietstar.includes.inner_page_title', ['page_title' => __('Company Posted Jobs')])
    <!-- Inner Page Title end -->
    <div class="listpgWraper main-content">
        <div class="container">
            <div class="row">
                @include('templates.vietstar.includes.company_dashboard_menu')
                <div class="col-md-9">
                    <div class="card mb-2">
                        <div class="card-body">
                            <form action="{{ route('posted.jobs') }}" method="get" class="form-search pt-2">
                                <div class="row filter-job">
                                    <div class="col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <input type="text" name="title" placeholder="{{ __('Research Jobs') }}"
                                                class="form-control search-title"
                                                value="{{ isset($request['title']) ? $request['title'] : '' }}">

                                        </div>
                                    </div>
                                    {{-- <div class="col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <select name="status" class="form-select" name="" id="">
                                                <option value="">{{ __('Select status') }}</option>
                                                @foreach (\App\Job::getListStatusJob() as $key => $value)
                                                    <option
                                                        {{ isset($request['status']) && $request['status'] == $key ? 'selected' : '' }}
                                                        value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> --}}
                                    <div class="col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <select name="city_id" class="form-control form-select chosen" name="" id="city_id">
                                                <option value="">{{ __('Select cities') }}</option>
                                                @foreach ($cities as $key => $value)
                                                    <option
                                                        {{ isset($request['city_id']) && $request['city_id'] == $key ? 'selected' : '' }}
                                                        value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4 text-center">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="iconmoon  icon-recruiter-search-2"></i> Tìm kiếm</button>
                                    </div>
                                </div>
                            </form>
                            <div class="row">
                                <a href="{{ route('posted.jobs', ['status' => '1']) }}" class="px-auto btn btn-outline-primary {{ Request::get('status') == 1 ? 'type-active' : '' }}">{{ __('Active job') }}</a>
                                <a href="{{ route('posted.jobs', ['status' => '2']) }}" class="px-auto btn btn-outline-primary {{ Request::get('status') == 2 ? 'type-active' : '' }}">{{ __('Pending job') }}</a>
                                <a href="{{ route('posted.jobs', ['status' => '3']) }}" class="px-auto btn btn-outline-primary {{ Request::get('status') == 3 ? 'type-active' : '' }}">{{ __('Inactive job') }}</a>
                                <a href="{{ route('posted.jobs', ['expired' => 'true']) }}" class="px-auto btn btn-outline-primary {{ Request::get('expired') == 'true' ? 'type-active' : '' }}">{{ __('Job is expired') }}</a>
                            </div>
                        </div>
                    </div>
                    @include('flash::message')
                    <div class="row">
                        @if (isset($jobs) && count($jobs))
                            @foreach ($jobs as $job)
                                <div class="col-md-6 col-lg-4">
                                    <div class="posted-job">
                                        <h3 class="job-title">
                                            <a href="{{ route('job.detail', [$job->slug]) }}" title="{{ $job->title }}">{{ $job->title }}</a>
                                            @php
                                                $disable = $job->status == \App\Job::POST_PENDING || $job->status == \App\Job::POST_INACTIVE ? true : false;
                                                if(!empty($job->refresh_at)){
                                                        $refreshEn = $job->status == \App\Job::POST_ACTIVE &&
                                                        $carbon->parse($job->refresh_at)->diffInMinutes($carbon->now()) > 240 &&
                                                        $carbon->parse($job->expiry_date) > $carbon->now()  && $job->is_featured == 1 ? '' : 'disabled';
                                                    } else {
                                                        $refreshEn = $job->status == \App\Job::POST_ACTIVE &&
                                                        $carbon->parse($job->updated_at)->diffInMinutes($carbon->now()) > 240 &&
                                                        $carbon->parse($job->expiry_date) > $carbon->now()  && $job->is_featured == 1 ? '' : 'disabled';
                                                    }
                                            @endphp

                                            <button class="btn btn-sm btn-refresh-job-feature btn-refresh float-right" data-id="{{ $job->id }}" {{$refreshEn}} title="Làm mới"><i class="iconmoon icon-level-icon"></i></button>

                                        </h3>
                                        <div class="desc">
                                            @if(Carbon\Carbon::parse($job->expiry_date)->format('Y-m-d') > Carbon\Carbon::now()->format('Y-m-d'))
                                                {{ __(\App\Job::getListStatusJob()[$job->status]) }}
                                            @else
                                                {{ __('Job is expired') }} <i class='fas fa-exclamation' style='color:#981b1e'></i>
                                            @endif
                                        </div>
                                        <div class="group-control">
                                            <div class="tags">
                                                <span class="tag location">{{ $job->getCity('city') }} </span>
                                                <span class="tag time">{{ $job->getJobShift('job_shift') }}</span>
                                            </div>
                                            <div class="salary">
                                                <span
                                                    class="iconmoon icon-attach_money"></span><span>
                                                    @php($from = round($job->salary_from/1000000,0))
                                                    @php($to = round($job->salary_to/1000000,0))
                                                    @if($job->salary_type == \App\Job::SALARY_TYPE_FROM)
                                                        <span class="fas fa-dollar-sign"></span> {{__('From: ')}} {{$from}} {{__('million')}} ({{$job->salary_currency}})
                                                    @elseif($job->salary_type == \App\Job::SALARY_TYPE_TO)
                                                        <span class="fas fa-dollar-sign"></span> {{__('Up To: ')}} {{$to}} {{__('million')}} ({{$job->salary_currency}})
                                                    @elseif($job->salary_type == \App\Job::SALARY_TYPE_RANGE)
                                                        <span class="fas fa-dollar-sign"></span> {{$from}} - {{$to}} {{__('million')}} ({{$job->salary_currency}})
                                                    @elseif($job->salary_type == \App\Job::SALARY_TYPE_NEGOTIABLE)
                                                        <span class="fas fa-money-bill"></span> {{__('Negotiable')}}
                                                    @else
                                                        <span class="fas fa-dollar-sign"></span> {{__('Salary Not provided')}}
                                                    @endif

                                                </span>
                                            </div>
                                        </div>
                                        <hr>
                                        <ul class="detail-jobs">
                                            <li>
                                                <span class="iconmoon icon-recruiter-user"></span>
                                                {{-- <a href="{{route('list.applied.users', [$job->id])}}">{{__('List of Candidates')}}</a> --}}
                                                <a
                                                    href="{{ route('application.manager') }}">{{ __('List of Candidates') }}</a>
                                                <span class="count">{{ $job->appliedUsers->count() }}</span>
                                            </li>
                                            {{-- <li>
                                            <span class="iconmoon icon-recruiter-profile"></span>
                                            <a href="{{route('list.result-posted-job', [$job->id,'posted-job-2'])}}">{{__('Short-Listed Candidates')}}</a>
                                            <span class="count"></span>
                                        </li> --}}
                                            <li>
                                                <span class="iconmoon icon-recruiter-profile"></span>
                                                {{-- <a href="{{route('list.favourite.applied.users', [$job->id])}}">{{__('Short-Listed Candidates')}}</a> --}}
                                                <a
                                                    href="{{ route('interview.schedule.calendar', [$job->company_id]) }}">{{ __('Interview Candidates') }}</a>
                                                <span class="count">{{ $job->getStatusInterview()->count() }}</span>
                                            </li>
                                            <li>
                                                <span class="iconmoon icon-recruiter-check"></span>
                                                {{-- status == 3 Successful interview --}}
                                                <a
                                                    href="{{ route('interview.filter', ['interview_status' => '3']) }}">{{ __('List of Hired Candidates') }}</a>
                                                <span class="count">{{ $job->getStatusInterview(3)->count() }}</span>
                                            </li>
                                            <li>
                                                <span class="iconmoon icon-recruiter-uncheck"></span>
                                                {{-- status == 4 Successful interview --}}
                                                <a
                                                    href="{{ route('interview.filter', ['interview_status' => '4']) }}">{{ __('List of Rejected Candidates') }}</a>
                                                <span class="count">{{ $job->getStatusInterview(4)->count() }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <!-- job end -->
                    <!-- Pagination Start -->
                    <div class="pagiWrap">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="showreslt">
                                    {{ __('Showing Pages') }} : {{ $jobs->firstItem() }} - {{ $jobs->lastItem() }}
                                    {{ __('Total') }} {{ $jobs->total() }}
                                </div>
                            </div>
                            <div class="col-md-7 text-right">
                                @if (isset($jobs) && count($jobs))
                                    {{ $jobs->appends(request()->query())->links() }}
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- Pagination end -->
                </div>
            </div>
        </div>
    </div>
    </div>
    @include('templates.vietstar.includes.footer')
@endsection
@push('styles')
<style type="text/css">
    input.form-control.search-title {
        height: 53px;
    }
    a.px-auto.btn.btn-outline-primary {
        width: 24%;
        margin-left: 8px;
    }
    .type-active {
        background: #981b1d;
        color: white;
    }
    button.btn.btn-primary {
        width: 80%;
    }
    .row.filter-job {
        margin-bottom: -18px;
    }
</style>
@endpush
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>

    <script type="text/javascript">


        $(document).ready(function(){
            $(".chosen").chosen();

            function deleteJob(id) {
                var msg = 'Are you sure?';
                if (confirm(msg)) {
                    $.post("{{ route('delete.front.job') }}", {
                        id: id,
                        _method: 'DELETE',
                        _token: '{{ csrf_token() }}'
                    })
                        .done(function(response) {
                            if (response == 'ok') {
                                $('#job_li_' + id).remove();
                            } else {
                                alert('Request Failed!');
                            }
                        });
                }
            }

            $('.btn-refresh').on('click', function() {
                var id = $(this).data('id');
                var url = "{{ route('refresh.front.job',':id') }}";
                url = url.replace(':id', id);
                $.ajax({
                    url: url,
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    method: 'get',
                    beforeSend: function() {
                       console.log(id);
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.success == true) {
                            alert("{{__('Refresh job success!')}}");
                            refreshPage();
                        } else {
                            alert("{{__('Refresh job failed!')}}");
                        }
                    }
                });
            });
        });

        function refreshPage() {
            location.reload(true);
        }
    </script>
@endpush
