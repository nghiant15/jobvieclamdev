<!-- Navigation bar -->
<nav class="navbar navbar-expand-xl navbar-light bg-light shadow-sm fixed-top" id="main-nav">
    <!-- <div class="container-navbar"> -->
    <div class="container">
        <a class="navbar-brand" href="{{url('/')}}">
            <img src="{{ asset('/vietstar/imgs/logo-new.svg') }}" alt="vietstar">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- collapse -->
        <div class="collapse navbar-collapse main-menu" id="navbarNavAltMarkup">
            <div class="navbar-nav flex-grow-1 justify-content-end">
                <ul class="navbar-nav main-menu-static ml-auto">
                    <li>
                        <a class="nav-link  {{ Request::url() == route('index') ? 'header-active' : 'text-main-color' }}" href="{{url('/')}}"
                        style="{{ Request::url() == route('index')  ? 'color:#981B1E;' : '' }}">{{__('Home')}}</a>
                    </li>
                    {{-- <li><a class="nav-link " href="{{ url('/companies')}}">{{__('Công ty')}}</a></li> --}}
                    <li>
                        <a href="{{ route('job.list') }}" class="nav-link {{ Request::url() == route('job.list') || strpos(Request::url(),'/job/') > 0 ? 'header-active' : 'text-main-color' }}"
                        style="{{ Request::url() == route('job.list')  || strpos(Request::url(),'job') ? 'color:#981B1E;' : '' }}">{{__('Jobs')}}</a>
                    </li>
                   <!--  <li>
                        <a href="{{ route('products-services') }}" class="nav-link {{ Request::url() == route('products-services') ? 'header-active' : 'text-main-color' }}"
                        style="{{ Request::url() == route('products-services')   ? 'color:#981B1E;' : '' }}">{{__('Products and Services')}}</a>
                    </li> -->
                   <!--  <li>
                        <a href="{{ route('vietnam-salary') }}" class="nav-link {{ Request::url() == route('vietnam-salary')  ? 'header-active' : 'text-main-color' }}"
                        style="{{ Request::url() == route('vietnam-salary')  ? 'color:#981B1E;' : '' }}">{{__('Vietnam Salary')}}</a>
                    </li> -->

                    <li class="has-child">
                        <a href="{{ route('my.profile') }}" class="nav-link nav-link-parent">{{__('Profiles and CVs')}}</a>
                        <button type="button" class="btn-show-sub-menu" data-ref="findJob" data-target="false"><span class="iconmoon icon-p-next"></span></button>
                        <ul class="sub-menu" data-ref="findJob" data-target="false">
                            @php
                                $pointer = Auth::check()==true ? '' : 'style=pointer-events:none;';
                            @endphp
                            <li><a class="sub-item" href="{{route('change.template')}}" {{$pointer}}><span class="iconmoon icon-recruiter-portfolio"></span>
                                {{__('CV Templates')}}
                                </a>
                            </li>
                            @php
                                $pointerCom = Auth::guard('company')->check()==true ? '': 'style=pointer-events:none;';
                            @endphp
                            <li>
                                <a class="sub-item" href="{{route('application.manager')}}" {{$pointerCom}}><span class="iconmoon icon-recruiter-portfolio"></span>
                                    {{__('CV Management')}}
                                </a>
                            </li>
                            <li>
                                <a class="sub-item" href="{{route('cover-letter')}}" {{$pointer}}><span class="iconmoon icon-recruiter-portfolio"></span>
                                    {{__('Cover Letter')}}
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li class="has-child">
                        <a href="{{ route('my.profile') }}" class="nav-link nav-link-parent">{{__('Company')}}</a>
                        <button type="button" class="btn-show-sub-menu" data-ref="findJob" data-target="false"><span class="iconmoon icon-p-next"></span></button>
                        <ul class="sub-menu" data-ref="findJob" data-target="false">
                            <li>
                                <a class="sub-item" href="{{route('about_us')}}"><span class="iconmoon icon-recruiter-portfolio"></span>
                                    {{__('About us')}}
                                </a>
                            </li>
                            <li>
                                <a class="sub-item" href="{{route('top-companies')}}"><span class="iconmoon icon-recruiter-portfolio"></span>
                                    {{__('Top companies')}}
                                </a>
                            </li>
                            <li>
                                <a class="sub-item" href="{{route('company.listing')}}"><span class="iconmoon icon-recruiter-portfolio"></span>
                                    {{__('Companies')}}
                                </a>
                            </li>

                        </ul>
                    </li>
                    {{-- <li class="has-child">
                        <a href="{{ route('my.profile') }}" class="nav-link nav-link-parent">{{__('News')}}</a>
                        <button type="button" class="btn-show-sub-menu" data-ref="findJob" data-target="false"><span class="iconmoon icon-p-next"></span></button>
                        <ul class="sub-menu" data-ref="findJob" data-target="false">
                            <li>
                                <a class="sub-item" href="{{route('page-category', ['slug' => 'cam_nang'])}}"><span class="iconmoon icon-recruiter-portfolio"></span>
                                    {{__('Pages')}}
                                </a>
                            </li>
                            <li>
                                <a class="sub-item" href="{{route('blogs')}}"><span class="iconmoon icon-recruiter-portfolio"></span>
                                    {{__('News')}}
                                </a>
                            </li>

                        </ul>
                    </li> --}}
                    <!-- <li>
                        <a href="#" class="nav-link">{{__('Introduce candidate')}}</a>
                    </li> -->

                    {{-- @foreach($show_in_top_menu as $top_menu) @php $cmsContent = App\CmsContent::getContentBySlug($top_menu->page_slug); @endphp
                    <li>
                        <a href="{{ route('cms', $top_menu->page_slug) }}" class="nav-link  {{ Request::url() == route('cms', $top_menu->page_slug) ? 'active' : 'text-main-color' }}"
                        style="{{ Request::url() == route('cms', $top_menu->page_slug)  ? 'color:#981B1E;' : '' }}">{{ $cmsContent->page_title }}</a>
                    </li>
                    @endforeach --}}
                    <li class="has-child">
                        <a href="{{ route('blogs') }}" class="nav-link nav-link-parent" {{ Request::url() == route('blogs') ? 'header-active' : 'text-main-color' }}"
                           style="{{ Request::url() == route('blogs')  ? 'color:#981B1E;' : '' }}">{{__('Blog')}}
                        </a>
                        @php($categories = \App\Blog_category::get())
                        <button type="button" class="btn-show-sub-menu" data-ref="findJob" data-target="false"><span class="iconmoon icon-p-next"></span></button>
                        <ul class="sub-menu" data-ref="findJob" data-target="false">
                            @foreach($categories as $category)
                                <li>
                                    <a class="sub-item" href="{{ url('/blog/category/') . "/" . $category->slug }}"><span class="iconmoon icon-recruiter-portfolio"></span>
                                        {{$category->heading}}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="{{ route('contact.us') }}" class="nav-link  {{ Request::url() == route('contact.us') ? 'header-active' : 'text-main-color' }}"
                        style="{{ Request::url() == route('contact.us') ? 'color:#981B1E;' : '' }}">{{__('Contact')}}</a>
                    </li>
                    
                    </li>

                    {{-- <li class="dropdown userbtn"><a href="{{url('/')}}"><img src="{{asset('/')}}images/lang.png" alt="" class="userimg" /></a>
                        <ul class="dropdown-menu">
                            @foreach($siteLanguages as $siteLang)
                            <li><a href="javascript:;" onclick="event.preventDefault(); document.getElementById('locale-form-{{$siteLang->iso_code}}').submit();" class="nav-link">{{$siteLang->native}}</a>
                                <form id="locale-form-{{$siteLang->iso_code}}" action="{{ route('set.locale') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="locale" value="{{$siteLang->iso_code}}"/>
                                    <input type="hidden" name="return_url" value="{{url()->full()}}"/>
                                    <input type="hidden" name="is_rtl" value="{{$siteLang->is_rtl}}"/>
                                </form>
                            </li>
                            @endforeach
                        </ul>
                    </li> --}}
                </ul>

                <!-- navbar-lang PC -->
                <ul class="navbar-nav navbar-lang navbar-lang-pc ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{ asset('/vietstar/imgs/flags/') }}/{{config('app.available_locales')[App::getLocale()]['flag-icon']}}.png" alt="vietstar">
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            @foreach (config('app.available_locales') as $lang => $language)
                                @if ($lang != App::getLocale())
                                    <a class="dropdown-item" href="{{ route('lang.switch', $lang) }}"><span class="flag-icon flag-icon-{{$language['flag-icon']}}"><img src="{{ asset('/vietstar/imgs/flags/') }}/{{$language['flag-icon']}}.png" alt="vietstar"></span> {{$language['display']}}</a>
                                @endif
                            @endforeach
                            
                        </div>
                    </li>
                </ul>     
                <!-- end navbar-lang PC -->
                
                @if(Auth::check())
                    <!-- user-badge -->
                    <div class="user-badge">
                        <div class="money-base">
                            <p><span class="iconmoon icon-money-database"></span> Số dư</p>
                            <h5 class="dolar-sign text-blue-color m-0">0 đ</h5>
                        </div>
                        <div class="user-badge__avatar">
                            <a class="dropdown userbtn nav-link-dashboard dropdown-toggle" href="#" id="navbarDropdownMenuLinkCom" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{Auth::user()->printUserImage()}}
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item"><a href="{{route('home')}}" class="nav-link"><i class="jobicon fa fa-tachometer" aria-hidden="true"></i> {{__('Dashboard')}}</a> </li>
                                <li class="nav-item"><a href="{{ route('my.profile') }}" class="nav-link"><i class="jobicon fa fa-user" aria-hidden="true"></i> {{__('My Profile')}}</a> </li>
                                <li class="nav-item"><a href="{{ route('view.public.profile', Auth::user()->id) }}" class="nav-link"><i class="jobicon fa fa-eye" aria-hidden="true"></i> {{__('View Public Profile')}}</a> </li>
                                <li><a href="{{ route('my.job.applications') }}" class="nav-link"><i class="jobicon fa fa-desktop" aria-hidden="true"></i> {{__('My Job Applications')}}</a> </li>
                                <li class="nav-item"><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-header').submit();" class="nav-link"><i class="jobicon fa fa-sign-out" aria-hidden="true"></i> {{__('Logout')}}</a> </li>
                                <form id="logout-form-header" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </ul>
                        </div>
                    </div>
                    <!-- End user-badge  -->
                    
                @elseif(Auth::guard('company')->check())
                    <a href="{{route('post.job')}}" class="btn btn-primary btn-post-a-job">{{__('Post a job')}}</a>
                    <!-- user-badge -->
                    <div class="user-badge">
                        <div class="money-base">
                            <p><span class="iconmoon icon-money-database"></span> Số dư</p>
                            <h5 class="dolar-sign text-blue-color m-0">0 đ</h5>
                        </div>
                        <div class="user-badge__avatar">
                            <a class="dropdown userbtn nav-link-dashboard dropdown-toggle" href="#" id="navbarDropdownMenuLinkCom" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M24 48C37.2548 48 48 37.2548 48 24C48 10.7452 37.2548 0 24 0C10.7452 0 0 10.7452 0 24C0 37.2548 10.7452 48 24 48Z" fill="#F2F2F2"/>
                                    <path d="M43.2596 38.3031C41.0213 35.3063 38.1148 32.873 34.7712 31.1965C31.4277 29.5199 27.7391 28.6463 23.9987 28.6451C20.2584 28.644 16.5693 29.5152 13.2246 31.1897C9.88 32.8642 6.97202 35.2957 4.73181 38.291C6.96063 41.3015 9.86386 43.7478 13.2087 45.4339C16.5535 47.12 20.2469 47.9988 23.9927 48C27.7384 48.0012 31.4324 47.1246 34.7782 45.4407C38.1241 43.7567 41.0289 41.3122 43.2596 38.3031Z" fill="#3B4358"/>
                                    <path d="M23.9999 25.5484C29.1308 25.5484 33.2902 21.3889 33.2902 16.258C33.2902 11.1271 29.1308 6.96773 23.9999 6.96773C18.869 6.96773 14.7096 11.1271 14.7096 16.258C14.7096 21.3889 18.869 25.5484 23.9999 25.5484Z" fill="#3B4358"/>
                                </svg>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item"><a href="{{route('company.home')}}" class="nav-link"><i class="jobicon fa fa-tachometer" aria-hidden="true"></i> {{__('Dashboard')}}</a></li>
                                <li class="nav-item"><a href="{{ route('company.profile') }}" class="nav-link"><i class="jobicon fa fa-user" aria-hidden="true"></i> {{__('Company Profile')}}</a></li>
                                <li class="nav-item"><a href="{{ route('post.job') }}" class="nav-link"><i class="jobicon fa fa-desktop" aria-hidden="true"></i> {{__('Post Job')}}</a></li>
                                <li class="nav-item"><a href="{{route('company.messages')}}" class="nav-link"><i class="jobicon fa fa-envelope" aria-hidden="true"></i> {{__('Messages')}}</a></li>
                                <li class="nav-item"><a href="{{ route('company.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-header1').submit();" class="nav-link"><i class="jobicon fa fa-sign-out" aria-hidden="true"></i> {{__('Logout')}}</a></li>
                            </ul>
                            <form id="logout-form-header1" action="{{ route('company.logout') }}" method="GET" style="display: none;"> {{ csrf_field() }} </form>
                        </div>
                    </div>
                    <!-- end user-badge -->
                @endif 
            </div>

            @if(!Auth::user() && !Auth::guard('company')->user())
            <div class="d-flex gap-10 my-2 group-button">
                <a class="btn btn-primary login-btn" href="{{route('login')}}" class="nav-link">{{__('Log in')}}</a>
                {{--<a class="btn btn-primary" href="{{route('register')}}" class="nav-link register">{{__('Đăng ký')}}</a> --}}
                <a class="btn btn-primary" href="{{route('job.seeker.list')}}" class="nav-link">{{__('Find candidates')}}</a>
            </div>
            @endif
        </div>
        <!-- end collapse -->

        
        <!-- Danh cho mobile; có 2 menu mobile và icon user -->
        <div class="group-for-mobile">
           
            @if(Auth::check())
                <!-- user-badge -->
                <div class="user-badge">
                    <div class="money-base">
                        <h5 class="dolar-sign text-blue-color m-0">0 đ</h5>
                    </div>
                    <div class="user-badge__avatar">
                        <a class="dropdown userbtn nav-link-dashboard dropdown-toggle" href="{{route('home')}}">
                            {{Auth::user()->printUserImage()}}
                        </a>
                    </div>
                </div>
                <!-- End user-badge  -->
                
            @elseif(Auth::guard('company')->check())
                <!-- user-badge -->
                <div class="user-badge">
                    <div class="money-base">
                        <h5 class="dolar-sign text-blue-color m-0">0 đ</h5>
                    </div>
                    <div class="user-badge__avatar">
                        <a class="dropdown userbtn nav-link-dashboard dropdown-toggle" href="{{route('company.home')}}">
                            <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M24 48C37.2548 48 48 37.2548 48 24C48 10.7452 37.2548 0 24 0C10.7452 0 0 10.7452 0 24C0 37.2548 10.7452 48 24 48Z" fill="#F2F2F2"/>
                                <path d="M43.2596 38.3031C41.0213 35.3063 38.1148 32.873 34.7712 31.1965C31.4277 29.5199 27.7391 28.6463 23.9987 28.6451C20.2584 28.644 16.5693 29.5152 13.2246 31.1897C9.88 32.8642 6.97202 35.2957 4.73181 38.291C6.96063 41.3015 9.86386 43.7478 13.2087 45.4339C16.5535 47.12 20.2469 47.9988 23.9927 48C27.7384 48.0012 31.4324 47.1246 34.7782 45.4407C38.1241 43.7567 41.0289 41.3122 43.2596 38.3031Z" fill="#3B4358"/>
                                <path d="M23.9999 25.5484C29.1308 25.5484 33.2902 21.3889 33.2902 16.258C33.2902 11.1271 29.1308 6.96773 23.9999 6.96773C18.869 6.96773 14.7096 11.1271 14.7096 16.258C14.7096 21.3889 18.869 25.5484 23.9999 25.5484Z" fill="#3B4358"/>
                            </svg>
                        </a>
                    </div>
                </div>
                <!-- end user-badge -->
            @endif 

             <!-- navbar-lang-mobile -->
            <ul class="navbar-nav navbar-lang navbar-lang-mobile ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ asset('/vietstar/imgs/flags/') }}/{{config('app.available_locales')[App::getLocale()]['flag-icon']}}.png" alt="vietstar">
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        @foreach (config('app.available_locales') as $lang => $language)
                            @if ($lang != App::getLocale())
                                <a class="dropdown-item" href="{{ route('lang.switch', $lang) }}"><span class="flag-icon flag-icon-{{$language['flag-icon']}}"><img src="{{ asset('/vietstar/imgs/flags/') }}/{{$language['flag-icon']}}.png" alt="vietstar"></span> {{$language['display']}}</a>
                            @endif
                        @endforeach
                        
                    </div>
                </li>
            </ul>
            <!-- end navbar-lang-mobile -->
            
        </div>
        <!-- End Danh cho mobile; có 2 menu mobile và icon user -->
    </div>
 </nav>
@push('styles')
    <style>
        .header-active {
            color:#981B1E;
            text-decoration:underline;
            text-decoration-style: solid;
            text-underline-offset: 3px;
        }

        .login-btn {
            color: #981b1e;
            background-color:transparent !important;
            border-color: #981b1e;

        }
    </style>
@endpush
